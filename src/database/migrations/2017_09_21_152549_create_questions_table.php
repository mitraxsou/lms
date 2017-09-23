<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions',function(Blueprint $table){
            $table->string('ques_id');
            $table->integer('quiz_id');
            $table->foreign('quiz_id')->references('quiz_id')->on('quiz')->onDelete('cascade');
            $table->enum('ques_type',['tf','mcq1','mcqmul','matchmake']);
            $table->string('statement');
            $table->mediumText('question');
            $table->enum('level',['easy','moderate','difficult']);
            $table->mediumText('a');
            $table->mediumText('b');
            $table->mediumText('c')->nullable();
            $table->mediumText('d')->nullable();
            $table->mediumText('e')->nullable();
            $table->mediumText('f')->nullable();
            $table->mediumText('g')->nullable();
            $table->mediumText('h')->nullable();
            $table->string('correct');
            $table->mediumText('explanation');
            $table->timestamps();
            $table->primary('ques_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
