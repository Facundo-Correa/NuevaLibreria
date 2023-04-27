<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('isbn')->nullable();
            $table->string('isbn1')->nullable();

            $table->string('root_publisher');
            $table->string('publisher', 50);
            $table->string('barcode', 50);
            $table->string('title', 250);

            $table->string('author_1', 50);
            $table->string('author_2', 50);
            $table->string('author_3', 50);

            $table->string('theme_1', 50);
            $table->string('theme_2', 50);
            $table->string('theme_3', 50);

            $table->string('book_category', 10);
            $table->string('edition', 150);
            $table->integer('weight');
            $table->string('backcover', 3000);
            $table->decimal('price');

            $table->string('ml_status', 4);
            $table->integer('available');

            $table->string('commentary');
            $table->string('indice');
            $table->string('upload');

            $table->string('upload_date');
            $table->string('modify_date');

            $table->string('format', 150);
            $table->string('currency', 250);
            $table->string('keywords', 900);
            $table->tinyInteger('show');
            $table->string('shortdescription', 3000);
            $table->string('image_name');
            $table->timestamps();


            /*
                    $item = self::getParams($line);
                    $isbn = $item[0];
                    $raiz_editorial = self::buscarPublisher($item[1]);
                    $nombre_editorial = $item[2];
                    $cod_de_barras = $item[3];
                    $titulo = $item[4];
                    $autor1 = self::buscarCrearAutor($item[5]);
                    $autor2 = self::buscarCrearAutor($item[6]);
                    $autor3 = self::buscarCrearAutor($item[7]);
                    $tema1 = self::buscarSubCategoria($item[8]);
                    $tema2 = self::buscarSubCategoria($item[9]);
                    $tema3 = self::buscarSubCategoria($item[10]);
                    $catalogo = self::buscarCategoria($item[11]);
                    $fecha_de_edicion = $item[12];
                    $peso = $item[13];
                    $encuadernacion = $item[14];
                    $precio = $item[15];
                    $estado_mercadolibre = strtolower($item[16]) == "si" ? 1 : 0; //(si, no) (si se publica o no);
                    $disponibilidad = $item[17]; //(1 disponible, 0 no disponible);
                    $comentario = $item[18];
                    $indice = $item[19];
                    $sube = $item[20] == "Sube a Web";
                    $fecha_de_alta = $item[21];
                    $fecha_de_modificacion = $item[22];
            */
        });

        // Indice para fulltext-search
        DB::statement('ALTER TABLE `typicms_books` ADD FULLTEXT INDEX book_title_index (title)');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('books');
    }
}
