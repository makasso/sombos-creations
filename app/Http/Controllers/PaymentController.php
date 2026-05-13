<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * PayPal: Redirect user to PayPal for payment approval.
     * (Legacy route — kept for backward compatibility)
     */
    public function paypalOrder(Request $request)
    {
        // This route is no longer used directly,
        // PayPal is now handled via CheckoutController::post()
        return redirect()->route('checkout');
    }

    /**
     * PayPal: Handle successful return from PayPal.
     */
    public function success(Request $request)
    {
        try {
            $response = $this->paymentService->capturePayPal($request->input('token'));

            $orderId = $request->input('order_id') ?? Session::get('guest_order_id');
            $order = Order::findOrFail($orderId);

            $this->paymentService->finalizePayment($order, $response['id'], 'paypal');

            toast('Payment successful! Thank you for your order.', 'success');

            if (Auth::check()) {
                return redirect()->route('my-account.orders.details', $order->id);
            }

            return redirect()->route('checkout.success')->with('order_id', $order->id);

        } catch (\Exception $e) {
            Log::error('PayPal success callback error', ['error' => $e->getMessage()]);
            toast('Payment verification failed: ' . $e->getMessage(), 'error');
            return redirect()->route('home');
        }
    }

    /**
     * PayPal: Handle cancellation from PayPal.
     */
    public function cancel(Request $request)
    {
        toast('Payment was cancelled.', 'error');
        return redirect()->route('checkout');
    }

    /**
     * Stripe: Process card payment.
     */
    public function stripeOrder(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'country' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
            'stripeToken' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $items = $this->getCartItems();

            if ($items->isEmpty()) {
                toast('Your cart is empty.', 'error');
                return redirect()->route('shop');
            }

            // Build order
            $orderData = [
                'user_id' => Auth::id(),
                'total_amount' => $request->amount,
                'shipping_address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ];

            if (!Auth::check()) {
                $orderData['guest_email'] = $request->email;
                $orderData['guest_firstname'] = $request->firstname;
                $orderData['guest_lastname'] = $request->lastname;
                $orderData['guest_phone'] = $request->phone;
            }

            $order = Order::create($orderData);

            foreach ($items as $item) {
                if (is_array($item)) $item = (object) $item;
                $order->items()->create([
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            DB::commit();

            // Process Stripe payment
            $transactionId = $this->paymentService->payWithStripe($order, $request->stripeToken);
            $this->paymentService->finalizePayment($order, $transactionId, 'stripe');

            toast('Payment successful!', 'success');

            if (Auth::check()) {
                return redirect()->route('my-account.orders.details', $order->id);
            }

            return redirect()->route('checkout.success')->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Stripe payment error', ['error' => $e->getMessage()]);
            toast('Payment failed: ' . $e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * Load cart items (works for both authenticated users and guests).
     */
    protected function getCartItems()
    {
        if (Auth::check()) {
            return Auth::user()->cart()->with('product')->get();
        }

        $sessionCart = Session::get('cart', []);
        $items = collect();

        foreach ($sessionCart as $entry) {
            $product = \App\Models\Product::find($entry['product_id']);
            if ($product) {
                $items->push((object) [
                    'product_id' => $entry['product_id'],
                    'quantity' => $entry['quantity'],
                    'product' => $product,
                ]);
            }
        }

        return $items;
    }
}
