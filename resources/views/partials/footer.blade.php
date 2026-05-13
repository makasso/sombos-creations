<!-- Footer -->
<footer id="footer" class="footer background-gray md-pb-70">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="footer-infor">
                            <div class="footer-logo">
                                <a href="#" class="d-flex text-align-left align-items-start">
                                    <img src="{{ asset('images/logo/logo.svg') }}" style="max-width: 40%;" alt="sombos creations logo">
                                </a>
                            </div>
                            <ul>
                                <li>
                                    <p>Address: 1234 Fashion Street, Suite 567, <br> Indianapolis, IN</p>
                                </li>
                                <li>
                                    <p>Email: <a href="mailto:contact@somboscreations.com">contact@somboscreations.com</a></p>
                                </li>
                                <li>
                                    <p>Phone: <a href="tel:12125551234">(212) 555-1234</a></p>
                                </li>
                            </ul>
                            <a href="https://maps.app.goo.gl/3ShQUXSn2vHcU2eY8" class="tf-btn btn-line">Get direction<i class="icon icon-arrow1-top-left"></i></a>
                            <ul class="tf-social-icon d-flex gap-10">
                                <li><a href="#" class="box-icon w_34 round social-facebook social-line"><i class="icon fs-14 icon-fb"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-twiter social-line"><i class="icon fs-12 icon-Icon-x"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-instagram social-line"><i class="icon fs-14 icon-instagram"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-tiktok social-line"><i class="icon fs-14 icon-tiktok"></i></a></li>
                                <li><a href="#" class="box-icon w_34 round social-pinterest social-line"><i class="icon fs-14 icon-pinterest-1"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-12 footer-col-block">
                        <div class="footer-heading footer-heading-desktop">
                            <h6>Help</h6>
                        </div>
                        <div class="footer-heading footer-heading-moblie">
                            <h6>Help</h6>
                        </div>
                        <ul class="footer-menu-list tf-collapse-content">
                            <li>
                                <a href="{{ route('privacy-policy') }}" class="footer-menu_item">Privacy Policy</a>
                            </li>

                            <li>
                                <a href="{{ route('terms-conditions') }}" class="footer-menu_item">Terms &amp; Conditions</a>
                            </li>

                            <li>
                                <a href="{{ route('order.track') }}" class="footer-menu_item">Track Your Order</a>
                            </li>

                            <li>
                                <a href="{{ auth()->user() === null ? '#login' : route('my-account.wishlist') }}" @guest data-bs-toggle="modal" @endguest class="footer-menu_item">My Wishlist</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-4 col-md-6 col-12 footer-col-block">
                        <div class="footer-heading footer-heading-desktop">
                            <h6>About us</h6>
                        </div>
                        <div class="footer-heading footer-heading-moblie">
                            <h6>About us</h6>
                        </div>
                        <ul class="footer-menu-list tf-collapse-content">
                            <li>
                                <a href="{{ route('about') }}" class="footer-menu_item">Our Story</a>
                            </li>
                            <li>
                                <a href="{{ route('shop') }}" class="footer-menu_item">Visit Our Store</a>
                            </li>
                            <li>
                                <a href="{{ route('contacts') }}" class="footer-menu_item">Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ auth()->user() === null ? '#login' : route('my-account') }}" @guest data-bs-toggle="modal" @endguest class="footer-menu_item">Account</a>
                            </li>
                        </ul>
                    </div>
                       {{-- <div class="col-xl-3 col-md-6 col-12">
                            <div class="footer-newsletter footer-col-block">
                                <div class="footer-heading footer-heading-desktop">
                                    <h6>Sign Up for Email</h6>
                                </div>
                                <div class="footer-heading footer-heading-moblie">
                                    <h6>Sign Up for Email</h6>
                                </div>
                                <div class="tf-collapse-content">
                                    <div class="footer-menu_item">Sign up to get first dibs on new arrivals, sales, exclusive content, events and more!</div>
                                    <div class="sib-form">
                                        <div id="sib-form-container" class="sib-form-container">
                                            <div id="error-message" class="sib-form-message-panel">
                                                <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                            <span class="sib-form-message-panel__inner-text">
                                                                Your subscription could not be saved. Please try again.
                                                            </span>
                                                </div>
                                            </div>
                                            <div id="success-message" class="sib-form-message-panel">
                                                <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                            <span class="sib-form-message-panel__inner-text">
                                                                Your subscription has been successful.
                                                            </span>
                                                </div>
                                            </div>
                                            <div id="sib-container" class="sib-container--large sib-container--vertical">
                                                <form id="sib-form" method="POST" class="form-newsletter" action=""
                                                      data-type="subscription">
                                                    <div>
                                                        <div class="sib-form-block">
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="sib-form-block">
                                                            <div class="sib-text-form-block">
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="sib-input sib-form-block">
                                                            <div class="form__entry entry_block">
                                                                <div class="form__label-row ">
                                                                    <label class="entry__label" for="EMAIL">
                                                                    </label>
                                                                    <div class="entry__field">
                                                                        <input class="input " type="text" id="EMAIL" name="EMAIL" autocomplete="off"
                                                                               placeholder="Enter your email...." data-required="true" required />
                                                                    </div>
                                                                </div>
                                                                <label class="entry__error entry__error--primary"></label>
                                                                <label class="entry__specification">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="sib-optin sib-form-block">
                                                            <div class="form__entry entry_mcq">
                                                                <div class="form__label-row ">
                                                                    <div class="entry__choice">
                                                                        <label>
                                                                            <input type="checkbox" class="input_replaced" value="1" id="OPT_IN"
                                                                                   name="OPT_IN" />
                                                                            <span class="checkbox checkbox_tick_positive"></span>
                                                                            <span>
                                                                                        <p></p>
                                                                                    </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <label class="entry__error entry__error--primary">
                                                                </label>
                                                                <label class="entry__specification">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="sib-form-block button-submit">
                                                            <button
                                                                class="sib-form-block__button sib-form-block__button-with-loader tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn"
                                                                form="sib-form" type="submit">
                                                                <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon"
                                                                     viewBox="0 0 512 512">
                                                                    <path
                                                                        d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z" />
                                                                </svg>
                                                                Subscribe<i class="icon icon-arrow1-top-left"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="email_address_check" value="" class="input--hidden">
                                                    <input type="hidden" name="locale" value="en">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tf-cur">
                                        <div class="tf-currencies">
                                            <select class="image-select center style-default type-currencies">
                                                <option selected data-thumbnail="images/country/us.svg">USD <span>$ | United States</span></option>
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
                        </div>--}}
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-wrap d-flex gap-20 flex-wrap justify-content-between align-items-center">
                            <div class="footer-menu_item">© {{ date('Y') }} Sombos Creations. All Rights Reserved | Powered by
                                <a href="https://maatonggroup.com/usa" target="_blank">MaatongTech LLC</a></div>
                            <div class="tf-payment">
                                <img src="{{ asset('images/payments/visa.png') }}" alt="">
                                <img src="{{ asset('images/payments/img-1.png') }}" alt="">
                                <img src="{{ asset('images/payments/img-2.png') }}" alt="">
                                <img src="{{ asset('images/payments/img-3.png') }}" alt="">
                                <img src="{{ asset('images/payments/img-4.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->
