@php
    $images = \App\Models\ProductImage::where('product_id', $product->id)->get();
@endphp
<div class="tf-main-product">
    <div class="container">
        <div class="row">
            {{--<div class="col-md-6">
                <div class="tf-product-media-wrap sticky-top">
                    <div class="thumbs-slider">
                        <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom swiper-initialized swiper-vertical swiper-pointer-events swiper-free-mode swiper-watch-progress swiper-thumbs" data-direction="vertical">
                            <div class="swiper-wrapper stagger-wrap" id="swiper-wrapper-d9f48536cfcaaa39" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">

                                @php
                                    $images = \App\Models\ProductImage::where('product_id', $product->id)->get();
                                @endphp

                                <div class="swiper-slide stagger-item swiper-slide-active swiper-slide-thumb-active stagger-finished swiper-slide-visible"  role="group" style="transition-delay: 1.2s; margin-bottom: 10px;">
                                    <div class="item">
                                        <img class=" ls-is-cached lazyloaded" data-src="{{ $product->getImage() }}" src="{{ $product->getImage() }}" alt="img-product">
                                    </div>
                                </div>
                                @foreach($images as $key => $image)
                                    <div class="swiper-slide stagger-item stagger-finished swiper-slide-visible"  role="group" style="transition-delay: 1.2s; margin-bottom: 10px;">
                                        <div class="item">
                                            <img class=" ls-is-cached lazyloaded" data-src="{{ $image->getImage() }}" src="{{ $image->getImage() }}" alt="img-product">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                        <div dir="ltr" class="swiper tf-product-media-main swiper-initialized swiper-horizontal swiper-pointer-events" id="gallery-swiper-started">
                            <div class="swiper-wrapper"  style="transform: translate3d(0px, 0px, 0px);">


                                <div class="swiper-slide swiper-slide-active" style="width: 597px;">
                                    <a href="{{ $product->getImage() }}" target="_blank" class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                        <img class="tf-image-zoom ls-is-cached lazyloaded" data-zoom="{{ $product->getImage() }}" data-src="{{ $product->getImage() }}" src="{{ $product->getImage() }}" alt="">
                                    </a>
                                </div>

                                @foreach($images as $image)
                                    <div class="swiper-slide" style="width: 597px;">
                                        <a href="{{ $image->getImage() }}" target="_blank" class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                            <img class="tf-image-zoom ls-is-cached lazyloaded" data-zoom="{{ $image->getImage() }}" data-src="{{ $image->getImage() }}" src="{{ $image->getImage() }}" alt="">
                                        </a>
                                    </div>
                                @endforeach
                                <!-- beige -->


                            </div>
                            <div class="swiper-button-next button-style-arrow thumbs-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-a7dc8d1352967cc3" aria-disabled="false"></div>
                            <div class="swiper-button-prev button-style-arrow thumbs-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-a7dc8d1352967cc3" aria-disabled="true"></div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                    </div>
                </div>
            </div>--}}

            <div class="col-md-6">
                <div class="tf-product-media-wrap wrapper-gallery-scroll">
                    <div class="mb_10">
                        <a href="{{ $product->getImage() }}" target="_blank" data-color="beige" class="item item-img-color" data-pswp-width="770px" data-pswp-height="1075px">
                            <img class="tf-image-zoom ls-is-cached lazyloaded" data-zoom="{{ $product->getImage() }}" data-src="{{ $product->getImage() }}" src="{{ $product->getImage() }}" alt="">
                        </a>
                    </div>

                    <div class="d-grid grid-template-columns-2 gap-10" id="gallery-started">
                        @foreach($images as $image)
                            <a href="{{ $image->getImage() }}" target="_blank" data-color="beige" class="item item-img-color" data-pswp-width="770px" data-pswp-height="1075px">
                                <img class="radius-10 tf-image-zoom ls-is-cached lazyloaded" data-zoom="{{ $image->getImage() }}" data-src="{{ $image->getImage() }}" src="{{ $image->getImage() }}" alt="img-product">
                            </a>
                        @endforeach


                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="tf-product-info-wrap position-relative">
                    <div class="tf-zoom-main"></div>
                    <div class="tf-product-info-list other-image-zoom">
                        <div class="tf-product-info-title">
                            <h5>{{ $product->name }}</h5>
                        </div>
                        {{-- <div class="tf-product-info-badges">
                             <div class="badges">Best seller</div>
                             <div class="product-status-content">
                                 <i class="icon-lightning"></i>
                                 <p class="fw-6">Selling fast! 56 people have  this in their carts.</p>
                             </div>
                         </div>--}}
                        <div class="tf-product-info-price">
                            <div class="price-on-sale">{{ $product->getPrice() }}</div>

                        </div>
                        {{--<div class="tf-product-info-liveview">
                            <div class="liveview-count">20</div>
                            <p class="fw-6">People are viewing this right now</p>
                        </div>--}}

                        {{-- Product Attributes (Color, Size, etc.) --}}
                        @php
                            $productAttributes = $product->attributes()->with('attribute')->get()->groupBy(fn($val) => $val->attribute->name);
                        @endphp
                        @if($productAttributes->count() > 0)
                            <div class="tf-product-info-variant-picker">
                                @foreach($productAttributes as $attrName => $values)
                                    <div class="variant-picker-item">
                                        <div class="variant-picker-label">
                                            {{ $attrName }}: <span class="fw-6 variant-picker-label-value">{{ $values->first()->value }}</span>
                                        </div>
                                        <div class="variant-picker-values">
                                            @foreach($values as $val)
                                                @if(strtolower($attrName) === 'color')
                                                    <span class="hover-tooltip radius-60 color-btn {{ $loop->first ? 'active' : '' }}" style="display:inline-block; width:30px; height:30px; border-radius:50%; border:2px solid {{ $loop->first ? '#333' : '#ddd' }}; background-color:{{ strtolower($val->value) }}; cursor:default;" title="{{ ucwords($val->value) }}"></span>
                                                @else
                                                    <span class="style-text size-btn {{ $loop->first ? 'active' : '' }}" style="display:inline-block; padding:5px 12px; border:1px solid {{ $loop->first ? '#333' : '#ddd' }}; border-radius:4px; cursor:default;">{{ ucwords($val->value) }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if($product->stock > 0)
                        <div class="tf-product-info-quantity">
                            <div class="quantity-title fw-6">Quantity</div>
                            <div class="wg-quantity">
                                <span class="btn-quantity" wire:click="decrement">-</span>
                                <input type="text" class="quantity-product" name="quantity" wire:model.live="quantity">
                                <span class="btn-quantity" wire:click="increment">+</span>
                            </div>
                        </div>
                        <div class="tf-product-info-buy-button">
                            <form class="">
                                <a href="javascript:void(0);" wire:click.prevent="addToCart" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn add-to-cart-btn"><span>Add to cart -&nbsp;</span><span class="tf-qty-price total-price">${{ number_format(floatval($product->price * $quantity), 2) }}</span></a>
                                <a href="javascript:void(0);" wire:click.prevent="addToWishlist" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Add to Wishlist</span>
                                    <span class="icon icon-delete"></span>
                                </a>
                                <div class="w-100">
                                    <button type="button" wire:click="buyNow" @if($isProcessing) disabled @endif class="btns-full border-0">Buy Now
                                        @if($isProcessing)
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Processing...
                                        @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="tf-product-info-buy-button">
                            <div class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1" style="background-color: #ccc; cursor: not-allowed; pointer-events: none;">
                                <span>Out of Stock</span>
                            </div>
                            <a href="javascript:void(0);" wire:click.prevent="addToWishlist" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                <span class="icon icon-heart"></span>
                                <span class="tooltip">Add to Wishlist</span>
                                <span class="icon icon-delete"></span>
                            </a>
                        </div>
                        @endif
                        @if($product->tags->count() > 0)
                            <div class="tf-product-info-tags mb_15">
                                <span class="fw-6">Tags:</span>
                                @foreach($product->tags as $tag)
                                    <a href="{{ route('shop', ['tag' => $tag->slug]) }}" class="badge bg-light text-dark me-1" style="text-decoration:none;">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif
                        @if($product->category)
                            <div class="tf-product-info-category mb_15">
                                <span class="fw-6">Category:</span>
                                <a href="{{ route('shop', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a>
                            </div>
                        @endif
                        @if($product->stock > 0)
                            <div class="mb_15">
                                <span class="badge bg-success">In Stock ({{ $product->stock }})</span>
                            </div>
                        @else
                            <div class="mb_15">
                                <span class="badge bg-danger">Out of Stock</span>
                            </div>
                        @endif
                        <div class="tf-product-info-trust-seal">
                            <div class="tf-product-trust-mess">
                                <i class="icon-safe"></i>
                                <p class="fw-6">Guarantee Safe <br> Checkout</p>
                            </div>
                            <div class="tf-payment">
                                <img src="{{ asset('images/payments/visa.png')}}" alt="">
                                <img src="{{ asset('images/payments/img-1.png')}}" alt="">
                                <img src="{{ asset('images/payments/img-2.png')}}" alt="">
                                <img src="{{ asset('images/payments/img-3.png')}}" alt="">
                                <img src="{{ asset('images/payments/img-4.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Description & Reviews Tabs --}}
    <div class="container mt_30">
        <div class="tf-product-tab">
            <ul class="widget-tab-2 d-flex justify-content-center" role="tablist">
                <li class="nav-tab-item" role="presentation">
                    <a href="#description" class="active" data-bs-toggle="tab">Description</a>
                </li>
                <li class="nav-tab-item" role="presentation">
                    <a href="#reviews" data-bs-toggle="tab">Reviews ({{ $product->reviews->count() }})</a>
                </li>
            </ul>
            <div class="tab-content">
                {{-- Description Tab --}}
                <div class="tab-pane active show" id="description" role="tabpanel">
                    <div class="tf-product-description p-4">
                        @if($product->description)
                            {!! $product->description !!}
                        @else
                            <p class="text_black-2">No description available for this product.</p>
                        @endif
                    </div>
                </div>
                {{-- Reviews Tab --}}
                <div class="tab-pane" id="reviews" role="tabpanel">
                    <div class="tf-product-reviews p-4">
                        {{-- Average Rating --}}
                        @php
                            $avgRating = $product->reviews->avg('rating') ?? 0;
                            $reviewCount = $product->reviews->count();
                        @endphp
                        @if($reviewCount > 0)
                            <div class="d-flex align-items-center mb_20">
                                <div class="me-3">
                                    <span class="fs-3 fw-6">{{ number_format($avgRating, 1) }}</span>
                                    <span class="text_black-2">/5</span>
                                </div>
                                <div>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($avgRating))
                                            <i class="icon-star" style="color: #f5a623;"></i>
                                        @else
                                            <i class="icon-star" style="color: #ddd;"></i>
                                        @endif
                                    @endfor
                                    <span class="text_black-2 ms-2">({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})</span>
                                </div>
                            </div>
                        @endif

                        {{-- Existing Reviews --}}
                        @forelse($product->reviews()->with('user')->latest()->get() as $review)
                            <div class="review-item mb_20 pb_20" style="border-bottom: 1px solid #eee;">
                                <div class="d-flex justify-content-between align-items-center mb_10">
                                    <div>
                                        <span class="fw-6">{{ $review->user->firstname ?? 'Customer' }} {{ $review->user->lastname ?? '' }}</span>
                                        <span class="text_black-2 ms-2">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="icon-star" style="color: #f5a623; font-size: 14px;"></i>
                                            @else
                                                <i class="icon-star" style="color: #ddd; font-size: 14px;"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                @if($review->comment)
                                    <p class="text_black-2">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text_black-2 mb_20">No reviews yet. Be the first to review this product!</p>
                        @endforelse

                        {{-- Review Form --}}
                        @auth
                            <div class="mt_30">
                                <h6 class="fw-5 mb_15">Write a Review</h6>
                                <form wire:submit.prevent="submitReview">
                                    <div class="mb_15">
                                        <label class="fw-6 mb_5">Rating</label>
                                        <div class="d-flex gap-10">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label style="cursor:pointer;">
                                                    <input type="radio" wire:model="reviewRating" value="{{ $i }}" class="d-none">
                                                    <i class="icon-star" style="font-size: 24px; color: {{ $i <= ($reviewRating ?? 0) ? '#f5a623' : '#ddd' }};"></i>
                                                </label>
                                            @endfor
                                        </div>
                                        @error('reviewRating') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="mb_15">
                                        <label class="fw-6 mb_5">Comment</label>
                                        <textarea wire:model="reviewComment" rows="4" class="form-control" placeholder="Share your experience with this product..."></textarea>
                                        @error('reviewComment') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <button type="submit" class="tf-btn radius-3 btn-fill animate-hover-btn">Submit Review</button>
                                </form>
                            </div>
                        @else
                            <div class="mt_20 p-3" style="background: #f8f9fa; border-radius: 8px;">
                                <p class="text_black-2"><a href="{{ route('home') }}#login" class="fw-5 text-decoration-underline">Log in</a> to write a review.</p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
