<?php

namespace TypiCMS\Modules\Inicios\Http\Controllers;

use App\Exposiciones;
use Illuminate\Http\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class ExposicionesController extends BaseAdminController
{
    public function index()
    {
        return view('inicios::admin.Exposiciones.index');
    }

    public function crear()
    {
        return view('inicios::admin.Exposiciones.create');
    }

    public function editar(Request $req)
    {
        $modelo = Exposiciones::where('id', $req->id)->get()->first();
        return view('inicios::admin.Exposiciones.edit', compact('modelo'));
    }

    public function guardar(Request $req)
    {
        $img_bcp = [];
        if ($modelo = Exposiciones::where('id', $req->id)->get()->first()) {
            $img_bcp = $modelo->imagenes;
            $modelo->delete();
        }

        $modelo = new Exposiciones();
        $modelo->titulo = $req->name;
        $modelo->name = $req->name;
        $modelo->texto = $req->name;
        $modelo->estado = 1;


        if ($img_bcp) {
            $modelo->imagenes = $img_bcp;
        } else {
            $modelo->imagenes = json_encode($req->imagenes);
        }

        $modelo->save();
        return redirect('/admin/exposiciones');
    }

    public function obtener()
    {
        return Exposiciones::all();
    }

    public function changeEstado(Request $req)
    {
        $model = Exposiciones::where('id', $req->id)->get()->first();
        $model->estado = $model->estado * -1;
        $model->save();
    }

    // || Obtencion del estado
    public function getEstado(Request $req)
    {
        return Exposiciones::where('id', $req->id)->get()->first()->estado;
    }

    public function eliminar(Request $req)
    {
        if ($modelo = Exposiciones::where('id', $req->id)->get()->first()) {
            $modelo->delete();
        } else {
        }
        return redirect('/admin/exposiciones');
    }

    public function guardarImagenes(Request $req)
    {
        if ($model = Exposiciones::where('id', $req->id)->get()->first()) {

            $model->imagenes = $req->imagenes;
            $model->save();

            return "Guardado realizado exitosamente";
        }
    }

    public function getImagenes(Request $req)
    {
        if ($model = Exposiciones::where('id', $req->id)->get()->first()) {
            return $model->imagenes;
        } else {
            return "No se encontró al modelo";
        }
    }

    public function cambiarEstado(Request $req)
    {
        if ($exp = Exposiciones::where('id', $req->id)->get()->first()) {
            $exp->estado = $exp->estado * -1;
            $exp->save();
        }
    }

    public function getByID(Request $req)
    {
        if ($exp = Exposiciones::where('id', $req->id)->get()->first()) {
            return $exp;
        }
    }
}
