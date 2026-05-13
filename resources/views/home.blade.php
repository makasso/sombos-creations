@extends('layouts.main')
@section('title') Home @endsection
@section('content')
    <!-- Slider -->
    <div class="tf-slideshow slider-effect-fade position-relative">
        <div dir="ltr" class="tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="true" data-auto-play="true" data-delay="0" data-speed="1000">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="wrap-slider">
                        <img src="{{ asset('images/slider/fashion-slideshow-01.png') }}" alt="fashion-slideshow">
                        <div class="box-content">
                            <div class="container">
                                <h1 class="fade-item fade-item-1">Step Into <br>African Fashion</h1>
                                <p class="fade-item fade-item-2"> Speak Your Soul!.</p>
                                <a href="{{ route('shop') }}" class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide ">
                    <div class="wrap-slider">
                        <img src="{{ asset('images/slider/fashion-slideshow-02.png') }}" alt="fashion-slideshow">
                        <div class="box-content">
                            <div class="container">
                                <h1 class="fade-item fade-item-1">Glamorous<br>Glam</h1>
                                <p class="fade-item fade-item-2">From casual to formal, we've got you covered</p>
                                <a href="{{ route('shop') }}" class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="wrap-slider">
                        <img src="{{ asset('images/slider/fashion-slideshow-03.png') }}" alt="fashion-slideshow">
                        <div class="box-content">
                            <div class="container">
                                <h1 class="fade-item fade-item-1">Bold, Beautiful, <br>African</h1>
                                <p class="fade-item fade-item-2">From casual to formal, we've got you covered</p>
                                <a href="{{ route('shop') }}" class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Slider -->

    <!-- Collections Section -->
    <section class="flat-spacing-12">
        <div class="container">
            <div class="flat-title flex-row justify-content-between align-items-center px-0 wow fadeInUp" data-wow-delay="0s">
                <h3 class="title">Unique African Collections</h3>
                <a href="{{ route('collections') }}" class="tf-btn btn-line">View all collections<i class="icon icon-arrow1-top-left"></i></a>
            </div>
            @if(isset($collections))
                @foreach($collections->chunk(2) as $pair)
                    <div class="tf-grid-layout md-col-2 tf-img-with-text style-2 mb-4 home-row-section">
                        @foreach($pair as $index => $collection)
                            @if($loop->first)
                                {{-- Image left --}}
                                <div class="tf-image-wrap rounded overflow-hidden">
                                    <a href="/shop?collection={{ $collection->slug }}">
                                        <img class="lazyload" data-src="{{ \Illuminate\Support\Facades\Storage::url($collection->image) }}" src="{{ \Illuminate\Support\Facades\Storage::url($collection->image) }}" alt="{{ $collection->name }}">
                                    </a>
                                </div>
                                <div class="tf-content-wrap d-flex align-items-center">
                                    <div>
                                        <div class="heading fs-3 fw-5">{{ ucwords($collection->name) }}</div>
                                        <p class="mt-3 text_black-2">{{ $collection->description ?? 'Discover our curated ' . $collection->name . ' collection, celebrating the beauty and diversity of African fashion.' }}</p>
                                        <a href="/shop?collection={{ $collection->slug }}" class="tf-btn btn-line mt-3">Shop {{ ucwords($collection->name) }}<i class="icon icon-arrow1-top-left"></i></a>
                                    </div>
                                </div>
                            @else
                                {{-- Text left --}}
                                <div class="tf-content-wrap d-flex align-items-center">
                                    <div>
                                        <div class="heading fs-3 fw-5">{{ ucwords($collection->name) }}</div>
                                        <p class="mt-3 text_black-2">{{ $collection->description ?? 'Discover our curated ' . $collection->name . ' collection, celebrating the beauty and diversity of African fashion.' }}</p>
                                        <a href="/shop?collection={{ $collection->slug }}" class="tf-btn btn-line mt-3">Shop {{ ucwords($collection->name) }}<i class="icon icon-arrow1-top-left"></i></a>
                                    </div>
                                </div>
                                <div class="tf-image-wrap rounded overflow-hidden">
                                    <a href="/shop?collection={{ $collection->slug }}">
                                        <img class="lazyload" data-src="{{ \Illuminate\Support\Facades\Storage::url($collection->image) }}" src="{{ \Illuminate\Support\Facades\Storage::url($collection->image) }}" alt="{{ $collection->name }}">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    <!-- /Collections Section -->

    <!-- Categories Section -->
    <section class="flat-spacing-4 bg_grey-3">
        <div class="container">
            <div class="flat-title flex-row justify-content-between align-items-center px-0 wow fadeInUp" data-wow-delay="0s">
                <h3 class="title">Discovery all new items</h3>
                <a href="{{ route('shop') }}" class="tf-btn btn-line">See more<i class="icon icon-arrow1-top-left"></i></a>
            </div>
            @foreach($categories->chunk(2) as $pair)
                <div class="tf-grid-layout md-col-2 tf-img-with-text style-2 mb-4 home-row-section">
                    @foreach($pair as $index => $category)
                        @if($loop->first)
                            {{-- Image left --}}
                            <div class="tf-image-wrap rounded overflow-hidden">
                                <a href="/shop?category={{ $category->id }}">
                                    <img class="lazyload" data-src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" alt="{{ $category->name }}">
                                </a>
                            </div>
                            <div class="tf-content-wrap d-flex align-items-center">
                                <div>
                                    <div class="heading fs-3 fw-5">{{ ucwords($category->name) }}</div>
                                    <p class="mt-3 text_black-2">{{ $category->description ?? 'Explore our ' . $category->name . ' category for unique African-inspired pieces.' }}</p>
                                    <a href="/shop?category={{ $category->id }}" class="tf-btn btn-line mt-3">Shop {{ ucwords($category->name) }}<i class="icon icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        @else
                            {{-- Text left --}}
                            <div class="tf-content-wrap d-flex align-items-center">
                                <div>
                                    <div class="heading fs-3 fw-5">{{ ucwords($category->name) }}</div>
                                    <p class="mt-3 text_black-2">{{ $category->description ?? 'Explore our ' . $category->name . ' category for unique African-inspired pieces.' }}</p>
                                    <a href="/shop?category={{ $category->id }}" class="tf-btn btn-line mt-3">Shop {{ ucwords($category->name) }}<i class="icon icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                            <div class="tf-image-wrap rounded overflow-hidden">
                                <a href="/shop?category={{ $category->id }}">
                                    <img class="lazyload" data-src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" alt="{{ $category->name }}">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
    <!-- /Categories Section -->


    <!-- Sale Product -->
    <section class="flat-spacing-17">
        <div class="container">
            <div class="flat-animate-tab">
                <ul class="widget-tab-2 d-flex justify-content-center wow fadeInUp" data-wow-delay="0s" role="tablist">
                    <li class="nav-tab-item" role="presentation">
                        <a href="#bestSeller" class="active" data-bs-toggle="tab">Best seller</a>
                    </li>
                    <li class="nav-tab-item" role="presentation">
                        <a href="#newArrivals"  data-bs-toggle="tab">New arrivals</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="bestSeller" role="tabpanel">
                        <div class="grid-layout loadmore-item" data-grid="grid-4">
                           @foreach($products as $product)
                                <!-- card product -->
                                @livewire('product-card', ['product' => $product], key($product->id))
                           @endforeach
                        </div>
                        <div class="tf-pagination-wrap view-more-button text-center">
                            <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore "><span class="text">Load more</span></button>
                        </div>
                    </div>
                    <div class="tab-pane" id="newArrivals" role="tabpanel">
                        <div class="grid-layout loadmore-item2" data-grid="grid-4">
                            @foreach($newArrivals as $product)
                                <!-- card product 1 -->
                                @livewire('product-card', ['product' => $product], key($product->id))

                            @endforeach
                        <div class="tf-pagination-wrap view-more-button2 text-center">
                            <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore2"><span class="text">Load more</span></button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- /Sale Product -->

    <!-- Icon box -->
    <section class="flat-spacing-1 flat-iconbox">
        <div class="container">
            <div class="wrap-carousel wrap-mobile wow fadeInUp" data-wow-delay="0s">
                <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                    <div class="swiper-wrapper wrap-iconbox">
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon">
                                    <i class="icon-shipping"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-4">Shipping</div>
                                    <p>Free shipping for order over $120</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon">
                                    <i class="icon-payment fs-22"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-4">Flexible Payment</div>
                                    <p>Pay with Multiple Credit Cards</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon">
                                    <i class="icon-return fs-20"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-4">14 Day Returns</div>
                                    <p>Within 30 days for an exchange</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-row">
                                <div class="icon">
                                    <i class="icon-suport"></i>
                                </div>
                                <div class="content">
                                    <div class="title fw-4">Premium Support</div>
                                    <p>Outstanding premium support</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Icon box -->
    <!-- Location -->
    <section>
        <div class="container">
            <div class="flat-location">
                <div class="banner-map overflow-x-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d196237.185003195!2d-86.29756082989212!3d39.77993181458865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886b50ffa7796a03%3A0xd68e9df640b9ea7c!2sIndianapolis%2C%20IN%2C%20USA!5e0!3m2!1sen!2scm!4v1735574156332!5m2!1sen!2scm" width="1525" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="content">
                    <h3 class="heading wow fadeInUp" data-wow-delay="0s">Sombos Creations</h3>
                    <p class="subtext wow fadeInUp" data-wow-delay="0s">
                        2345 Main Street, Indianapolis, IN 46202
                        <br>
                        contact@sombos-creations.com
                        <br>
                        (08) 8942 1299
                    </p>
                    <p class="subtext wow fadeInUp" data-wow-delay="0s">
                        Mon - Fri, 8:30am - 5:30pm
                        <br>
                        Saturday, 8:30am - 5:30pm
                        <br>
                        Sunday Closed
                    </p>
                    <a href="https://maps.app.goo.gl/3ShQUXSn2vHcU2eY8" target="_self" class="tf-btn btn-line collection-other-link fw-6 wow fadeInUp" data-wow-delay="0s">Get Directions<i class="icon icon-arrow1-top-left"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Location -->
