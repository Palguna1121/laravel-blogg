<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLogPostUpdateTrigger extends Migration
{
    public function up()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::unprepared('
                CREATE TRIGGER log_post_update
                AFTER UPDATE ON posts
                FOR EACH ROW
                BEGIN
                    INSERT INTO post_logs (post_id, changes, created_at, updated_at)
                    VALUES (NEW.id, CONCAT("Title changed from ", OLD.title, " to ", NEW.title), NOW(), NOW());
                END;
            ');
        } elseif (env('DB_CONNECTION') == 'pgsql') {
            DB::unprepared('
                CREATE OR REPLACE FUNCTION log_post_update() RETURNS TRIGGER AS $$
                BEGIN
                    INSERT INTO post_logs (post_id, changes, created_at, updated_at)
                    VALUES (NEW.id, CONCAT(\'Title changed from \', OLD.title, \' to \', NEW.title), NOW(), NOW());
                    RETURN NEW;
                END;
                $$ LANGUAGE plpgsql;

                CREATE TRIGGER log_post_update
                AFTER UPDATE ON posts
                FOR EACH ROW
                EXECUTE FUNCTION log_post_update();
            ');
        }
    }

    public function down()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::unprepared('DROP TRIGGER IF EXISTS log_post_update');
        } elseif (env('DB_CONNECTION') == 'pgsql') {
            DB::unprepared('DROP TRIGGER IF EXISTS log_post_update ON posts');
            DB::unprepared('DROP FUNCTION IF EXISTS log_post_update()');
        }
    }
}
