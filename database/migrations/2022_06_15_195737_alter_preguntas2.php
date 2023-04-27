<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPreguntas2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // php artisan migrate --path=database/migrations/2022_06_15_195737_alter_preguntas2.php
        Schema::table('preguntas', function(Blueprint $table){
            $table->string('Nombre_y_apellido')->nullable();
            $table->string('respuestas')->nullable();

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
