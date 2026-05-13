@extends('layouts.main')
@section('title') Product Details @endsection

@section('content')

    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                <div class="tf-breadcrumb-list">
                    <a href="{{ route('home') }}" class="text">Home</a>
                    <i class="icon icon-arrow-right"></i>
                    <span class="text">{{ $product->name }}</span>
                </div>
                <div class="tf-breadcrumb-prev-next">
                    <a href="{{ $previousProduct !== null ? route('products', $previousProduct->slug)  : '#' }}" class="tf-breadcrumb-prev hover-tooltip center">
                        <i class="icon icon-arrow-left"></i>
                        <!-- <span class="tooltip">Cotton jersey top</span> -->
                    </a>
                    <a href="{{ route('shop') }}" class="tf-breadcrumb-back hover-tooltip center">
                        <i class="icon icon-shop"></i>
                        <!-- <span class="tooltip">Back to Women</span> -->
                    </a>
                    <a href="{{ $nextProduct !== null ? route('products', $nextProduct->slug)  : '#' }}" class="tf-breadcrumb-next hover-tooltip center">
                        <i class="icon icon-arrow-right"></i>
                        <!-- <span class="tooltip">Cotton jersey top</span> -->
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing-4 pt_0">
        <livewire:single-product :product="$product"></livewire:single-product>
    </section>

    <section class="flat-spacing-1 pt_0">
        <div class="container">
            <div class="flat-title">
                <span class="title">People Also Bought</span>
            </div>
            <div class="hover-sw-nav hover-sw-2">
                <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                    <div class="swiper-wrapper" id="swiper-wrapper-6660745b9f3277b2" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                        @foreach($otherProducts as $key => $product)
                            <div class="swiper-slide {{ $key === 0 ? 'swiper-slide-active' : '' }} {{ $key === 1 ? 'swiper-slide-next' : '' }}" lazy="true" style="width: 332.25px; margin-right: 30px;" role="group" aria-label="1 / 6">
                                <livewire:product-card :product="$product" wire:key="{{ $product->id }}"></livewire:product-card>
                            </div>
                        @endforeach

                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-6660745b9f3277b2" aria-disabled="true"><span class="icon icon-arrow-left"></span></div>
                <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-6660745b9f3277b2" aria-disabled="false"><span class="icon icon-arrow-right"></span></div>
                <div class="sw-dots style-2 sw-pagination-product justify-content-center swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span></div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/zoom.js') }}"></script>
    <script src="{{ asset('js/model-viewer.min.js') }}"></script>

@endpush
