<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenesController extends Controller
{
    //
    public function get()
    {
        // || Obtención de imagenes dentro de public/imagenes/
        $path = 'imagenes/';
        if (!is_dir($path)) {
            mkdir($path, 777);
        }
        $list = array();
        if ($dir = opendir($path)) {
            while (($file = readdir($dir)) !== false) {
                if ($file != '..' && $file != '.') {
                    array_push($list, $file);
                }
            }
            closedir($dir);
        }
        return json_encode($list);
    }
}
