<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptionContainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_container', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin', 2);
            $table->string('destinity', 2);
            $table->integer('status');
            
            $table->integer('container_id')->unsigned();
            $table->integer('user_id')->unsigned();
            
            $table->foreign('container_id')->references('id')->on('container');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('description_container');
    }
}
