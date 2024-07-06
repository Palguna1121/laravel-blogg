<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tuser', [UserController::class, 'index'])->name('tuser');
Route::get('/tpost', [PostController::class, 'index'])->name('tpost');
Route::get('/ttag', [TagController::class, 'index'])->name('ttag');
Route::get('/tcomment', [CommentController::class, 'index'])->name('tcomment');
Route::get('/tcategories', [CategoryController::class, 'index'])->name('tcategories');





Route::resource('users', UserController::class);
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
