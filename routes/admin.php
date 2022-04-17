<?php

use Illuminate\Support\Facades\Route;

Route::resource('shipping-costs', \App\Http\Controllers\Admin\ShippingCostController::class)->parameters([
    'shipping-costs' => 'shippingCost',
]);
Route::resource('suggestions', \App\Http\Controllers\Admin\SuggestionController::class);
Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('dashboard', \App\Http\Controllers\Admin\DashboardController::class);
Route::resource('shippings', \App\Http\Controllers\Admin\ShippingController::class);
Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
Route::post('biodatas/password', [\App\Http\Controllers\Admin\BiodataController::class, 'password'])->name('biodatas.password');
Route::resource('biodatas', \App\Http\Controllers\Admin\BiodataController::class)->only('create', 'store');
Route::resource('members', \App\Http\Controllers\Admin\MemberController::class);
Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);
Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
Route::get('/create', [\App\Http\Controllers\Admin\ReportController::class, 'create'])->name('report.create');
Route::post('/print', [\App\Http\Controllers\Admin\ReportController::class, 'print'])->name('report.print');
