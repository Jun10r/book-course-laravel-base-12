<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('post', PostController::class);
Route::resource('category', CategoryController::class);
