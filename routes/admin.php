<?php

use Illuminate\Support\Facades\Route;

Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
