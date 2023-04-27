<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*
        CREATE TABLE `book_subcategory` (
        `id` int(11) UNSIGNED NOT NULL,
        `id_catalogo` int(11) UNSIGNED NOT NULL,
        `codigotema` varchar(8) COLLATE latin1_spanish_ci DEFAULT NULL,
        `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT ''
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

        "obvio es para que tengas la estructura no para que lo corras violentamente en la base de datos" JAJAJ Ya se sabe que soy medio bestia
    */

    public function up()
    {
        Schema::create('subcategorias', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('id', 11);
            $table->string('codigotema', 8);
            $table->string('nombre', 100);
            
            $table->string('id_catalogo');
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
        Schema::drop('subcategorias');
    }
}
