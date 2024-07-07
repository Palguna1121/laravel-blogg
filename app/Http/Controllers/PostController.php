<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('user_posts')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $validated['user_id'] = Auth::id();

        Post::create($validated);
        return redirect()->route('dashboard');
    }

    public function show(Post $post)
    {
        $user = User::find($post->user_id);
        return view('posts.show', compact('post', 'user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::find($request->user_id);
        $post->update($validated);
        return redirect()->route('dashboard');
    }

    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        $post->delete();
        return redirect()->route('dashboard');
    }
}