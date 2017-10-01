<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishcourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('publish_course', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('course_id')->references('id')->on('courses')->onDelete('cascade');
           $table->string('publish_status')->default('Not Published');
           $table->integer('feedback')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
