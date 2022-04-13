<?php

use Carbon\Carbon;
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

Route::resource('/', \App\Http\Controllers\Member\HomeController::class)->only('index');
Route::resource('products', \App\Http\Controllers\Member\ProductController::class)->only('show')->parameters([
    'products' => 'product:slug'
]);
Route::resource('carts', \App\Http\Controllers\Member\CartController::class)->only('index', 'store', 'destroy');
Route::view('/checkouts/success', 'member.pages.checkout.success')->name('checkouts.success');
Route::resource('checkouts', \App\Http\Controllers\Member\CheckoutController::class)->only('index', 'store');

Route::prefix('/shippings/{shipping}')->name('shippings.')->group(function () {
    Route::prefix('products/reviews')->name('products.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Member\ReviewController::class, 'index'])->name('reviews.index');
    });
    Route::prefix('products/{product}')->name('products.')->group(function () {
        Route::resource('reviews', \App\Http\Controllers\Member\ReviewController::class)->except('index');
    });
});
Route::resource('shippings', \App\Http\Controllers\Member\ShippingController::class);
Route::prefix('/payments/{shipping}/pay')->group(function () {
    Route::get('/', [\App\Http\Controllers\Member\PaymentController::class, 'editPayment'])->name('payments.shipping.pay.edit');
    Route::put('/', [\App\Http\Controllers\Member\PaymentController::class, 'updatePayment'])->name('payments.shipping.pay.update');
});

Route::resource('payments', \App\Http\Controllers\Member\PaymentController::class);
Route::prefix('login')->name('login.')->group(function () {
    Route::post('/', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('store');
    Route::view('/', 'auth.login')->name('index');
});

Route::prefix('register')->name('register.')->group(function () {
    Route::post('/', [\App\Http\Controllers\Auth\AuthController::class, 'register'])->name('store');
    Route::view('/', 'auth.register')->name('index');
});

Route::prefix('logout')->name('logout.')->group(function () {
    Route::match(['get', 'post'], '/', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('store');
});

Route::prefix('/shipping-cost')->name('shipping-cost.')->group(function () {
    Route::get('/province/{provinceId}', [\App\Http\Controllers\Member\ShippingCostController::class, 'province'])->name('province');
    Route::get('/province/{provinceId}/cities', [\App\Http\Controllers\Member\ShippingCostController::class, 'cities'])->name('province.cities');
    Route::get('/cost/{cityId}/courier/{courier}', [\App\Http\Controllers\Member\ShippingCostController::class, 'cost'])->name('cost.courier');
});

Route::resource('suggestions', \App\Http\Controllers\Member\SuggestionController::class);

Route::post('biodatas/password', [\App\Http\Controllers\Member\BiodataController::class, 'password'])->name('biodatas.password');
Route::resource('biodatas', \App\Http\Controllers\Member\BiodataController::class)->only('create', 'store');

