<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
//Route::get('/{slug}', [App\Http\Controllers\PageController::class, 'index'])->where('slug', '([A-Za-z0-9\-]+)');
Route::post('/check-availability', [App\Http\Controllers\BookingController::class, 'checkAvailability'])->name('check-availability');
Route::get('/hotel/{slug}', [App\Http\Controllers\HotelController::class, 'view'])->name('hotel');
Route::post('/proceed-to-checkout', [App\Http\Controllers\BookingController::class, 'proceedToCheckout'])->name('proceed-to-checkout');
Route::get('/checkout', [App\Http\Controllers\BookingController::class, 'checkout'])->name('checkout');
Route::post('/confirm-booking', [App\Http\Controllers\BookingController::class, 'confirmBooking'])->name('confirm-booking');
Route::post('/submit-mobile-otp', [App\Http\Controllers\IndexController::class, 'submitMobileOtp'])->name('submit-mobile-otp');
Route::get('/thank-you', [App\Http\Controllers\IndexController::class, 'thankYou'])->name('thank-you');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);