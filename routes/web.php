<?php

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
Route::prefix('login')->name('login.')->group(function () {
    Route::post('/', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('store');
    Route::view('/', 'auth.member.login')->name('index');
});

Route::prefix('/shipping-cost')->name('shipping-cost.')->group(function () {
    Route::get('/province/{provinceId}', [\App\Http\Controllers\Member\ShippingCostController::class, 'province'])->name('province');
    Route::get('/province/{provinceId}/cities', [\App\Http\Controllers\Member\ShippingCostController::class, 'cities'])->name('province.cities');
    Route::get('/cost/{cityId}', [\App\Http\Controllers\Member\ShippingCostController::class, 'cost'])->name('cost');
});
