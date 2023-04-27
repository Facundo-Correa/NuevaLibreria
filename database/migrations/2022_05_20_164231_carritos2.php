<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Carritos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('carritos', function (Blueprint $table) {
            $table->integer("cantidad");
            $table->integer("precio");

            // || En controlador, si varía el precio agregar como nuevo producto.

            $table->string("book_isbn");
            $table->integer("user_id");
            $table->string("session_id");
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
