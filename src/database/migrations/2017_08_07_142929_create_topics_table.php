<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('topic', function(Blueprint $table){
            $table->integer('tid');
            $table->string('name');
            $table->string('review_status')->default('Not Reviewed');
            $table->integer('course_id')->refrences('id')->on('courses')->onDelete('cascade');
            $table->string('description');
            $table->timestamps();
            $table->primary(['tid','course_id']);
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
