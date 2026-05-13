<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
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
            $product = Product::find($entry['product_id']);
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

    public function paypalOrder(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity  = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);
        $amount  = $product->price * $quantity;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount,
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
        ]);

        foreach ($order['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return redirect()->away($link['href']);
            }
        }

        return redirect()->back()->with('error', 'Something went wrong.');
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {

           $this->updatePaymentStatus([
               'transaction_id' => $response['id'],
               'order_id' => $request->order_id,
               'payment_method' => 'PayPal'
               ]);
            toast('Payment Successful.');

            // Redirect based on whether user is logged in or guest
            if (Auth::check()) {
                return redirect()->route('my-account.orders.details', $request->order_id);
            }

            return redirect()->route('checkout.success');
        } else {
            toast('Something went wrong.', 'error');
        }
        return redirect()->route('home');
    }

    public function cancel(Request $request)
    {
        toast('Payment cancelled.', 'error');

        return redirect()->route('home');
    }

    public function stripeOrder(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'country' => 'nullable|string',
            'amount' => 'required',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $token = $request->stripeToken;
        $amount = $request->amount * 100;

        $items = $this->getCartItems();

        DB::beginTransaction();
        try {
            // Build order data — works for both guests and logged-in users
            $orderData = [
                'user_id' => Auth::id(), // null for guests
                'total_amount' => $request->amount,
                'shipping_address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ];

            // Store guest info when not logged in
            if (!Auth::check()) {
                $orderData['guest_email'] = $request->email;
                $orderData['guest_firstname'] = $request->firstname;
                $orderData['guest_lastname'] = $request->lastname;
                $orderData['guest_phone'] = $request->phone;
            }

            $order = Order::create($orderData);

            foreach ($items as $item) {
                if (is_array($item)) {
                    $item = (object) $item;
                }
                $order->items()->create([
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }
            DB::commit();

            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'description' => config('app.name') . ' - Order #' . $order->id,
                'source' => $token,
            ]);

            $this->updatePaymentStatus(
                [
                    'transaction_id' => $charge->id,
                    'order_id' => $order->id,
                    'payment_method' => 'Stripe',
                ]
            );

            toast('Payment successful.', 'success');

            // Redirect based on whether user is logged in or guest
            if (Auth::check()) {
                return redirect()->route('my-account.orders.details', $order->id);
            }

            // Guest: redirect to order confirmation
            return redirect()->route('checkout.success')->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();

            toast($e->getMessage(), 'error');

            return back();
        }
    }

    public function updatePaymentStatus($data)
    {
        DB::beginTransaction();

        try {
            $order = Order::find($data['order_id']);
            $order->payment_status = 'paid';
            $order->save();

            Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total_amount,
                'payment_method' => $data['payment_method'],
                'status' => 'completed',
                'transaction_id' => $data['transaction_id'],
            ]);

            foreach ($order->items as $item) {
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart for logged-in users from DB, for guests from session
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            }
            Session::forget('cart');
            Session::forget('guest_order_id');

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            toast($e->getMessage(), 'error');
        }
    }
}
