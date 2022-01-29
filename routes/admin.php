<?php

use Illuminate\Support\Facades\Route;

Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
Route::resource('members', \App\Http\Controllers\Admin\MemberController::class);
Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);
