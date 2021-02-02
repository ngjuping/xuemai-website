<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('author')->nullable();
            $table->string('authorEmail')->nullable();
            $table->string('reviewer')->nullable();
            $table->string('issue')->nullable();
            $table->integer('importance')->nullable();
            $table->enum('type', array('Suggestion','Report'))->nullable();
            $table->enum('status', array('Unviewed','In progress.','Completed'))->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('feedback');
    }
}
