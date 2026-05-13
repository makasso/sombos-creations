@extends('layouts.main')
@section('title', 'Checkout')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <div class="heading text-center">Check Out</div>
                    <p class="text-center text-2 text_black-2 mt_5">Finalize your order</p>
                </div>
            </div>
        </div>
    </div>

    <section class="flat-spacing-11">
        <div class="container">
            <div class="tf-page-cart-wrap layout-2">
                <div class="tf-page-cart-item">
                    <h5 class="fw-5 mb_20">Billing details</h5>

                    @guest
                        <div class="mb_20 p-3" style="background: #f8f9fa; border-radius: 8px;">
                            <p class="text_black-2">Checking out as a guest. <a href="{{ route('home') }}#login" class="text-decoration-underline fw-5">Log in</a> or <a href="{{ route('home') }}#register" class="text-decoration-underline fw-5">create an account</a> to track your orders easily.</p>
                        </div>
                    @endguest

                    <form class="form-checkout" id="billingDetailsForm">
                        <div class="box grid-2">
                            <fieldset class="fieldset">
                                <label for="first-name">First Name</label>
                                <input type="text" id="first-name" name="firstname" value="{{ auth()->user()->firstname ?? '' }}" placeholder="" required>
                            </fieldset>
                            <fieldset class="fieldset">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last-name" name="lastname" value="{{ auth()->user()->lastname ?? '' }}" required>
                            </fieldset>
                        </div>

                        <fieldset class="box fieldset">
                            <label for="address">Street Address</label>
                            <input type="text" id="address" name="address" value="{{ auth()->user()->address ?? '' }}" placeholder="House number and street name" required>
                        </fieldset>
                        <div class="box grid-2">
                            <fieldset class="fieldset">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" value="" required>
                            </fieldset>
                            <fieldset class="fieldset">
                                <label for="state">State / Province</label>
                                <input type="text" id="state" name="state" value="" required>
                            </fieldset>
                        </div>
                        <div class="box grid-2">
                            <fieldset class="fieldset">
                                <label for="postal_code">Postal / ZIP Code</label>
                                <input type="text" id="postal_code" name="postal_code" value="" required>
                            </fieldset>
                            <fieldset class="fieldset">
                                <label for="country">Country</label>
                                <select id="country" name="country" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:4px;">
                                    <option value="">Select a country</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Ivory Coast">Ivory Coast</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Canada">Canada</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Other">Other</option>
                                </select>
                            </fieldset>
                        </div>
                        <fieldset class="box fieldset">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}" required>
                        </fieldset>
                        <fieldset class="box fieldset">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                        </fieldset>

                    </form>
                </div>
                <div class="tf-page-cart-footer">
                    <div class="tf-cart-footer-inner">
                        <h5 class="fw-5 mb_20">Your order</h5>
                        <form class="tf-page-cart-checkout widget-wrap-checkout" id="checkoutForm" method="POST" action="{{ route('checkout.post') }}">
                            @csrf
                            <ul class="wrap-checkout-product">
                                @foreach($items as $item)
                                    @php
                                        if(is_array($item)) {
                                           $item = (object) $item;
                                        }
                                        $subTotal += ($item->product->price * $item->quantity);
                                    @endphp
                                    <li class="checkout-product-item">
                                        <figure class="img-product">
                                            <img src="{{ $item->product->getImage() }}" alt="product">
                                            <span class="quantity">{{ $item->quantity }}</span>
                                        </figure>
                                        <div class="content">
                                            <div class="info">
                                                <p class="name">{{ $item->product->name }}</p>
                                                {{--<span class="variant">Brown / M</span>--}}
                                            </div>
                                            <span class="price">${{ number_format(floatval($item->product->price * $item->quantity), 2) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="coupon-box">
                                <input type="text" id="couponCode" name="coupon_code" placeholder="Discount code">
                                <button type="button" id="applyCouponBtn" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Apply</button>
                            </div>
                            <div id="couponMessage" class="mb_10" style="display:none;"></div>
                            <div id="discountLine" class="d-flex justify-content-between mb_10" style="display:none;">
                                <span>Discount</span>
                                <span class="fw-6 text-success" id="discountAmount"></span>
                            </div>
                            <div class="d-flex justify-content-between line pb_20">
                                <h6 class="fw-5">Total</h6>
                                <h6 class="total fw-5" id="totalAmount">${{ number_format(floatval($subTotal), 2) }}</h6>
                            </div>

                            @php $shippingMethods = \App\Models\ShippingMethod::all(); @endphp
                            @if($shippingMethods->count() > 0)
                                <div class="mb_20">
                                    <h6 class="fw-5 mb_10">Shipping Method</h6>
                                    @foreach($shippingMethods as $method)
                                        <div class="fieldset-radio mb_10">
                                            <input type="radio" name="shipping_method_id" id="shipping_{{ $method->id }}" value="{{ $method->id }}" class="tf-check shipping-method-radio" data-cost="{{ $method->cost }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label for="shipping_{{ $method->id }}">
                                                <span class="fw-5">{{ $method->name }}</span>
                                                <span class="text_black-2"> — ${{ number_format($method->cost, 2) }}</span>
                                                @if($method->estimated_delivery)
                                                    <br><small class="text_black-2">{{ $method->estimated_delivery }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="wd-check-payment">

                                <div class="fieldset-radio mb_20">
                                    <input type="radio" name="payment_method" id="stripe" value="stripe" class="tf-check">
                                    <label for="stripe"><span class="mx-1">Credit/Debit Card</span>
                                        <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24" aria-labelledby="pi-visa"><title id="pi-visa">Visa</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><path d="M28.3 10.1H28c-.4 1-.7 1.5-1 3h1.9c-.3-1.5-.3-2.2-.6-3zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5L27 8.7c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.2zm-13.4-.3l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-.8-2.4-.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.3 0-.6 0-.9.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-1 4.5 0 .2-.1.2-.3.2M5 8.2c0-.1.2-.2.3-.2h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1l2.1-5.1c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5L5 8.2z" fill="#142688"></path></svg>
                                        <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" role="img" width="38" height="24" aria-labelledby="pi-master"><title id="pi-master">Mastercard</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><circle fill="#EB001B" cx="15" cy="12" r="7"></circle><circle fill="#F79E1B" cx="23" cy="12" r="7"></circle><path fill="#FF5F00" d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.2 3-3.3 3-5.7z"></path></svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="pi-american_express" viewBox="0 0 38 24" width="38" height="24"><title id="pi-american_express">American Express</title><path fill="#000" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z" opacity=".07"></path><path fill="#006FCF" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z"></path><path fill="#FFF" d="M22.012 19.936v-8.421L37 11.528v2.326l-1.732 1.852L37 17.573v2.375h-2.766l-1.47-1.622-1.46 1.628-9.292-.02Z"></path><path fill="#006FCF" d="M23.013 19.012v-6.57h5.572v1.513h-3.768v1.028h3.678v1.488h-3.678v1.01h3.768v1.531h-5.572Z"></path><path fill="#006FCF" d="m28.557 19.012 3.083-3.289-3.083-3.282h2.386l1.884 2.083 1.89-2.082H37v.051l-3.017 3.23L37 18.92v.093h-2.307l-1.917-2.103-1.898 2.104h-2.321Z"></path><path fill="#FFF" d="M22.71 4.04h3.614l1.269 2.881V4.04h4.46l.77 2.159.771-2.159H37v8.421H19l3.71-8.421Z"></path><path fill="#006FCF" d="m23.395 4.955-2.916 6.566h2l.55-1.315h2.98l.55 1.315h2.05l-2.904-6.566h-2.31Zm.25 3.777.875-2.09.873 2.09h-1.748Z"></path><path fill="#006FCF" d="M28.581 11.52V4.953l2.811.01L32.84 9l1.456-4.046H37v6.565l-1.74.016v-4.51l-1.644 4.494h-1.59L30.35 7.01v4.51h-1.768Z"></path></svg>
                                    </label>
                                </div>
                                <div class="fieldset-radio mb_20">
                                    <input type="radio" name="payment_method" id="paypal" value="paypal" class="tf-check" checked>
                                    <label for="paypal"><span class="mx-1">PayPal</span>
                                        <svg viewBox="0 0 38 24" xmlns="http://www.w3.org/2000/svg" width="38" height="24" role="img" aria-labelledby="pi-paypal"><title id="pi-paypal">PayPal</title><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"></path><path fill="#fff" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><path fill="#003087" d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4 1.8-2.2 4.7-2.1z"></path><path fill="#3086C8" d="M23.9 8.3l-.2.2c-.5 2.8-2.2 3.8-4.6 3.8H18c-.3 0-.5.2-.6.5l-.6 3.9-.2 1c0 .2.1.4.3.4H19c.3 0 .5-.2.5-.4v-.1l.4-2.4v-.1c0-.2.3-.4.5-.4h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.5-.3-.7-.5-.8z"></path><path fill="#012169" d="M23.3 8.1c-.1-.1-.2-.1-.3-.1-.1 0-.2 0-.3-.1-.3-.1-.7-.1-1.1-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c0-.3.3-.5.6-.5h1.3c2.5 0 4.1-1 4.6-3.8v-.2c-.1-.1-.3-.2-.5-.2h-.1z"></path></svg>
                                    </label>
                                </div>
                                <p class="text_black-2 mb_20">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="{{ route('privacy-policy') }}" class="text-decoration-underline">privacy policy</a>.</p>
                                <div class="box-checkbox fieldset-radio mb_20">
                                    <input type="checkbox" id="check-agree" class="tf-check">
                                    <label for="check-agree" class="text_black-2">I have read and agree to the website <a href="{{ route('terms-conditions') }}" class="text-decoration-underline">terms and conditions</a>.</label>
                                </div>
                            </div>
                            <input type="hidden" name="firstname">
                            <input type="hidden" name="lastname">
                            <input type="hidden" name="email">
                            <input type="hidden" name="phone">
                            <input type="hidden" name="address">
                            <input type="hidden" name="city">
                            <input type="hidden" name="state">
                            <input type="hidden" name="postal_code">
                            <input type="hidden" name="country">
                            <input type="hidden" name="amount" value="{{ $subTotal }}">
                            <input type="hidden" name="coupon_code" id="hiddenCouponCode" value="">
                            <input type="hidden" name="discount" id="hiddenDiscount" value="0">

                            <button type="submit" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Place order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="stripeModal" tabindex="-1" aria-labelledby="stripeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="stripe-payment-form" action="{{ route('stripe.order') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="stripeModalLabel">Pay with Credit/Debit Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Stripe Card Element container -->
                        <div id="card-element"></div>
                        <!-- Error Message -->
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        <input type="hidden" name="firstname">
                        <input type="hidden" name="lastname">
                        <input type="hidden" name="email">
                        <input type="hidden" name="phone">
                        <input type="hidden" name="address">
                        <input type="hidden" name="city">
                        <input type="hidden" name="state">
                        <input type="hidden" name="postal_code">
                        <input type="hidden" name="country">
                        <input type="hidden" name="amount" value="{{ $subTotal }}">
                        <input type="hidden" name="coupon_code" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const baseSubtotal = {{ $subTotal }};
            let currentDiscount = 0;
            let currentShippingCost = 0;

            // Coupon apply
            $('#applyCouponBtn').on('click', function() {
                const code = $('#couponCode').val().trim();
                if (!code) return;

                $.ajax({
                    url: '{{ route("coupon.validate") }}',
                    method: 'POST',
                    data: { code: code, _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        const msgEl = $('#couponMessage');
                        if (res.success) {
                            currentDiscount = (baseSubtotal * res.discount) / 100;
                            msgEl.html('<span class="text-success">' + res.message + '</span>').show();
                            $('#discountLine').show();
                            $('#discountAmount').text('-$' + currentDiscount.toFixed(2));
                            $('#hiddenCouponCode').val(code);
                            $('#hiddenDiscount').val(currentDiscount);
                            // Also copy to stripe form
                            $('#stripe-payment-form input[name="coupon_code"]').val(code);
                        } else {
                            currentDiscount = 0;
                            msgEl.html('<span class="text-danger">' + res.message + '</span>').show();
                            $('#discountLine').hide();
                            $('#hiddenCouponCode').val('');
                            $('#hiddenDiscount').val(0);
                        }
                        recalculateTotal();
                    }
                });
            });

            // Shipping method change
            $('.shipping-method-radio').on('change', function() {
                currentShippingCost = parseFloat($(this).data('cost')) || 0;
                recalculateTotal();
            });

            // Init shipping cost from first checked
            const firstShipping = $('.shipping-method-radio:checked');
            if (firstShipping.length) {
                currentShippingCost = parseFloat(firstShipping.data('cost')) || 0;
                recalculateTotal();
            }

            function recalculateTotal() {
                const total = Math.max(baseSubtotal - currentDiscount + currentShippingCost, 0);
                $('#totalAmount').text('$' + total.toFixed(2));
                $('input[name="amount"]').val(total.toFixed(2));
            }

            // Initialize Stripe and Elements
            const stripe = Stripe('{{ config("services.stripe.key") }}');
            const elements = stripe.elements();
            const card = elements.create('card');
            card.mount('#card-element');

            // Handle real-time validation errors on the card Element.
            card.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Copy billing details into the checkout form hidden fields
            function copyBillingDetails(targetFormSelector) {
                $("#billingDetailsForm").find("input, select, textarea").each(function() {
                    let name = $(this).attr("name");
                    if (name) {
                        $(targetFormSelector + ' input[name="' + name + '"]').val($(this).val());
                    }
                });
            }

            // Listen for the checkout form submission
            $('#checkoutForm').on('submit', function(e) {
                e.preventDefault();

                // Always copy billing details into the checkout form
                copyBillingDetails('#checkoutForm');

                const method = $('input[name="payment_method"]:checked').val();

                if (method === 'stripe') {
                    // Copy billing details into the stripe modal form too
                    copyBillingDetails('#stripe-payment-form');
                    // Open the Stripe modal
                    var stripeModal = new bootstrap.Modal(document.getElementById('stripeModal'));
                    stripeModal.show();
                } else {
                    // For PayPal: submit the form natively (bypass jQuery handler)
                    this.submit();
                }
            });

            // Handle the Stripe payment form submission inside the modal
            const stripeForm = document.getElementById('stripe-payment-form');
            stripeForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                // Create a Stripe token
                const {token, error} = await stripe.createToken(card);
                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                } else {
                    // Append the token to the form and submit to Laravel
                    let hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    stripeForm.appendChild(hiddenInput);
                    stripeForm.submit();
                }
            });

        });
    </script>
@endpush
