@extends('layouts.main')
@section('title', 'Cart')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">Cart</div>
                    <p class="text-center text-2 text_black-2 mt_5">Your shopping cart</p>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing-11">
        <div class="container">
            <livewire:cart-component></livewire:cart-component>

        </div>
    </section>

@endsection
