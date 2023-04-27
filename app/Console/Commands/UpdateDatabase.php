<?php

namespace App\Console\Commands;

use App\Pais;
use App\Subcategoria;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Books\Models\Publisher;
use TypiCMS\Modules\Categorias\Facades\Categorias;
use TypiCMS\Modules\Categorias\Models\Categoria;



class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the perfect command for perform an update to your DataBase. Check the UpdateDatabase.php into commands for more info about this beauty piece of code <3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
                // Se estan importando actualmente solo 319 libros


                //echo ('== Importando Paises ==');
                $this->Cargar_Paises('./paises.json');
                //echo ('== Paises importados exitosamente == | ');

                echo ('== Importando libros == |' . "\n");
                $this->Cargar_Libros('./libros.txt');
                echo ('== Libros importados exitosamente == | ');

                echo ('== Importando catalogo == | ' . "\n");
                $this->Cargar_Catalogo('./catalogo.txt');
                echo ('== Catalogo importado exitosamente == | ' . "\n");

                echo ('== Importando Subcategorias ==' . "\n");
                $this->Cargar_Subcategorias('./subcates.txt');
                echo ('== Subcategorias importadas exitosamente == | ' . "\n");


                echo ('== Importando editoriales == | ');
                $this->Cargar_Editoriales('./editoriales.txt');
                echo ('== Editoriales importadas exitosamente == | ' . "\n");

                return 0;
    }


    function Cargar_Catalogo($loc)
    {
        $doc = fopen($loc, 'r');
        DB::table('book_categories')->delete();
        while ($line = fgets($doc)) {
            $info = explode('|', utf8_decode($line));

            if (count($info) >= 2 && $info[2] != " ") {
                $info = $this->cleanArr('"', $info);
                $cat = new Categoria();

                $cat->codigocat = $info[0];
                $cat->name = $info[1];
                $cat->save();
            }
        }
    }
    function Cargar_Libros($localizacion)
    {
        $documento = fopen($localizacion, 'r');

        DB::table('books')->delete();
        while ($linea = fgets($documento)) {
            // Para evitar lineas vacias
            if (strlen($linea) > 2) {
                $libro = new Book();
                $info = $this->cleanArr('"', explode('|', utf8_encode($linea)));


                if (count($info) >= 22) {

                    //echo('public/img/covers/'.$info[3].'.jpg' . '<br/>');


                    if(file_exists('public/img/covers/'.$info[3].'.jpg') && strcmp($info[20], 'Sube a Web') === 0){
                        $libro = new Book();
                        $libro->isbn = $info[0];
                        $libro->root_publisher = $info[1];
                        $libro->publisher = $info[2];
                        $libro->isbn1 = $info[3];
                        $libro->title = $info[4];
                        $libro->author_1 = $info[5];
                        $libro->author_2 = $info[6];
                        $libro->author_3 = $info[7];
                        $libro->theme_1 = $info[8];
                        $libro->theme_2 = $info[9];
                        $libro->theme_3 = $info[10];
                        $libro->book_category = $info[11];
                        $libro->edition = $info[12];
                        $libro->weight = $info[13];
                        $libro->backcover = $info[14];
                        $libro->price = $info[15];
                        $libro->ml_status = $info[16];
                        $libro->available = $info[17];
                        $libro->commentary = $info[18];
                        $libro->indice = $info[19];
                        $libro->upload = $info[20];
                        $libro->upload_date = $info[21];
                        $libro->modify_date = $info[22];
                        $libro->save();

                        echo("Libro se sube a web");
                    }
                    else {
                        echo "Libro no se sube a web. \n";
                        echo($info[20] . " ORIGINAL: " . $info[20] . " RESULTADO: " . strcmp($info[20], "Sube a Web") . "\n");
                    }
                }

            }
        }
    }
    function Cargar_Editoriales($loc)
    {
        DB::table('publishers')->delete();
        $doc = fopen($loc, 'r');
        while ($line = fgets($doc)) {
            $info = $this->cleanArr('"', explode('|', $line));
            if (count($info) >= 2) {
                $ed = new Publisher();
                $ed->isbn = $info[0];
                $ed->name = $info[1];
                $ed->save();
            }
        }
    }
    function Cargar_Subcategorias($loc)
    {
        DB::table('subcategorias')->delete();
        $doc = fopen($loc, 'r');
        while ($line = fgets($doc)) {
            $info = $this->cleanArr('"', explode('|', $line));
            if($info[0] == '' || $info[0] == ""){
                echo "Salteando subcategoria sin padre. . .";
                echo '\n';
                continue;
            }

            if (count($info) >= 3) {
                if(count( Books::where('theme_1', $info[1])
                        ->orWhere('theme_2', $info[1])
                        ->orWhere('theme_3', $info[1])
                        ->get() ) >=1){
                    $sub = new Subcategoria();
                    $sub->codigotema = $info[0];
                    $sub->id_catalogo = $info[1];
                    $sub->nombre = $info[2];
                    $sub->save();
                    echo('...Categoria con libros...');
                }
                else {
                    echo "Salteando subcategoria sin libros. . .";
                    echo "\n";
                    continue;
                }
            }

            else {
            }
        }
    }
    function Cargar_Paises($loc)
    {
        DB::table('paises')->delete();
        $json = file_get_contents($loc);
        $data = json_decode($json, true);

        for($i = 0; $i<count($data); $i++){
            $pais = new Pais();
            $pais->name = $data[$i]['name'];
            $pais->save();
        }

    }
    function cleanChar($chartype, $string)
    {
        $tmp = "";
        foreach (str_split($string) as $char) {
            if ($char != $chartype) {
                $tmp .= $char;
            }
        }
        return $tmp;
    }
    function cleanArr($charType, $str_arr)
    {
        $tmp = [count($str_arr)];
        $index = 0;
        foreach ($str_arr as $line) {
            $tmp[$index] = $this->cleanChar($charType, $line);
            $index++;
        }
        return $tmp;
    }
    function Obtener_Seccion($Linea, $Sector)
    {
        $line_arr = str_split(utf8_decode($Linea));
        $sec = "";
        $index = 0;
        // Busqueda de sector
        if ($Sector != 0) {
            $special_cant = 0;
            foreach ($line_arr as $char) {
                if ($char == '|') {
                    $special_cant++;
                }
                if ($special_cant == $Sector) {
                    break;
                }
                $index++;
            }
        } else {
            $index = 0;
        }
        $index++;

        for ($i = $index; $i < count($line_arr); $i++) {
            if ($line_arr[$i] == '|') {
                break;
            }
            if ($line_arr[$i] != '"') {
                $sec .= $line_arr[$i];
            }
        }
        ///////////////////////////////////////
        return $sec;
    }
}
