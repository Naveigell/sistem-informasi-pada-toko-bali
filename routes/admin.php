<?php

use Illuminate\Support\Facades\Route;

Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
