<!-- shoppingCart -->
<div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header">
                <div class="title fw-5">Shopping cart</div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="wrap">
                @if(count($items) > 0)
                    <div class="tf-mini-cart-wrap">
                        <div class="tf-mini-cart-main">
                            <div class="tf-mini-cart-sroll">
                                <div class="tf-mini-cart-items">
                                    @foreach($items as $item)
                                       @php
                                           if(is_array($item)) {
                                              $item = (object) $item;
                                           }
                                           $subTotal += ($item->product->price * $item->quantity);
                                       @endphp
                                        <div class="tf-mini-cart-item">
                                            <div class="tf-mini-cart-image">
                                                <a href="{{ route('products', $item->product->slug) }}">
                                                    <img src="{{ $item->product->getImage() }}" alt="">
                                                </a>
                                            </div>
                                            <div class="tf-mini-cart-info">
                                                <a class="title link" href="{{ route('products', $item->product->slug) }}">{{ $item->product->name }}</a>
{{--                                                <div class="meta-variant">Light gray</div>--}}
                                                <div class="price fw-6">{{ $item->product->getPrice() }}</div>
                                                <div class="tf-mini-cart-btns">
                                                    <div class="wg-quantity small">
                                                        <span class="btn-quantity minus-btn">-</span>
                                                        <input type="text" name="number" value="{{ $item->quantity }}">
                                                        <span class="btn-quantity plus-btn">+</span>
                                                    </div>
                                                    <buttton class="tf-mini-cart-remove remove-cart-item cursor-pointer border-0" style="cursor: pointer!important;" data-product-id="{{ $item->product->id }}">Remove</buttton>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tf-mini-cart-bottom">

                            <div class="tf-mini-cart-bottom-wrap">
                                <div class="tf-cart-totals-discounts">
                                    <div class="tf-cart-total">Subtotal</div>
                                    <div class="tf-totals-total-value fw-6">${{ number_format(floatval($subTotal), 2) }} USD</div>
                                </div>
                                <div class="tf-cart-tax">Taxes and <a href="#">shipping</a> calculated at checkout</div>
                                <div class="tf-mini-cart-line"></div>
                                <div class="tf-cart-checkbox">
                                    <div class="tf-checkbox-wrapp">
                                        <input class="" type="checkbox" id="CartDrawer-Form_agree" name="agree_checkbox">
                                        <div>
                                            <i class="icon-check"></i>
                                        </div>
                                    </div>
                                    <label for="CartDrawer-Form_agree">
                                        I agree with the
                                        <a href="#" title="Terms of Service">terms and conditions</a>
                                    </label>
                                </div>
                                <div class="tf-mini-cart-view-checkout">
                                    <a href="{{ route('cart') }}"
                                       class="tf-btn btn-outline radius-3 link w-100 justify-content-center">View cart</a>
                                    <a href="{{ route('checkout') }}"
                                       class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Check out</span></a>
                                </div>
                            </div>
                        </div>


                    </div>
                @else
                    <h6 class="text-center mt-4">Cart is empty</h6>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- /shoppingCart -->
