<?php

namespace TypiCMS\Modules\Inicios\Http\Controllers;

use App\SobreNosotros;
use Illuminate\Http\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class NosotrosController extends BaseAdminController
{
    public function index()
    {
        return view("inicios::admin.SobreNosotros.index");
    }

    public function editar(Request $req)
    {
        if ($modelo = SobreNosotros::where('id', $req->id)->get()->first()) {
            return view("inicios::admin.SobreNosotros.edit", compact('modelo'));
        }
    }

    public function crear(Request $req)
    {
        return view("inicios::admin.SobreNosotros.create");
    }

    public function guardar(Request $req)
    {
        if ($modelo = SobreNosotros::where('id', $req->id)) {
            $modelo->delete();
        }
        $modelo = new SobreNosotros();

        $modelo->name = $req->name;
        $modelo->estado = 1;
        $modelo->contenido = $req->contenido;
        $modelo->save();
        return redirect('/admin/sobre-nosotros/');
    }

    public function eliminar(Request $req)
    {
        if ($model = SobreNosotros::where('id', $req->id)->get()->first())
            $model->delete();
        return redirect('/admin/sobre-nosotros');
    }

    public function obtener()
    {
        return SobreNosotros::all();
    }

    public function cEstado(Request $req)
    {
        if ($modelo = SobreNosotros::where('id', $req->id)->get()->first()) {
            $modelo->estado = $modelo->estado * -1;
            $modelo->save();
        }
    }

    public function oEstado(Request $req)
    {
        if ($modelo = SobreNosotros::where('id', $req->id)->get()->first()) {
            return $modelo->estado;
        }
    }

    public function GetById(Request $req)
    {
        if ($modelo = SobreNosotros::where('id', $req->id)->get()->first()) {
            return $modelo;
        }
    }
}
