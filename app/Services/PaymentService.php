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
     * Build the PayPal configuration array with sanitized credentials.
     *
     * Shared hosting .env files frequently introduce invisible characters
     * (trailing spaces, CR/LF, BOM, surrounding quotes) into credential
     * values, which makes PayPal return "invalid_client". We trim those out
     * defensively so authentication only fails when credentials are truly wrong.
     */
    private function paypalConfig(): array
    {
        $config = config('paypal');

        $clean = static function (?string $value): string {
            // Remove surrounding whitespace, CR/LF, BOM and accidental quotes.
            $value = (string) $value;
            $value = preg_replace('/^\x{FEFF}/u', '', $value); // strip BOM
            $value = trim($value);
            $value = trim($value, "\"'"); // strip stray quotes

            return trim($value);
        };

        foreach (['sandbox', 'live'] as $mode) {
            if (isset($config[$mode]['client_id'])) {
                $config[$mode]['client_id'] = $clean($config[$mode]['client_id']);
            }
            if (isset($config[$mode]['client_secret'])) {
                $config[$mode]['client_secret'] = $clean($config[$mode]['client_secret']);
            }
        }

        return $config;
    }

    /**
     * Create PayPal order and return the approval URL.
     *
     * @throws \Exception
     */
    public function payWithPayPal(Order $order): string
    {
        $config = $this->paypalConfig();
        $mode = $config['mode'] ?? 'sandbox';

        Log::info('PayPal: Initiating payment', [
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'mode' => $mode,
            'has_client_id' => !empty($config[$mode]['client_id']),
            'has_client_secret' => !empty($config[$mode]['client_secret']),
            'client_id_length' => strlen($config[$mode]['client_id'] ?? ''),
            'client_secret_length' => strlen($config[$mode]['client_secret'] ?? ''),
        ]);

        $provider = new PayPalClient;
        $provider->setApiCredentials($config);

        $token = $provider->getAccessToken();

        if (!$token || isset($token['error'])) {
            Log::error('PayPal: Failed to get access token', [
                'response' => $token,
                'mode' => $mode,
                'client_id_prefix' => substr($config[$mode]['client_id'] ?? '', 0, 10) . '...',
            ]);
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
        $provider->setApiCredentials($this->paypalConfig());
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
