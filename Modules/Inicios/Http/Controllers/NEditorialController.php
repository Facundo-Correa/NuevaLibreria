<?php

namespace TypiCMS\Modules\Inicios\Http\Controllers;

use App\NuestraEditorial;
use App\SobreNosotros;
use Illuminate\Http\Request;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class NEditorialController extends BaseAdminController
{
    public function index()
    {
        return view("inicios::admin.NuestraEditorial.index");
    }

    public function editar(Request $req)
    {
        if ($modelo = NuestraEditorial::where('id', $req->id)->get()->first()) {
            return view("inicios::admin.NuestraEditorial.edit", compact('modelo'));
        }
    }

    public function crear(Request $req)
    {
        return view("inicios::admin.NuestraEditorial.create");
    }

    public function guardar(Request $req)
    {
        $libros = [];

        if ($modelo = NuestraEditorial::where('id', $req->id)->get()->first()) {
            if ($modelo->libros) {
                $libros = $modelo->libros;
            }
            $modelo->delete();
        }
        $modelo = new NuestraEditorial();

        $modelo->name = $req->name;
        $modelo->estado = 1;
        if ($libros) {
            $modelo->libros = $libros;
        } else {
            $modelo->libros = json_encode("");
        }
        $modelo->save();
        return redirect('/admin/nuestra-editorial/');
    }

    public function eliminar(Request $req)
    {
        if ($model = NuestraEditorial::where('id', $req->id)->get()->first())
            $model->delete();
        return redirect('/admin/nuestra-editorial');
    }

    public function obtener()
    {
        return NuestraEditorial::all();
    }

    public function cEstado(Request $req)
    {
        if ($modelo = NuestraEditorial::where('id', $req->id)->get()->first()) {
            $modelo->estado = $modelo->estado * -1;
            $modelo->save();
        }
    }

    public function oEstado(Request $req)
    {
        if ($modelo = NuestraEditorial::where('id', $req->id)->get()->first()) {
            return $modelo->estado;
        }
    }

    public function guardarLibros(Request $req)
    {
        if ($model = NuestraEditorial::where('id', $req->id)->get()->first()) {
            $model->libros = $req->libros;
            $model->save();
            return "Libros guardados";
        }
    }

    public function obtenerLibros(Request $req)
    {
        if ($model = NuestraEditorial::where('id', $req->id)->get()->first()) {
            return $model->libros;
        }
    }

    public function GetById(Request $req)
    {
        if ($model = NuestraEditorial::where('id', $req->id)->get()->first()) {

            return $model;
        }
    }
}
