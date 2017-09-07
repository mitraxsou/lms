
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('content', function (Blueprint $table) {
           $table->string('content_id');
           $table->foreign('content_id')->references('content_id')->on('subtopics')->onDelete('cascade');
           $table->string('content_type');
           $table->string('feedback')->nullable;
             $table->mediumText('content');
            $table->primary('content_id');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}
