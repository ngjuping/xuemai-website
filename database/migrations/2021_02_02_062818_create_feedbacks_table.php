<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('author')->nullable();
            $table->string('author_email')->nullable();
            $table->string('reviewer')->nullable();
            $table->text('issue')->nullable(); # text is longer than string
            $table->integer('importance')->nullable();
            $table->enum('type', array('Suggestion','Report'))->nullable();
            $table->enum('status', array('Unviewed','In progress.','Completed'))->nullable();
            $table->string('remark')->nullable();
            $table->string('ip');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('feedbacks');
    }
}
