<?php

use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use App\Http\Controllers\    ;
// use App\Http\Controllers\LandingpageController;
// use App\Http\Controllers\LandingpageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', LandingpageController::class);

Auth::routes(['verified' =>true]);
Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'hadleGoogleCallback'])->name('google.callback');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// Route::get('/shop/insert', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
Route::get('shop/cek_slug',[App\Http\Controllers\ProductController::class, 'cekSlug'])->name('shop.cekSlug');
Route::get('shop/check_slug',[App\Http\Controllers\ProductController::class, 'getSlug'])->name('shop.getSlug');

Route::get('userhome', [App\Http\Controllers\HomeController::class, 'index'])->name('userhome');
Route::get('/shop', [App\Http\Controllers\ProductController::class, 'index'])->name('shop');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart')->middleware('verified');
Route::post('/cart/{id}', [App\Http\Controllers\CartController::class, 'store']);
Route::get('/delete/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy']);
Route::patch('/cart/{id}', [App\Http\Controllers\CartController::class, 'update']);
Route::get('/shop/{slug_category}', [App\Http\Controllers\ProductController::class, 'category'])->name('shop.category');
Route::get('/shop/product/{slug?}', [App\Http\Controllers\ProductController::class, 'show'])->name('product');
Route::put('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('edit');
Route::post('/shop/insertdata', [App\Http\Controllers\ProductController::class, 'insertdata'])->name('insertdata');
Route::post('/shop/insertcategory', [App\Http\Controllers\ProductController::class, 'insertcategory'])->name('insertcategory');
Route::delete('/shop/{id}',[ProductController::class, 'destroy']);
Route::delete('/detail/{id}',[ProductController::class, 'destroy']);
Route::get('/about', [App\Http\Controllers\LandingpageController::class, 'about'])->name('about');
Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout')->middleware('verified');
Route::post('/checkout/store', [CheckOutController::class, 'checkout'])->name('checkout.store')->middleware('verified');
// Route::get('/checkout', [CheckOutController::class, 'checkout']);
// Route::post('/checkout', [CheckOutController::class, 'checkout']);

// Route::post('/checkout', [CheckOutController::class, 'submit'])->name('checkout.submit');
Route::get('/checkout/province/{id}/cities', [CheckOutController::class, 'getCities']);

