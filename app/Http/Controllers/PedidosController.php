<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use TypiCMS\Modules\Pedidos\Facades\Pedidos;
use TypiCMS\Modules\Pedidos\Models\Pedido;

class PedidosController extends Controller
{
    // || Controlador para los pedidos internos || //

    public function getPedidos(Request $req)
    {
        $currentPage = 1;
        if ($req->pagina != null) {
            $currentPage = $req->pagina;
        }

        if ($req->props != null) {
            /*
                array:6 [
                "search" => "Entregado"
                "dir" => "asc"
                "column" => "nombreUsuario"
                "filters" => []
                "length" => "10"
                "page" => 1
            */

            if ($req->props['dir'] != "" && $req->props['search'] != "") {

                $ret = Pedidos::select('*')
                    ->where('clienteID', $req->props['search'])
                    ->orWhere('id', $req->props['search'])
                    ->orWhere('nombreCliente', $req->props['search'])
                    ->orWhere('estadoEnvio', $req->props['search'])
                    ->orderBy($req->props['column'], $req->props['dir'])
                    ->paginate($req->props['length'], ['*'], 'page', $currentPage); // Otra forma de paginar

                return response()->json([
                    'data' => $ret,
                    'total' => $ret->lastPage()
                ]);
            } else if ($req->props['search'] == "") {

                $currentPage = $req->props['page'];

                if ($req->pagina != null) {
                    $currentPage = $req->pagina;
                }
                $ret = Pedidos::orderBy($req->props['column'], $req->props['dir'])->paginate($req->props['length'], ['*'], 'page', $currentPage);
                return response()->json([
                    'data' => $ret,
                    'total' => $ret->lastPage()
                ]);
            }
        } else {
            $ret = Pedidos::select('*')->paginate(10, ['*'], 'page', $currentPage);
            return response()->json([
                'data' => $ret,
                'total' => $ret->lastPage()
            ]);
        }
    }

    public function getPedidosAll() {
        return Pedidos::all();
    }

    public function getByUserID(Request $req)
    {
        if ($pedido = Pedidos::where('id', '=', $req->id)->first()) {
            return $pedido;
        } else {
            return '|| Pedido no encontrado. ||';
        }
    }

    function calcular_envio()
    {
        return 0;
    }

    public function changeEstado(Request $req)
    {
        if ($pedido = Pedidos::where('id', $req->id)->first()) {
            if ($req->estado == '0') {
                return null;
            }
            $pedido->estadoEnvio = $req->estado;
            $pedido->save();
            return 'Estado actualizado';
        } else {
            return 'Pedido no encontrado';
        }
    }

    public function delete(Request $req)
    {
        
        foreach ($req->ids as $id) {
            if ($pedido = Pedidos::where('id', $id)->first()) {
                $pedido->delete();
            } else {
            }
        }
    }
}
