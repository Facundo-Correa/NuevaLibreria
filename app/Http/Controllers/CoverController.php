<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoverController extends Controller
{
    // || Controlador utilizado en principio para la obtencion de los book's covers

    public function get($isbn) {
        $filedir = 'img/covers/'.$isbn.'.jpg';
        if(is_dir('img/covers') && file_exists($filedir)){
            return $filedir;
        }
        else {
            return 'img/covers/tapa-no-disponible.jpg';
        }
    }
}
