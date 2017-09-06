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
           $table->mediumText('fixedstructure')->deault(null);;
           $table->mediumText('tempstructure')->default(null);
           $table->integer('course_id')->references('id')->on('courses')->onDelete('cascade');
           $table->string('review_status')->default('Not Reviewed');
           $table->string('feedback')->default(null);
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
