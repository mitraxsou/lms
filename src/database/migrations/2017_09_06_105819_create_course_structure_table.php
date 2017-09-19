<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_structure', function (Blueprint $table) {
           $table->increments('id');

           $table->mediumText('fixedstructure')->nullable();
           $table->mediumText('tempstructure')->nullable();
           $table->mediumText('demo_content')->nullable();
           $table->integer('course_id')->references('id')->on('courses')->onDelete('cascade');
           $table->string('review_status')->default('Not Reviewed');
           $table->integer('feedback')
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
