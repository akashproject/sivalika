<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
//Route::get('/{slug}', [App\Http\Controllers\PageController::class, 'index'])->where('slug', '([A-Za-z0-9\-]+)');
Route::post('/check-availability', [App\Http\Controllers\BookingController::class, 'checkAvailability'])->name('check-availability');
Route::get('/hotel/{slug}', [App\Http\Controllers\HotelController::class, 'view'])->name('hotel');
Route::post('/confirm-booking', [App\Http\Controllers\BookingController::class, 'confirmBooking'])->name('confirm-booking');
Route::get('/checkout', [App\Http\Controllers\BookingController::class, 'checkout'])->name('checkout');