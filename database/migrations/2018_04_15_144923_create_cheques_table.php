<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 4)->unique();
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('shelves', function (Blueprint $table) { // estante
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('boxes', function (Blueprint $table) { // caja
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('shelf_id')->unsigned(); // caja->estante
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shelf_id')->references('id')->on('shelves')->onDelete('cascade');
        });
        Schema::create('folders', function (Blueprint $table) { // carpeta
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('box_id')->unsigned(); // carpeta->caja->estante
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade');
        });

        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num');
            $table->string('beneficiary');
            $table->integer('bank_id')->unsigned();
            $table->date('dated_at');
            $table->text('total');
            $table->integer('num_box')->unsigned()->nullable();
            $table->integer('folder_id')->unsigned()->nullable(); // caja->estante->carpeta
            $table->boolean('state')->nullable(); // 1) físico 2) digital
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
        Schema::dropIfExists('shelfs');
        Schema::dropIfExists('boxes');
        Schema::dropIfExists('folders');
        Schema::dropIfExists('cheques');
    }
}
