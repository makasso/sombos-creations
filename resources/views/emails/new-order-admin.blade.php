<x-mail::message>
# New Order Received! 🎉

A new order has been placed on your store.

**Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}**

| Detail | Value |
|--------|-------|
| Customer | {{ $order->getCustomerName() }} |
| Email | {{ $order->getCustomerEmail() }} |
| Type | {{ $order->isGuest() ? 'Guest' : 'Registered' }} |
| Total | ${{ number_format($order->total_amount, 2) }} |
| Date | {{ $order->created_at->format('M d, Y H:i') }} |
| Shipping Address | {{ $order->shipping_address }} |

<x-mail::button :url="url('/admin/orders/' . $order->id)">
View Order in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
