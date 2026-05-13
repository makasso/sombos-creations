<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentService
{
    /**
     * Create PayPal order and return the approval URL.
     *
     * @throws \Exception
     */
    public function payWithPayPal(Order $order): string
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        $token = $provider->getAccessToken();

        if (!$token || isset($token['error'])) {
            Log::error('PayPal: Failed to get access token', ['response' => $token]);
            throw new \Exception('Unable to connect to PayPal. Please try again later.');
        }

        $paypalOrder = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => "order-" . $order->id,
                    "description" => "Sombos Creations - Order #{$order->id}",
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($order->total_amount, 2, '.', ''),
                    ]
                ]
            ],
            "application_context" => [
                "brand_name" => "Sombos Creations",
                "return_url" => route('paypal.success', ['order_id' => $order->id]),
                "cancel_url" => route('paypal.cancel'),
                "shipping_preference" => "NO_SHIPPING",
                "user_action" => "PAY_NOW",
            ],
        ]);

        // Log the full response for debugging
        Log::info('PayPal createOrder response', ['response' => $paypalOrder]);

        // Check for errors in the response
        if (isset($paypalOrder['error'])) {
            Log::error('PayPal: Order creation error', ['error' => $paypalOrder['error']]);
            throw new \Exception('PayPal error: ' . ($paypalOrder['error']['message'] ?? 'Unknown error'));
        }

        if (!isset($paypalOrder['links']) || !is_array($paypalOrder['links'])) {
            Log::error('PayPal: No links in response', ['response' => $paypalOrder]);
            throw new \Exception('PayPal did not return a valid payment URL. Please check your PayPal credentials.');
        }

        // Find the approval URL
        foreach ($paypalOrder['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return $link['href'];
            }
        }

        throw new \Exception('PayPal approval URL not found in response.');
    }

    /**
     * Capture PayPal payment after buyer approval.
     *
     * @throws \Exception
     */
    public function capturePayPal(string $token): array
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($token);

        Log::info('PayPal capture response', ['response' => $response]);

        if (!isset($response['status']) || $response['status'] !== 'COMPLETED') {
            Log::error('PayPal: Capture failed', ['response' => $response]);
            throw new \Exception('PayPal payment was not completed.');
        }

        return $response;
    }

    /**
     * Process Stripe payment.
     *
     * @throws \Exception
     */
    public function payWithStripe(Order $order, string $stripeToken): string
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $charge = Charge::create([
            'amount' => (int) ($order->total_amount * 100), // cents
            'currency' => 'usd',
            'description' => "Sombos Creations - Order #{$order->id}",
            'source' => $stripeToken,
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

        if ($charge->status !== 'succeeded') {
            throw new \Exception('Stripe payment failed.');
        }

        return $charge->id;
    }

    /**
     * Mark order as paid, record payment, decrement stock, clear cart.
     */
    public function finalizePayment(Order $order, string $transactionId, string $paymentMethod): void
    {
        DB::beginTransaction();

        try {
            $order->update(['payment_status' => 'paid']);

            Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total_amount,
                'payment_method' => $paymentMethod,
                'status' => 'completed',
                'transaction_id' => $transactionId,
            ]);

            // Decrement stock
            foreach ($order->items as $item) {
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            }
            Session::forget('cart');
            Session::forget('guest_order_id');

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Payment finalization failed', ['order_id' => $order->id, 'error' => $e->getMessage()]);
            throw $e;
        }
    }
}
