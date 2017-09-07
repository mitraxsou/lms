<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_course', function(Blueprint $table){
            $table->integer('admin_id');
            $table->foreign('admin_id')->on('id')->references('admins')->onDelete('cascade');
            $table->integer('course_id');
            $table->foreign('course_id')->on('id')->references('courses')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['admin_id','course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_course');
    }
}
