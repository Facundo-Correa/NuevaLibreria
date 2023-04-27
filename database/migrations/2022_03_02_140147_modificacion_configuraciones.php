<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificacionConfiguraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuraciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('redes')->nullable();
            $table->string('telefonos')->nullable();
            $table->string('medios_pago')->nullable();
            $table->string('direcciones')->nullable();
            $table->string('frase_promociones_1')->nullable();
            $table->string('frase_promociones_2')->nullable();
            $table->string('correos_electronicos')->nullable();
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
