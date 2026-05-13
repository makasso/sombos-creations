@extends('layouts.main')
@section('title', 'Order Confirmed')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">Order Confirmed</div>
                    <p class="text-center text-2 text_black-2 mt_5">Thank you for your purchase!</p>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb_40">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>

                    @if($order)
                        <div class="p-4 mb_20" style="background: #f8f9fa; border-radius: 8px;">
                            <h5 class="fw-5 mb_10">Order #{{ $order->id }}</h5>
                            <p class="text_black-2 mb_5"><strong>Status:</strong> {{ ucfirst($order->status ?? 'pending') }}</p>
                            <p class="text_black-2 mb_5"><strong>Payment:</strong> {{ ucfirst($order->payment_status) }}</p>
                            <p class="text_black-2 mb_5"><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                            <p class="text_black-2"><strong>Shipping to:</strong> {{ $order->getFullAddress() }}</p>
                        </div>

                        <div class="mb_20">
                            <h6 class="fw-5 mb_10">Items Ordered</h6>
                            <ul class="wrap-checkout-product">
                                @foreach($order->items as $item)
                                    <li class="checkout-product-item d-flex align-items-center mb_10">
                                        <figure class="img-product me-3">
                                            <img src="{{ $item->product->getImage() }}" alt="{{ $item->product->name }}" style="width: 60px; height: 60px; object-fit: cover;">
                                            <span class="quantity">{{ $item->quantity }}</span>
                                        </figure>
                                        <div class="content d-flex justify-content-between w-100">
                                            <p class="name">{{ $item->product->name }}</p>
                                            <span class="price">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @guest
                            <div class="p-3 mb_20" style="background: #fff3cd; border-radius: 8px;">
                                <p class="mb_5"><strong>Save your order number: #{{ $order->id }}</strong></p>
                                <p class="text_black-2">You can use it with your email to <a href="{{ route('order.track') }}" class="text-decoration-underline fw-5">track your order</a>.</p>
                                <p class="text_black-2 mt_5">Want to manage all your orders? <a href="{{ route('home') }}#register" class="text-decoration-underline fw-5">Create an account</a>.</p>
                            </div>
                        @endguest
                    @else
                        <div class="text-center">
                            <p class="text_black-2 mb_20">Your order has been placed successfully.</p>
                        </div>
                    @endif

                    <div class="text-center">
                        <a href="{{ route('shop') }}" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn">Continue Shopping</a>
                        @guest
                            <a href="{{ route('order.track') }}" class="tf-btn radius-3 btn-outline btn-icon animate-hover-btn ms-2">Track Order</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

