<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigocat', 8);
            $table->string('name', 150);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `typicms_book_categories` ADD FULLTEXT INDEX category_title_index (name)');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('categorias');
    }
}
