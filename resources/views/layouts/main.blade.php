<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Sombos Creations - @yield('title', 'African Fashion & Accessories')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Sombos Creations — Discover authentic African fashion: dresses, jewelry, accessories, hats and more. Express your soul through African style.')">
    <meta name="keywords" content="@yield('meta_keywords', 'african fashion, african dresses, african jewelry, african accessories, african hats, sombos creations, african clothing, african style')">
    <meta name="author" content="Sombos Creations">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Sombos Creations — Step Into African Fashion')">
    <meta property="og:description" content="@yield('og_description', 'Discover authentic African fashion: dresses, jewelry, accessories, hats and more. Express your soul through African style.')">
    <meta property="og:image" content="@yield('og_image', asset('images/slider/fashion-slideshow-01.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Sombos Creations">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Sombos Creations — Step Into African Fashion')">
    <meta name="twitter:description" content="@yield('og_description', 'Discover authentic African fashion: dresses, jewelry, accessories, hats and more. Express your soul through African style.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/slider/fashion-slideshow-01.png'))">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/favicon.png') }}">



    @livewireStyles
    @stack('styles')


</head>

<body class="preload-wrapper">
<!-- preload -->
<div class="preload preload-container">
    <div class="preload-logo">
        <div class="spinner"></div>
    </div>
</div>
<!-- /preload -->
<div id="wrapper">

    @php
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Session;

        $subTotal = 0;

        if (Auth::check()) {
            $items = auth()->user()->cart()->with('product')->get();
        } else {
            $items = collect(Session::get('cart', []));
        }
    @endphp


    @include('partials.header')

    @yield('content')

    @include('partials.footer')

</div>

<!-- gotop -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
    </svg>
</div>
<!-- /gotop -->


@include('partials.mobile-menu')

@include('modals.canvas-search')
{{--@include('modals.toolbar-shop')--}}
@include('modals.login')
<livewire:modals.shopping-cart></livewire:modals.shopping-cart>
<livewire:modals.quick-view></livewire:modals.quick-view>
@include('modals.find-size')
@include('modals.filter-shop')

<!-- Javascript -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lazysize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/count-down.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/drift.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/nouislider.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/multiple-modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

@livewireScripts
<x-toaster-hub />


<script>
    Livewire.on('cart:count', (count) => {
        $('#shoppingCartCount').text(count);
    });

    Livewire.on('wishlist:updated', (count) => {
        $('#wishlistCount').text(count);
    });
</script>
@stack('scripts')

</body>

</html>
