<div wire:ignore.self class="card-product fl-item" data-product-id="{{ $product->id }}" data-availability="{{ $product->stock > 0 ? 'In stock' : 'Out of stock' }}">
    <div class="card-product-wrapper" >
        <a href="{{ route('products', $product->slug) }}" class="product-img">
            <img class="lazyload img-product" data-src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="{{$product->slug}}">
            <img class="img-hover ls-is-cached lazyloaded" data-src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" src="{{ \Illuminate\Support\Facades\Storage::url($product->image)}}" alt="{{$product->slug}}">
        </a>
        @if($product->stock <= 0)
            <div class="on-sale-wrap"><span class="on-sale-item" style="background-color: #dc3545;">Sold Out</span></div>
        @elseif($product->created_at >= now()->subDays(30))
            <div class="on-sale-wrap"><span class="on-sale-item" style="background-color: #28a745;">New</span></div>
        @endif
        <div class="list-product-btn">
            @if($product->stock > 0)
                <a href="javascript:void(0);" wire:click.prevent="addToCart" class="box-icon bg_white quick-add tf-btn-loading">
                    <span class="icon icon-bag"></span>
                    <span class="tooltip">Quick Add</span>
                </a>
            @endif
            <a href="javascript:void(0);" wire:click.prevent="addToWishlist" class="box-icon bg_white wishlist btn-icon-action">
                <span class="icon icon-heart"></span>
                <span class="tooltip">Add to Wishlist</span>
                <span class="icon icon-delete"></span>
            </a>

            <a href="#" wire:click="openQuickView" data-bs-toggle="modal" data-bs-target="#quickViewModal" class="box-icon bg_white quickview tf-btn-loading">
                <span class="icon icon-view"></span>
                <span class="tooltip">Quick View</span>
            </a>
        </div>
    </div>
    <div class="card-product-info">
        <a href="{{ route('products', $product->slug) }}" class="title link">{{ $product->name }}</a>
        <span class="price">{{ $product->getPrice()}}</span>
        @if($product->reviews->count() > 0)
            <div class="d-flex align-items-center gap-5 mt-1">
                @for($i = 1; $i <= 5; $i++)
                    <i class="icon-star" style="font-size: 11px; color: {{ $i <= round($product->reviews->avg('rating')) ? '#f5a623' : '#ddd' }};"></i>
                @endfor
                <span class="text_black-2" style="font-size: 12px;">({{ $product->reviews->count() }})</span>
            </div>
        @endif
    </div>
</div>
