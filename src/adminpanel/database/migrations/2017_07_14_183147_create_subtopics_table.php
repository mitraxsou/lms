<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubtopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtopics', function(Blueprint $table){
            $table->integer('sub_tid');
            $table->integer('tid')->references('tid')->on('topic')->onDelete('cascade');
            $table->integer('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->mediumText('content');
            $table->string('content_type');
            $table->string('review_status')->default('Not Reviewed');
            $table->timestamps();
            $table->primary(['sub_tid','tid','course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtopics');
    }
}
