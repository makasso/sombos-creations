@extends('layouts.my-account')
@section('title2', 'Order Details')

@section('my-account-content')
    <div class="wd-form-order">
        <div class="order-head">
            <figure class="img-product">
                <img src="{{ asset('images/logo/logo.svg') }}" alt="product">
            </figure>
            <div class="content">
                <div class="badge">{{ ucwords($order->status) }}</div>
                <h6 class="mt-8 fw-5">Order #{{ $order->id }}</h6>
            </div>
        </div>
        <div class="tf-grid-layout md-col-2 gap-15">
            <div class="item">
                <div class="text-2 text_black-2">Customer</div>
                <div class="text-2 mt_4 fw-6">{{ $order->user->firstname . ' ' . $order->user->lastname }}</div>
            </div>
            <div class="item">
                <div class="text-2 text_black-2">Products</div>
                @foreach($order->items as $item)
                    <div class="text-2 mt_4 fw-6">{{ $item->product->name  }}</div>
                @endforeach
            </div>
            <div class="item">
                <div class="text-2 text_black-2">Order Date</div>
                <div class="text-2 mt_4 fw-6">{{ $order->created_at->format('d F Y, H:i:s') }}</div>
            </div>
            <div class="item">
                <div class="text-2 text_black-2">Address</div>
                <div class="text-2 mt_4 fw-6">{{ $order->user->address ?? 'Unknown' }}</div>
            </div>
        </div>
        <div class="widget-tabs style-has-border widget-order-tab">
            <ul class="widget-menu-tab">

                <li class="item-title active">
                    <span class="inner">Item Details</span>
                </li>
            </ul>
            <div class="widget-content-tab">
                <div class="widget-content-inner active">
                    @foreach($order->items as $item)
                        <div class="order-head">
                            <figure class="img-product">
                                <img src="{{ $item->product->getImage() }}" alt="product">
                            </figure>
                            <div class="content">
                                <div class="text-2 fw-6">{{ $item->product->name }}</div>
                                <div class="mt_4"><span class="fw-6">Price :</span> {{ $item->product->getPrice() }}</div>
{{--                                <div class="mt_4"><span class="fw-6">Size :</span> XL</div>--}}
                            </div>
                        </div>
                    @endforeach

                    <ul>
                        <li class="d-flex justify-content-between text-2">
                            <span>Total Price</span>
                            <span class="fw-6">${{ $order->total_amount }}</span>
                        </li>
                       @if($order->couponUsages->where('order_id', $order->id)->first())
                           @php
                               $coupon = $order->couponUsages->where('order_id', $order->id)->first();
                           @endphp
                            <li class="d-flex justify-content-between text-2 mt_4 pb_8 line">
                                <span>Total Discounts</span>
                                <span class="fw-6">${{ $coupon->coupon->discount }}</span>

                            </li>
                       @endif
                        <li class="d-flex justify-content-between text-2 mt_8">
                            <span>Order Total</span>
                           @if(isset($coupon))
                                <span class="fw-6">${{ $order->total_amount - $coupon->coupon->discount }}</span>
                           @else
                                <span class="fw-6">${{ $order->total_amount }}</span>
                           @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
