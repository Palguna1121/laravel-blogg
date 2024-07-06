<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->comments()->create($validated);
        return redirect()->route('posts.show', $post);
    }
}