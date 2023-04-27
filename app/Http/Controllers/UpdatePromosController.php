<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdatePromosController extends Controller
{
    //

    public function update(Request $req) {
        $promo_code = $req->promo_code;

        // || Eliminar promo anterior,
        // || Crear promo en base a codigo,
        // || Leer txt en base a codigo y agregar libros por isbn1,,
        // || Guardar promo
        // || Eliminar txt

        switch ($promo_code) {
            case 0:
                // || Se actualiza todo
                break;

            case 1:
                // || Se actualizan los mas vendidos
                break;

            case 2:
                // || Se actualizan las novedades
                break;

            case 3:
                // || Se actualizan los recomendados
                break;

            default:
                break;
        }
    }
}
