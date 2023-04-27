<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->json('status')->nullable();
            $table->json('title')->nullable();
            $table->json('slug')->nullable();
            $table->json('body')->nullable();
            $table->json('summary')->nullable();
            $table->integer('image_id')->unsigned()->nullable();

            // || Fondo publicidades (Home)
            // || Fondo citas (Home)

            $table->string('fondo_publicidades_home')->nullable();
            $table->string('fondo_citas_home')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('configuraciones');
    }
}
