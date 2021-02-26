<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('postTitle',100);
            $table->text('postContent');
            $table->timestamps();
        });

        DB::unprepared('CREATE TRIGGER posts_after_insert AFTER INSERT ON `posts` FOR EACH ROW

                   INSERT INTO posts_journal
                   SET
                        id = NEW.id,
                        action_type = \'create\',
                        action_time = now()
                ');
        DB::unprepared('CREATE TRIGGER posts_after_update AFTER UPDATE ON `posts` FOR EACH ROW
               IF NEW.id = OLD.id THEN
                    INSERT INTO posts_journal
                    SET
                        id = OLD.id,
                        action_type = \'update\',
                        action_time = NOW();
                ELSE
                    -- Set old one as deleted
                    INSERT INTO posts_journal
                    SET
                        id = OLD.id,
                        action_type = \'delete\',
                        action_time = NOW();
                    -- AND NEW one created
                    INSERT INTO posts_journal
                    SET
                        id = NEW.id,
                        action_type = \'create\',
                        action_time = NOW();
                END IF
        ');
        DB::unprepared('CREATE TRIGGER posts_after_delete AFTER DELETE ON `posts` FOR EACH ROW

                   INSERT INTO posts_journal
                   SET
                        id = OLD.id,
                        action_type = \'delete\',
                        action_time = now()
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
