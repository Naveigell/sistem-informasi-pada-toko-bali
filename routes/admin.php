<?php

use Illuminate\Support\Facades\Route;

Route::resource('shipping-costs', \App\Http\Controllers\Admin\ShippingCostController::class)->parameters([
    'shipping-costs' => 'shippingCost',
]);
Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
Route::resource('members', \App\Http\Controllers\Admin\MemberController::class);
Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);
Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
