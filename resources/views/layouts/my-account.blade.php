@extends('layouts.main')
@section('title') My Account - @yield('title2') @endsection

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">My Account / @yield('title2')</div>
        </div>
    </div>

    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="wrap-sidebar-account">
                        <ul class="my-account-nav">
                            <li>
                                @if(request()->routeIs('my-account'))
                                    <span class="my-account-nav-item active">Dashboard</span>
                                @else
                                    <a href="{{ route('my-account') }}" class="my-account-nav-item">Dashboard</a>

                                @endif
                            </li>
                            <li>
                                @if(request()->routeIs('my-account.orders') || request()->routeIs('my-account.orders.details'))
                                    <span class="my-account-nav-item active">Orders</span>
                                @else
                                    <a href="{{ route('my-account.orders') }}" class="my-account-nav-item">Orders</a>

                                @endif
                            </li>
                            <li>
                                @if(request()->routeIs('my-account.account-details'))
                                    <span class="my-account-nav-item active">Account Details</span>
                                @else
                                    <a href="{{ route('my-account.account-details') }}" class="my-account-nav-item">Account Details</a>

                                @endif
                            </li>
                            <li>
                                @if(request()->routeIs('my-account.wishlist'))
                                    <span class="my-account-nav-item active">Wishlist</span>
                                @else
                                    <a href="{{ route('my-account.wishlist') }}" class="my-account-nav-item">Wishlist</a>

                                @endif
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="my-account-nav-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    @yield('my-account-content')
                </div>
            </div>
        </div>
    </section>
@endsection
