<!-- modal quick_view -->
<div wire:ignore.self class="modal fade modalDemo" id="quickViewModal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="header p-4">
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            @if($product)
                <div class="wrap d-flex flex-sm-column flex-md-row align-items-center justify-content-between overflow-y-auto">
                    <div class="tf-product-media-wrap">
                        <div class="item">
                            <img style="min-height: 300px; max-height: 600px;!important; object-fit: cover;" id="productImage" src="{{ $product->getImage() }}" alt="">
                        </div>
                    </div>
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-product-info-list">
                            <div class="tf-product-info-title">
                                <h5><a id="productName" class="link" href="{{ route('products', $product->slug) }}">{{ $product->name }}</a></h5>
                            </div>

                            <div class="tf-product-info-price">
                                <div class="price" id="productPrice">{{ $product->getPrice() }}</div>
                            </div>
                            <div class="tf-product-description">
                                <p id="productDescription">{{ $product->description }}</p>
                            </div>
                            <div class="tf-product-info-quantity">
                                <div class="quantity-title fw-6">Quantity</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn" wire:click="decrement">-</span>
                                    <input type="text" name="quantity" wire:model="quantity" min="1" value="{{ $quantity }}">
                                    <span class="btn-quantity plus-btn" wire:click="increment">+</span>
                                </div>
                            </div>
                            <div class="tf-product-info-buy-button">
                                <form class="">
                                    <a href="javascript:void(0);" wire:click="addToCart" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn add-to-cart-btn"><span>Add to cart -&nbsp;</span><span class="tf-qty-price">${{$price}}</span></a>
                                    @auth
                                        <a href="javascript:void(0);" wire:click="addToWishlist" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Add to Wishlist</span>
                                            <span class="icon icon-delete"></span>
                                        </a>
                                    @endauth

                                    <div class="w-100">
                                        <button type="button" wire:click="buyNow" @if($isProcessing) disabled @endif class="btns-full border-0">Buy with <img src="{{ asset('images/payments/paypal.png') }}" alt="">
                                            @if($isProcessing)
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Processing...
                                            @endif
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('products', $product->slug) }}" id="productLink" class="tf-btn fw-6 btn-line">View full details<i class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal-body">
                    <h6 class="text-center">Loading...</h6>
                </div>
            @endif

        </div>
    </div>
</div>
<!-- /modal quick_view -->

@push('scripts')
    <script>
        Livewire.on('redirectToPayPal', (data) => {
            window.location.href = data[0].url;
        });
    </script>

@endpush
