@extends('layouts.my-account')
@section('title2', 'Dashboard')

@section('my-account-content')
    <div class="my-account-content account-dashboard">
        <div class="mb_60">
            <h5 class="fw-5 mb_20">Hello {{ auth()->user()->firstname }}</h5>
            <p>
                From your account dashboard you can view your <a class="text_primary" href="{{ route('my-account.orders') }}">recent orders</a>, manage and <a class="text_primary" href="{{ route('my-account.account-details') }}">edit your password and account details</a>.
            </p>
        </div>
    </div>
@endsection
