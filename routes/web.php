<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('/test-mail', [App\Http\Controllers\IndexController::class, 'testMail'])->name('test-mail');
Route::get('/privacy-policy', [App\Http\Controllers\IndexController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-conditions', [App\Http\Controllers\IndexController::class, 'termConditions'])->name('terms-conditions');
Route::get('/contact-us', [App\Http\Controllers\IndexController::class, 'contactUs'])->name('contact-us');
Route::get('/refund-cancellation', [App\Http\Controllers\IndexController::class, 'refundCancellation'])->name('refund-cancellation');
Route::get('/shipping-delivery', [App\Http\Controllers\IndexController::class, 'shippingDelivery'])->name('shipping-delivery');

//Route::get('/{slug}', [App\Http\Controllers\PageController::class, 'index'])->where('slug', '([A-Za-z0-9\-]+)');
Route::post('/check-availability', [App\Http\Controllers\BookingController::class, 'checkAvailability'])->name('check-availability');
Route::get('/hotel/{slug}', [App\Http\Controllers\HotelController::class, 'view'])->name('hotel');
Route::post('/proceed-to-checkout', [App\Http\Controllers\BookingController::class, 'proceedToCheckout'])->name('proceed-to-checkout');
Route::post('/update-booking', [App\Http\Controllers\BookingController::class, 'updateBooking'])->name('update-booking');
Route::get('/checkout', [App\Http\Controllers\BookingController::class, 'checkout'])->name('checkout');

Route::post('/booking-process', [App\Http\Controllers\BookingController::class, 'bookingProcess'])->name('booking-process');
Route::get('/confirm-booking/{booking_id}', [App\Http\Controllers\BookingController::class, 'confirmBooking'])->name('confirm-booking');
Route::post('/submit-mobile-otp', [App\Http\Controllers\IndexController::class, 'submitMobileOtp'])->name('submit-mobile-otp');
Route::get('/thank-you', [App\Http\Controllers\IndexController::class, 'thankYou'])->name('thank-you');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/dashboard', function () { return view('dashboard');})->middleware('auth')->name('dashboard');
Route::get('/logout',  [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


Route::get('/payment-process/{booking_id}',  [App\Http\Controllers\BookingController::class, 'payment'])->name('payment');
Route::get('/payment-success/{payment_id}',  [App\Http\Controllers\BookingController::class, 'paymentSuccess'])->name('payment-success');
Route::get('/payment-failed',  [App\Http\Controllers\BookingController::class, 'paymentFailed'])->name('payment-failed');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [App\Http\Controllers\CustomerController::class, 'profile'])->name('profile');
    Route::get('/bookings', [App\Http\Controllers\CustomerController::class, 'booking'])->name('booking');
    Route::post('/update-profile', [App\Http\Controllers\CustomerController::class, 'updateProfile']);
    Route::get('/cancel-booking/{id}', [App\Http\Controllers\CustomerController::class, 'cancelBooking'])->name('cancel-booking');
});