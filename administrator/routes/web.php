<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::get('/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('verify-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('administrator');
    Route::get('/dashboard', [App\Http\Controllers\IndexController::class, 'index'])->name('dashboard');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    
    //Page
    Route::get('/pages', [App\Http\Controllers\PageController::class, 'index'])->name('pages');
    Route::get('/add-page', [App\Http\Controllers\PageController::class, 'Add'])->name('add-page');
    Route::get('/view-page/{id}', [App\Http\Controllers\PageController::class, 'show'])->name('view-page');
    Route::post('/save-page', [App\Http\Controllers\PageController::class, 'save'])->name('save-page');
    Route::get('/delete-page/{id}', [App\Http\Controllers\PageController::class, 'delete'])->name('delete-page');

    //Hotels
    Route::get('/hotels', [App\Http\Controllers\HotelController::class, 'index'])->name('hotels');
    Route::get('/add-hotel', [App\Http\Controllers\HotelController::class, 'Add'])->name('add-hotel');
    Route::get('/view-hotel/{id}', [App\Http\Controllers\HotelController::class, 'show'])->name('view-hotel');
    Route::post('/save-hotel', [App\Http\Controllers\HotelController::class, 'save'])->name('save-hotel');
    Route::get('/delete-hotel/{id}', [App\Http\Controllers\HotelController::class, 'delete'])->name('delete-hotel');
    Route::post('/get-city-by-state-id', [App\Http\Controllers\HotelController::class, 'getCitiesByStateId'])->name('get-city-by-state-id');
    //Page
    Route::get('/ad-pages', [App\Http\Controllers\AdPageController::class, 'index'])->name('ad-pages');
    Route::get('/add-ad-page', [App\Http\Controllers\AdPageController::class, 'Add'])->name('add-ad-page');
    Route::get('/view-ad-page/{id}', [App\Http\Controllers\AdPageController::class, 'show'])->name('ad-view-page');
    Route::post('/save-ad-page', [App\Http\Controllers\AdPageController::class, 'save'])->name('sad-ave-page');
    Route::get('/delete-ad-page/{id}', [App\Http\Controllers\AdPageController::class, 'delete'])->name('ad-delete-page');

    // Media 
    Route::get('/media', [App\Http\Controllers\MediaController::class, 'index'])->name('media');
    Route::get('/view-file/{id}', [App\Http\Controllers\MediaController::class, 'view'])->name('view-file');
    Route::post('/upload', [App\Http\Controllers\MediaController::class, 'save'])->name('save-media');
    Route::post('/save-file', [App\Http\Controllers\MediaController::class, 'updateFile'])->name('save-file');
    Route::get('/delete-file/{id}', [App\Http\Controllers\MediaController::class, 'delete'])->name('delete-job');
    Route::post('/search-media', [App\Http\Controllers\MediaController::class, 'search'])->name('search-media');

    //Testimonials
    Route::get('/testimonials', [App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials');
    Route::get('/add-testimonial', [App\Http\Controllers\TestimonialController::class, 'add'])->name('add-testimonial');
    Route::get('/view-testimonial/{id}', [App\Http\Controllers\TestimonialController::class, 'show'])->name('view-testimonial');
    Route::post('/save-testimonial', [App\Http\Controllers\TestimonialController::class, 'save'])->name('save-testimonial');

    //Faqs
    Route::get('/faqs', [App\Http\Controllers\FaqController::class, 'index'])->name('faqs');
    Route::get('/add-faq', [App\Http\Controllers\FaqController::class, 'add'])->name('add-faq');
    Route::get('/view-faq/{id}', [App\Http\Controllers\FaqController::class, 'show'])->name('view-faq');
    Route::post('/save-faq', [App\Http\Controllers\FaqController::class, 'save'])->name('save-faq');

    //Review
    Route::get('/reviews', [App\Http\Controllers\ReviewController::class, 'index'])->name('reviews');
    Route::get('/view-review/{id}', [App\Http\Controllers\ReviewController::class, 'show'])->name('view-review');
    Route::post('/save-review', [App\Http\Controllers\ReviewController::class, 'save'])->name('save-review');

    //Review
    Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts');
    Route::get('/view-contact/{id}', [App\Http\Controllers\ContactController::class, 'show'])->name('view-contact');

    //Settings
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'show'])->name('settings');
    Route::post('/save-settings', [App\Http\Controllers\SettingController::class, 'save'])->name('save-settings');

});