<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('status')->nullable();
            $table->json('title')->nullable();
            $table->json('slug')->nullable();
            $table->json('summary')->nullable();
            $table->json('body')->nullable();

            $table->string("titulo")->nullable();
            $table->string("descripcion")->nullable();
            $table->string("icono")->nullable();
            $table->string("indice")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('features');
    }
}
