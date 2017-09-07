<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('notifications', function (Blueprint $table) {
           $table->integer('id');
           $table->string('type');
           $table->string('notifiable_type');
           $table->integer('notifiable_id');
           $table->text('data');
           $table->date('read_at');
           $table->boolean('read');
           $table->timestamps();
           $table->primary('id');
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
