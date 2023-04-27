<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIniciosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inicios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->json('status')->nullable();
            $table->json('title')->nullable();
            $table->json('slug')->nullable();
            $table->json('summary')->nullable();
            $table->json('body')->nullable();



            // Guardar acá el id de las promociones correspondientes            
            $table->string('name');

            // Guardar acá el id de las promociones correspondientes            
            $table->integer('estado');

            // Guardar acá el id de las promociones correspondientes            
            $table->integer('promociones')->nullable();

            // Guardar acá el id de las publicidades correspondientes
            $table->integer('publicidades')->nullable();

            // Guardar acá el id del sobre nosotros correspondiente
            $table->integer('sobre_nosotros')->nullable();

            // Guardar acá el id de nuestra editorial correspondiente
            $table->integer('nuestra_editorial')->nullable();

            // Guardar acá el id del carrusel correspondiente
            $table->integer('carrusel')->nullable();

            // Guardar acá el id de la exposicion correspondiente
            $table->integer('exposicion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('inicios');
    }
}
