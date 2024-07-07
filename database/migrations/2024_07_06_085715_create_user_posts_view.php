<?php

// database/migrations/2024_07_06_000009_create_user_posts_view.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserPostsView extends Migration
{
    public function up()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::unprepared('DROP VIEW IF EXISTS user_posts');
            DB::unprepared('
                CREATE VIEW user_posts AS
                SELECT users.id as user_id, users.name as user_name, posts.id as post_id, posts.title, posts.content
                FROM posts
                JOIN users ON posts.user_id = users.id;
            ');
        } elseif (env('DB_CONNECTION') == 'pgsql') {
            DB::unprepared('DROP VIEW IF EXISTS user_posts');
            DB::unprepared('
                CREATE OR REPLACE VIEW user_posts AS
                SELECT users.id as user_id, users.name as user_name, posts.id as post_id, posts.title, posts.content
                FROM posts
                JOIN users ON posts.user_id = users.id;
            ');
        }
    }

    public function down()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::unprepared('DROP VIEW IF EXISTS user_posts');
        } elseif (env('DB_CONNECTION') == 'pgsql') {
            DB::unprepared('DROP VIEW IF EXISTS user_posts');
        }
    }
}
