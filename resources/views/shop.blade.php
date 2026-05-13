@extends('layouts.main')
@section('title', 'Shop African Fashion')
@section('meta_description', 'Browse our collection of authentic African dresses, jewelry, accessories, hats and more. Free shipping on select items.')
@section('og_title', 'Shop — Sombos Creations')
@section('og_description', 'Browse our collection of authentic African dresses, jewelry, accessories, hats and more.')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">Shop</div>
                    <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of African Fashion</p>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing-1">
        <div class="container">
            <div class="tf-shop-control grid-3 align-items-center">
                <div class="tf-control-filter">
                    <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">Filter</span></a>
                </div>
                <ul class="tf-control-layout d-flex justify-content-center">

                    <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                        <div class="item"><span class="icon icon-grid-2"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-3" data-value-layout="tf-col-3">
                        <div class="item"><span class="icon icon-grid-3"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-4 active" data-value-layout="tf-col-4">
                        <div class="item"><span class="icon icon-grid-4"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-5" data-value-layout="tf-col-5">
                        <div class="item"><span class="icon icon-grid-5"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-6" data-value-layout="tf-col-6">
                        <div class="item"><span class="icon icon-grid-6"></span></div>
                    </li>
                </ul>
                <div class="tf-control-sorting d-flex justify-content-end">
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">{{ request('sort') ? match(request('sort')) {
                                'a-z' => 'Alphabetically, A-Z',
                                'z-a' => 'Alphabetically, Z-A',
                                'price-low-high' => 'Price, low to high',
                                'price-high-low' => 'Price, high to low',
                                'best-selling' => 'Best selling',
                                'date-old-new' => 'Date, old to new',
                                default => 'Featured'
                            } : 'Featured' }}</span>
                            <span class="icon icon-arrow-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="select-item {{ !request('sort') ? 'active' : '' }}">
                                <span class="text-value-item">Featured</span>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'best-selling']) }}" class="select-item {{ request('sort') === 'best-selling' ? 'active' : '' }}">
                                <span class="text-value-item">Best selling</span>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'a-z']) }}" class="select-item {{ request('sort') === 'a-z' ? 'active' : '' }}">
                                <span class="text-value-item">Alphabetically, A-Z</span>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'z-a']) }}" class="select-item {{ request('sort') === 'z-a' ? 'active' : '' }}">
                                <span class="text-value-item">Alphabetically, Z-A</span>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price-low-high']) }}" class="select-item {{ request('sort') === 'price-low-high' ? 'active' : '' }}">
                                <span class="text-value-item">Price, low to high</span>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price-high-low']) }}" class="select-item {{ request('sort') === 'price-high-low' ? 'active' : '' }}">
                                <span class="text-value-item">Price, high to low</span>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'date-old-new']) }}" class="select-item {{ request('sort') === 'date-old-new' ? 'active' : '' }}">
                                <span class="text-value-item">Date, old to new</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-control-shop gridLayout-wrapper">
                <div class="meta-filter-shop" style="display: none;">
                    <div id="product-count-grid" class="count-text"><span class="count">12</span> Products Found</div>
                    <div id="product-count-list" class="count-text"><span class="count">8</span> Products Found</div>
                    <div id="applied-filters"></div>
                    <button id="remove-all" class="remove-all-filters" style="display: none;">Remove All <i class="icon icon-close"></i></button>
                </div>
                <div class="tf-grid-layout wrapper-shop tf-col-4" id="gridLayout">
                    @foreach($products as $product)
                        <!-- card product 1 -->
                        <livewire:product-card :product="$product" wire:key="{{ $product->id }}"></livewire:product-card>
                    @endforeach
{{--            Paginations        --}}
                    {{ $products->links('vendor.pagination.theme') }}

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/nouislider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/shop.js') }}"></script>
@endpush
