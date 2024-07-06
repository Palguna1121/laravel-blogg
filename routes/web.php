<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');