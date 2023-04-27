<?php

namespace App\Http\Controllers;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class InicioController extends BaseAdminController
{
    public function index()
    {
        return view('inicios::admin.index');
    }

    public function crear()
    {
        return view('inicios::admin.create');
    }

    public function editar(Request $req)
    {
        if ($modelo = Inicio::where('id', $req->id)->get()->first()) {
            return view('inicios::admin.edit', compact('modelo'));
        }
    }

    public function guardar(Request $req)
    {
        $promo = 0;
        $publicidades = 0;
        $sn = 0;
        $carrusel = 0;
        $expo = 0;
        $ned = 0;
        if ($modelo = Inicio::where('id', $req->id)->get()->first()) {
            $promo = $modelo->promociones;
            $publicidades = $modelo->publicidades;
            $sn = $modelo->sobre_nosotros;
            $carrusel = $modelo->carrusel;
            $expo = $modelo->exposicion;
            $ned = $modelo->nuestra_editorial;
            $modelo->delete();
        }
        $modelo = new Inicio();
        $modelo->name = $req->name;
        $modelo->estado = 1;
        $modelo->promociones = $promo;
        $modelo->publicidades = $publicidades;
        $modelo->sobre_nosotros = $sn;
        $modelo->carrusel = $carrusel;
        $modelo->exposicion = $expo;
        $modelo->nuestra_editorial = $ned;
        $modelo->save();
        echo ("Inicio creado");
        return redirect('/admin/inicio');
    }

    public function eliminar(Request $req)
    {
        if ($modelo = Inicio::where('id', $req->id)->get()->first()) {
            $modelo->delete();
            return redirect('/admin/inicio/');
        }
    }

    public function obtener()
    {
        return Inicio::all();
    }

    public function cEstado(Request $req)
    {
        if ($modelo = Inicio::where('id', $req->id)->get()->first()) {
            $modelo->estado = $modelo->estado * -1;
            $modelo->save();
            return "Estado cambiado";
        }
    }

    public function oEstado(Request $req)
    {
        if ($modelo = Inicio::where('id', $req->id)->get()->first()) {
            return $modelo->estado;
        }
    }

    public function guardarProps(Request $req)
    {
        if ($IN = Inicio::where('id', $req->id)->get()->first()) {

            if ($req->exposiciones) {
                $IN->exposicion = Exposiciones::where('name', $req->exposiciones)->get()->first()->id;
            }
            if ($req->sobre_nosotros) {
                $IN->sobre_nosotros = SobreNosotros::where('name', $req->sobre_nosotros)->get()->first()->id;
            }
            if ($req->input('nuestra-editorial')) {
                $IN->nuestra_editorial = NuestraEditorial::where('name', $req->input('nuestra-editorial'))->get()->first()->id;
            }
            $IN->save();
        }
    }
}