<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


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

// Endpoint untuk memanggil stored procedure
Route::get('user/{id}/posts', function ($id) {
    $posts = DB::select('CALL GetUserPosts(?)', [$id]);
    return view('posts.user_posts', ['posts' => $posts]);
})->name('user.posts');
