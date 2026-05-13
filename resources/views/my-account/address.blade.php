@extends('layouts.my-account')
@section('title2', 'Address')

@section('my-account-content')
    <div class="my-account-content account-address">
        <div class="mb_20">
            <h6 class="fw-5 mb_10">Shipping Address</h6>
        </div>
        @if(auth()->user()->address)
            <div class="p-4 mb_20" style="background: #f8f9fa; border-radius: 8px;">
                <p class="fw-6">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                <p class="text_black-2 mt_5">{{ auth()->user()->address }}</p>
                @if(auth()->user()->phone)
                    <p class="text_black-2 mt_5">{{ auth()->user()->phone }}</p>
                @endif
                <p class="text_black-2 mt_5">{{ auth()->user()->email }}</p>
            </div>
            <a href="{{ route('my-account.account-details') }}" class="tf-btn radius-3 btn-fill animate-hover-btn">
                Edit Address
            </a>
        @else
            <div class="p-4 mb_20" style="background: #fff3cd; border-radius: 8px;">
                <p class="text_black-2">You have not set up an address yet.</p>
            </div>
            <a href="{{ route('my-account.account-details') }}" class="tf-btn radius-3 btn-fill animate-hover-btn">
                Add Address
            </a>
        @endif
    </div>
@endsection
