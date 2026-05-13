<!-- mobile menu -->
<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
    <div class="mb-canvas-content">
        <div class="mb-body">
            <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="item-link">Home</a>
                </li>
                <li class="menu-item {{ request()->routeIs('shop') ? 'active' : '' }}">
                    <a href="{{ route('shop') }}" class="item-link">Shop</a>
                </li>
                <li class="menu-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="item-link">About Us</a>
                </li>
                <li class="menu-item {{ request()->routeIs('contacts') ? 'active' : '' }}">
                    <a href="{{ route('contacts') }}" class="item-link">Contacts</a>
                </li>
            </ul>
            <div class="mb-other-content">
                <div class="d-flex group-icon">
                    <a href="{{ auth()->user() === null ? '#login' : route('my-account.wishlist') }}" @guest data-bs-toggle="modal" @endguest class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                </div>
                <div class="mb-notice">
                    <a href="{{ route('contacts') }}" class="text-need">Need help ?</a>
                </div>
                <ul class="mb-info">
                    <li>Address: 1234 Fashion Street, Suite 567, <br> Indianapolis, IN 10001</li>
                    <li>Email: <b>contact@sombos-creations.com</b></li>
                    <li>Phone: <b>(212) 555-1234</b></li>
                </ul>
            </div>
        </div>
        <div class="mb-bottom">
            <a href="{{ auth()->user() === null ? '#login' : route('my-account') }}" @guest  data-bs-toggle="modal" @endguest class="site-nav-icon"><i class="icon icon-account"></i>@guest Login @endguest @auth {{ auth()->user()->firstname }} @endauth</a>
            <div class="bottom-bar-language">
                <div class="tf-currencies">
                    <select class="image-select center style-default type-currencies">
                        <option selected data-thumbnail="{{ asset('images/country/us.svg') }}">USD <span>$ | United States</span></option>
                    </select>
                </div>
                <div class="tf-languages">
                    <select class="image-select center style-default type-languages">
                        <option>English</option>

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /mobile menu -->
