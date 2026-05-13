<!-- modal login -->
<div class="modal modalCentered fade form-sign-in modal-part-content" id="login">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header">
                <div class="demo-title">Log in</div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="tf-login-form">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="email" placeholder=" " type="email"  name="email">
                        <label class="tf-field-label" for="email">Email *</label>
                    </div>
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="password" placeholder=" " type="password"  name="password">
                        <label class="tf-field-label" for="password">Password *</label>
                    </div>
                    <div>
                        <a href="#forgotPassword" data-bs-toggle="modal" class="btn-link link">Forgot your password?</a>
                    </div>
                    <div class="bottom">
                        <div class="w-100">
                            <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Log in</span></button>
                        </div>
                        <div class="w-100">
                            <a href="#register" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">
                                New customer? Create your account
                                <i class="icon icon-arrow1-top-left"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modalCentered fade form-sign-in modal-part-content" id="forgotPassword">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header">
                <div class="demo-title">Reset your password</div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="tf-login-form">
                <form class="">
                    <div>
                        <p>We will sent you a reset link via email</p>
                    </div>
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" placeholder=" " type="email"  name="">
                        <label class="tf-field-label" for="">Email *</label>
                    </div>
                    <div>
                        <a href="#login" data-bs-toggle="modal" class="btn-link link">Cancel</a>
                    </div>
                    <div class="bottom">
                        <div class="w-100">
                            <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Reset password</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modalCentered fade form-sign-in modal-part-content" id="register">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header">
                <div class="demo-title">Register</div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="tf-login-form">
                <form class="" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="firstname" placeholder=" " type="text"  name="firstname" required>
                        <label class="tf-field-label" for="firstname">First name</label>
                    </div>
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="lastname" placeholder="" type="text"  name="lastname" required>
                        <label class="tf-field-label" for="lastname">Last name</label>
                    </div>
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="email" placeholder="" type="email"  name="email" required>
                        <label class="tf-field-label" for="email">Email *</label>
                    </div>
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="phone" placeholder="" type="tel"  name="phone">
                        <label class="tf-field-label" for="phone">Phone</label>
                    </div>
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="password" placeholder="" type="password"  name="password" required>
                        <label class="tf-field-label" for="password">Password *</label>
                    </div>
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" id="password_confirmation" placeholder=" " type="password"  name="password_confirmation" required>
                        <label class="tf-field-label" for="password_confirmation">Password Confirmation *</label>
                    </div>
                    <div class="bottom">
                        <div class="w-100">
                            <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Register</span></button>
                        </div>
                        <div class="w-100">
                            <a href="#login" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">
                                Already have an account? Log in here
                                <i class="icon icon-arrow1-top-left"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /modal login -->
