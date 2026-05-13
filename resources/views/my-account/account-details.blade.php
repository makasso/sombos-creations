@extends('layouts.my-account')
@section('title2', 'Account Details')

@section('my-account-content')
    <div class="my-account-content account-edit">
        <div class="">
            <form class="" id="form-password-change" method="POST" action="{{ route('my-account.account-details.update') }}">
                @csrf
                <div class="tf-field style-1 mb_15">
                    <input class="tf-field-input tf-input" placeholder="" type="text" id="property1" name="firstname" value="{{ auth()->user()->firstname }}">
                    <label class="tf-field-label fw-4 text_black-2" for="property1">First name</label>
                   @error('firstname')
                        <small class="text-danger">{{ $message }}</small>
                   @enderror
                </div>
                <div class="tf-field style-1 mb_15">
                    <input class="tf-field-input tf-input" placeholder="" type="text" id="property2" name="lastname" value="{{ auth()->user()->lastname }}">
                    <label class="tf-field-label fw-4 text_black-2" for="property2">Last name</label>
                    @error('lastname')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="tf-field style-1 mb_15">
                    <input class="tf-field-input tf-input" placeholder="" type="email" id="property3" name="email" value="{{ auth()->user()->email }}">
                    <label class="tf-field-label fw-4 text_black-2" for="property3">Email</label>
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="tf-field style-1 mb_15">
                    <input class="tf-field-input tf-input" placeholder="" type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                    <label class="tf-field-label fw-4 text_black-2" for="phone">Phone</label>
                    @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="tf-field style-1 mb_15">
                    <input class="tf-field-input tf-input" placeholder="" type="text" id="address" name="address" value="{{ auth()->user()->address ?? '' }}">
                    <label class="tf-field-label fw-4 text_black-2" for="address">Address</label>
                    @error('address')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <h6 class="mb_20">Password Change</h6>
                <div class="tf-field style-1 mb_30">
                    <input class="tf-field-input tf-input" placeholder="" type="password" id="property4" name="current_password">
                    <label class="tf-field-label fw-4 text_black-2" for="property4">Current password</label>
                    @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="tf-field style-1 mb_30">
                    <input class="tf-field-input tf-input" placeholder="" type="password" id="property5" name="new_password">
                    <label class="tf-field-label fw-4 text_black-2" for="property5">New password</label>
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="tf-field style-1 mb_30">
                    <input class="tf-field-input tf-input" placeholder="" type="password" id="property6" name="new_password_confirmation">
                    <label class="tf-field-label fw-4 text_black-2" for="property6">Confirm password</label>
                    @error('new_password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb_20">
                    <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
