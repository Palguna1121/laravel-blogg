<?php

// database/factories/CommentFactory.php
namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
        ];
    }
}