@endsection

@push('styles')
    <style>

        /* Default styles */
        .tf-slideshow .swiper-slide img {
            width: 100%;
            object-fit: cover;
        }

        /* Home row sections - image + text side by side */
        .home-row-section {
            min-height: auto;
            margin-bottom: 30px !important;
        }
        .home-row-section .tf-image-wrap {
            height: 280px;
            overflow: hidden;
            border-radius: 8px;
        }
        .home-row-section .tf-image-wrap a {
            display: block;
            width: 100%;
            height: 100%;
        }
        .home-row-section .tf-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 8px;
        }
        .home-row-section .tf-content-wrap {
            padding: 30px 40px;
        }
        .home-row-section .tf-content-wrap .heading {
            font-family: 'Playfair Display SC', sans-serif;
            margin-bottom: 10px;
        }
        .home-row-section .tf-content-wrap p {
            line-height: 1.7;
            color: var(--text);
        }
        .home-row-section .tf-btn.btn-line {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
        }

        /* Mobile-specific styles */
        @media (max-width: 768px) {
            .tf-slideshow .swiper-slide img {
                object-position: right center;
            }
            .tf-slideshow .wrap-slider .box-content {
                top: 60%;
            }
            .home-row-section {
                min-height: auto;
            }
            .home-row-section .tf-image-wrap {
                min-height: 250px;
            }
            .home-row-section .tf-content-wrap {
                padding: 20px 15px;
            }
        }
    </style>
@endpush
