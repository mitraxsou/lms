<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('quiz',function(Blueprint $table){
            $table->integer('quiz_id');
            $table->integer('sub_tid');
            $table->foreign('sub_tid')->references('sub_tid')->on('subtopics')->onDelete('cascade');
            $table->integer('tid');
            $table->foreign('tid')->references('tid')->on('topic')->onDelete('cascade');
            $table->integer('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->timestamps();
            $table->primary('quiz_id');
            $table->unique(['sub_tid','tid','course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
}
