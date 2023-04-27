<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePreguntas extends Migration
{
    /**
     * Run the migrations.
     *php artisan migrate --path=database/migrations/2022_04_22_200725_alter_table_preguntas.php
     * @return void
     */
    public function up()
    {
        //
        Schema::table('preguntas', function(Blueprint $table){
            $table->string('publicacion')->nullable();
            $table->string('libro')->nullable();
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
