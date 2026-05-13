<?php

use App\Http\Controllers\AccountController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function() {
   return view('about');
})->name('about');
Route::get('/contacts', function() {
    return view('contacts');
})->name('contacts');
Route::get('shop', [ShopController::class, 'index'])->name('shop');
Route::get('collections', [ShopController::class, 'collections'])->name('collections');
Route::get('/products/{slug}', [HomeController::class, 'products'])->name('products');
Route::get('/product/{id}', [HomeController::class, 'productAjax'])->name('products.ajax');
Route::get('/cart', function() { return view('cart'); })->name('cart');

// Terms and conditions
Route::get('terms-conditions', function() {return view('terms-conditions');})->name('terms-conditions');
// Privacy Policy
Route::get('privacy-policy', function() {return view('privacy-policy');})->name('privacy-policy');

// Checkout & Payment Routes (accessible to guests and authenticated users)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'post'])->name('checkout.post');
Route::post('/coupon/validate', [CheckoutController::class, 'validateCoupon'])->name('coupon.validate');

Route::post('/paypal/order', [PaymentController::class, 'paypalOrder'])->name('paypal.order');
Route::get('/paypal/success', [PaymentController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PaymentController::class, 'cancel'])->name('paypal.cancel');

Route::post('/stripe/', [PaymentController::class, 'stripeOrder'])->name('stripe.order');

// Guest order confirmation page
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// Guest order lookup
Route::get('/order/track', [CheckoutController::class, 'trackOrder'])->name('order.track');
Route::post('/order/track', [CheckoutController::class, 'trackOrderPost'])->name('order.track.post');

// Authenticated User Routes
Route::middleware('auth-customer')->group(function() {
    // My Account
   Route::group(['prefix' => 'my-account'], function() {
       Route::get('/', [AccountController::class, 'index'])->name('my-account');
       Route::get('/orders', [AccountController::class, 'orders'])->name('my-account.orders');
       Route::get('/orders/{id}', [AccountController::class, 'orderDetails'])->name('my-account.orders.details');

       Route::get('/account-details', [AccountController::class, 'accountDetails'])->name('my-account.account-details');
       Route::post('/account-details', [AccountController::class, 'accountDetailsUpdate'])->name('my-account.account-details.update');

       Route::get('/address', [AccountController::class, 'address'])->name('my-account.address');
       Route::get('/wishlist', [AccountController::class, 'wishlist'])->name('my-account.wishlist');
   });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin panel is now handled by Filament at /admin


