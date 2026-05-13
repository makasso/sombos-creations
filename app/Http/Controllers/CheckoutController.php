<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Masmerise\Toaster\Toaster;

class CheckoutController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
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

    public function index()
    {
        $items = $this->getCartItems();

        if ($items->isEmpty()) {
            Toaster::error('Your cart is empty.');
            return redirect()->route('shop');
        }

        return view('checkout', ['items' => $items, 'subTotal' => 0]);
    }

    public function validateCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }

        // Check validity dates
        if ($coupon->valid_from && now()->lt($coupon->valid_from)) {
            return response()->json(['success' => false, 'message' => 'This coupon is not yet active.']);
        }
        if ($coupon->valid_until && now()->gt($coupon->valid_until)) {
            return response()->json(['success' => false, 'message' => 'This coupon has expired.']);
        }

        // Check max uses
        if ($coupon->max_uses && $coupon->used_count >= $coupon->max_uses) {
            return response()->json(['success' => false, 'message' => 'This coupon has been fully redeemed.']);
        }

        return response()->json([
            'success' => true,
            'discount' => $coupon->discount,
            'message' => "Coupon applied! {$coupon->discount}% off.",
        ]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:paypal,stripe',
            'coupon_code' => 'nullable|string',
            'shipping_method_id' => 'nullable|exists:shipping_methods,id',
        ]);

        $items = $this->getCartItems();

        if ($items->isEmpty()) {
            Toaster::error('Your cart is empty.');
            return redirect()->route('shop');
        }

        DB::beginTransaction();
        try {
            $subtotal = $request->amount;
            $discount = 0;
            $coupon = null;

            // Apply coupon if provided
            if ($request->filled('coupon_code')) {
                $coupon = Coupon::where('code', $request->coupon_code)->first();
                if ($coupon && (!$coupon->max_uses || $coupon->used_count < $coupon->max_uses)) {
                    $discount = ($subtotal * $coupon->discount) / 100;
                    $subtotal -= $discount;
                }
            }

            // Apply shipping cost
            $shippingCost = 0;
            if ($request->filled('shipping_method_id')) {
                $shippingMethod = ShippingMethod::find($request->shipping_method_id);
                if ($shippingMethod) {
                    $shippingCost = $shippingMethod->cost;
                    $subtotal += $shippingCost;
                }
            }

            // Build order data — works for both guests and logged-in users
            $orderData = [
                'user_id' => Auth::id(), // null for guests
                'total_amount' => max($subtotal, 0),
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

            // Record coupon usage
            if ($coupon) {
                CouponUsage::create([
                    'user_id' => Auth::id(),
                    'coupon_id' => $coupon->id,
                    'order_id' => $order->id,
                ]);
                $coupon->increment('used_count');
            }

            DB::commit();

            // Store order ID in session so guests can track after payment
            Session::put('guest_order_id', $order->id);

            if ($request->payment_method == 'paypal') {
                $paymentUrl = $this->paymentService->payWithPayPal($order);
                return redirect()->away($paymentUrl);
            }

            // For stripe, redirect back — the JS modal handles stripe flow
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            Toaster::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Order confirmation page (for guests after successful payment).
     */
    public function success()
    {
        $orderId = Session::get('guest_order_id') ?? session('order_id');
        $order = null;

        if ($orderId) {
            $order = Order::with('items.product')->find($orderId);
        }

        return view('checkout-success', ['order' => $order]);
    }

    /**
     * Guest order tracking — show the lookup form.
     */
    public function trackOrder()
    {
        return view('order-track');
    }

    /**
     * Guest order tracking — find order by email + order ID.
     */
    public function trackOrderPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'order_id' => 'required|integer',
        ]);

        $order = Order::with('items.product', 'payments')
            ->where('id', $request->order_id)
            ->where(function ($query) use ($request) {
                $query->where('guest_email', $request->email)
                      ->orWhereHas('user', function ($q) use ($request) {
                          $q->where('email', $request->email);
                      });
            })
            ->first();

        if (!$order) {
            Toaster::error('Order not found. Please check your email and order number.');
            return redirect()->back();
        }

        return view('order-track-result', ['order' => $order]);
    }
}
