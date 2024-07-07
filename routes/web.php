<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = DB::table('user_posts')->get();

    $post_tag = DB::table('post_tag')
        ->join('user_posts', 'user_posts.post_id', '=', 'post_tag.post_id')
        ->join('tags', 'tags.id', '=', 'post_tag.tag_id')
        ->select('user_posts.post_id','user_posts.user_name', 'tags.id', 'tags.name')
        ->get();

    $tags_by_post = [];
    foreach ($post_tag as $tag) {
        $tags_by_post[$tag->post_id][] = $tag;
    }

    return view('dashboard', ['posts' => $posts, 'tags_by_post' => $tags_by_post]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('posts/logs', [PostController::class, 'logs'])->name('posts.logs');

// Route::get('posts/logs', function () {
//     $logs = DB::table('post_logs')->get();
//     return view('posts.logs', compact('logs'));
// })->name('posts.logs');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tuser', [UserController::class, 'index'])->name('tuser');
    Route::get('/tpost', [PostController::class, 'index'])->name('tpost');
    Route::get('/ttag', [TagController::class, 'index'])->name('ttag');
    Route::get('/tcomment', [CommentController::class, 'index'])->name('tcomment');
    Route::get('/tcategories', [CategoryController::class, 'index'])->name('tcategories');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('posts/logs', [PostController::class, 'logs'])->name('posts.logs');
    // Route::get('posts/logs', function () {
    //     dd('mashok');
    //     $logs = DB::table('post_logs')->get();
    //     return view('posts.logs', compact('logs'));
    // })->name('posts.logs');
    
    Route::resource('users', UserController::class);
    // Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Endpoint untuk memanggil stored procedure
    Route::get('user/{id}/posts', function ($id) {
        $posts = DB::select('CALL GetUserPosts(?)', [$id]);
        $post_tag = DB::table('post_tag')
            ->join('user_posts', 'user_posts.post_id', '=', 'post_tag.post_id')
            ->join('tags', 'tags.id', '=', 'post_tag.tag_id')
            ->select('user_posts.post_id','user_posts.user_name', 'tags.id', 'tags.name')
            ->get();

        $tags_by_post = [];
        foreach ($post_tag as $tag) {
            $tags_by_post[$tag->post_id][] = $tag;
        }
        return view('posts.mypost', ['posts' => $posts, 'tags_by_post' => $tags_by_post]);
    })->name('user.posts');
});

require __DIR__.'/auth.php';
