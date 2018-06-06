<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('cheque_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cheque_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('cheque_id')->references('id')->on('cheques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('cheque_image');
    }
}
