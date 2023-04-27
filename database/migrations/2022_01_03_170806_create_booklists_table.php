<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooklistsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('booklists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 600);
            $table->string('position', 100)->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('booklists_types_id')->unsigned();
            $table->foreign('booklists_types_id')->references('id')->on('booklists_types')->onDelete('cascade');
            $table->json('status')->nullable();
            $table->json('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('booklists');
    }
}
