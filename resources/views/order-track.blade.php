@extends('layouts.main')
@section('title', 'Track Your Order')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">Track Your Order</div>
                    <p class="text-center text-2 text_black-2 mt_5">Enter your order number and email to check your order status</p>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing-11">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('order.track.post') }}" class="form-checkout">
                        @csrf
                        <fieldset class="box fieldset">
                            <label for="order_id">Order Number</label>
                            <input type="number" id="order_id" name="order_id" placeholder="e.g. 1234" value="{{ old('order_id') }}" required>
                        </fieldset>
                        <fieldset class="box fieldset">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="The email used during checkout" value="{{ old('email') }}" required>
                        </fieldset>
                        <button type="submit" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center w-100 mt_20">
                            Track Order
                        </button>
                    </form>

                    @auth
                        <div class="text-center mt_20">
                            <p class="text_black-2">Or view all your orders in <a href="{{ route('my-account.orders') }}" class="text-decoration-underline fw-5">My Account</a>.</p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection

