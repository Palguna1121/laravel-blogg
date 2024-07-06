<?php

// database/seeders/PostSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $categories = Category::factory()->count(5)->create();
        $tags = Tag::factory()->count(10)->create();

        foreach ($users as $user) {
            $posts = Post::factory()->count(rand(2, 3))->create(['user_id' => $user->id]);

            foreach ($posts as $post) {
                // Assign categories and tags to each post
                $post->categories()->attach($categories->random(2));
                $post->tags()->attach($tags->random(3));

                // Create comments for each post
                foreach ($users as $commenter) {
                    if ($commenter->id !== $user->id) {
                        Comment::factory()->create([
                            'content' => 'This is a comment bro!',
                            'post_id' => $post->id,
                            'user_id' => $commenter->id,
                        ]);
                    }
                }
            }
        }
    }
}
