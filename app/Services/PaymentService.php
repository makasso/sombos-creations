<?php

namespace App\Services;

use App\Models\Order;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentService
{

    public function payWithPayPal(Order $order)
    {
        // Create a new instance of the PayPal client
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        // Create the order with required parameters
        $paypalOrder = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $order->total_amount,
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('paypal.success', ['order_id' => $order->id]),
                "cancel_url" => route('paypal.cancel'),
            ],
        ]);

        // Look for the approval link in the order response
        $approvalUrl = null;
        foreach ($paypalOrder['links'] as $link) {
            if ($link['rel'] === 'approve') {
                $approvalUrl = $link['href'];

                return $approvalUrl;
            }
        }
    }
}
