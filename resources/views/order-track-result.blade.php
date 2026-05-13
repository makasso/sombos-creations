@extends('layouts.main')
@section('title', 'Order #' . $order->id)

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">Order #{{ $order->id }}</div>
                    <p class="text-center text-2 text_black-2 mt_5">Order details and status</p>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    {{-- Order Status --}}
                    <div class="p-4 mb_20" style="background: #f8f9fa; border-radius: 8px;">
                        <div class="d-flex justify-content-between align-items-center mb_10">
                            <h5 class="fw-5">Order Summary</h5>
                            <span class="badge {{ $order->status === 'delivered' ? 'bg-success' : ($order->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }} p-2">
                                {{ ucfirst($order->status ?? 'pending') }}
                            </span>
                        </div>
                        <p class="text_black-2 mb_5"><strong>Date:</strong> {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                        <p class="text_black-2 mb_5"><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                        @if($order->payments->isNotEmpty())
                            <p class="text_black-2 mb_5"><strong>Payment Method:</strong> {{ $order->payments->first()->payment_method }}</p>
                        @endif
                        <p class="text_black-2 mb_5"><strong>Shipping Address:</strong> {{ $order->getFullAddress() }}</p>
                        <p class="text_black-2"><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                    </div>

                    {{-- Order Items --}}
                    <div class="mb_20">
                        <h6 class="fw-5 mb_10">Items</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <img src="{{ $item->product->getImage() }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                        <td class="text-end">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-5">Total</td>
                                    <td class="text-end fw-5">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('shop') }}" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn">Continue Shopping</a>
                        <a href="{{ route('order.track') }}" class="tf-btn radius-3 btn-outline btn-icon animate-hover-btn ms-2">Track Another Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

