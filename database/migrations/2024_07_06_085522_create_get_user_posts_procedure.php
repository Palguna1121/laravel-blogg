<?php

// database/migrations/2024_07_06_000008_create_get_user_posts_procedure.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGetUserPostsProcedure extends Migration
{
    public function up()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::unprepared('DROP PROCEDURE IF EXISTS GetUserPosts');
            DB::unprepared('
                CREATE PROCEDURE GetUserPosts(IN userId INT)
                BEGIN
                    SELECT * FROM posts WHERE user_id = userId;
                END;
            ');
        } elseif (env('DB_CONNECTION') == 'pgsql') {
            DB::unprepared('DROP FUNCTION IF EXISTS GetUserPosts(INT)');
            DB::unprepared('
                CREATE OR REPLACE FUNCTION GetUserPosts(userId INT) RETURNS TABLE(id INT, user_id INT, title VARCHAR, content TEXT, created_at TIMESTAMP, updated_at TIMESTAMP) AS $$
                BEGIN
                    RETURN QUERY SELECT * FROM posts WHERE user_id = userId;
                END;
                $$ LANGUAGE plpgsql;
            ');
        }
    }

    public function down()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::unprepared('DROP PROCEDURE IF EXISTS GetUserPosts');
        } elseif (env('DB_CONNECTION') == 'pgsql') {
            DB::unprepared('DROP FUNCTION IF EXISTS GetUserPosts(INT)');
        }
    }
}
