<x-mail::message>
# Order Status Update

Hello {{ $order->getCustomerName() }},

Your order **#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}** has been updated.

<x-mail::panel>
**Status changed:** {{ ucfirst($oldStatus) }} → **{{ ucfirst($newStatus) }}**
</x-mail::panel>

@if($newStatus === 'processing')
Your order is now being prepared for shipment.
@elseif($newStatus === 'shipped')
Great news! Your order has been shipped and is on its way to you.
@elseif($newStatus === 'delivered')
Your order has been delivered. We hope you enjoy your purchase!
@elseif($newStatus === 'cancelled')
Unfortunately, your order has been cancelled. If you have questions, please contact us.
@endif

| Detail | Value |
|--------|-------|
| Order Total | ${{ number_format($order->total_amount, 2) }} |
| Shipping Address | {{ $order->shipping_address }} |

@if(!$order->isGuest())
<x-mail::button :url="url('/my-account/orders/' . $order->id)">
View Order Details
</x-mail::button>
@else
<x-mail::button :url="url('/order/track')">
Track Your Order
</x-mail::button>
@endif

Thank you for shopping with us!<br>
{{ config('app.name') }}
</x-mail::message>
