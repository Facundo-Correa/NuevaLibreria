<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('status')->nullable();
            $table->json('title')->nullable();
            $table->json('slug')->nullable();
            $table->json('summary')->nullable();
            $table->json('body')->nullable();

            // || -- Requisitos -- || //

            $table->string('clienteID')->nullable();
            $table->string('nombreCliente')->nullable();
            $table->json('productos')->nullable();
            $table->string('costoEnvio')->nullable();
            $table->string('costoTotal')->nullable();
            $table->string('direcciónEnvio')->nullable();
            $table->string('estadoPedido')->nullable();

            // || -- End Requisitos -- || //

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('pedidos');
    }
}
