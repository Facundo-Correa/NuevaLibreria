<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Carritos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('carritos', function(Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer("cantidad")->nullable();
            $table->integer("precio")->nullable();

            // || En controlador, si varía el precio agregar como nuevo producto.

            $table->string("book_isbn")->nullable();
            $table->integer("user_id")->nullable();
            $table->string("session_id")->nullable();


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
        //
    }
}
