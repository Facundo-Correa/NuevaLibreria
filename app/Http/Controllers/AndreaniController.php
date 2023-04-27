<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use TypiCMS\Modules\Pedidos\Facades\Pedidos;
use TypiCMS\Modules\Pedidos\Models\Pedido;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class AndreaniController extends Controller
{
    //
    public function download($pedidoID) {
        
        //$pedidoID = $req->pedidoID;
        $pedido = Pedidos::where('id', $pedidoID)->first();
        $etiquetas = $pedido->etiquetas;

        $curl = curl_init('https://apisqa.andreani.com/login');
          curl_setopt($curl, CURLOPT_URL, 'https://apisqa.andreani.com/login');
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            'userName' => env('TEST_USER_ANDREANI'),
            'password' => env('TEST_PASS_ANDREANI'),
          ]));

        $response = curl_exec($curl);
        curl_close($curl);
        
        
        $token = json_decode($response)->token;

        $curl = curl_init($etiquetas);
          curl_setopt($curl, CURLOPT_URL, $etiquetas);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'x-authorization-token: '. $token,
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        //header('Content-Type: application/pdf');
        //header('Content-Disposition: attachment; filename=my.pdf');
        //echo $response;

        $dir = public_path() . '/' . 'etiquetas/';
        $nombre = 'etiqueta pedido nro. ' . $pedido->id . ' - ' . $pedido->nombreCliente . '.pdf';

        $archivo = fopen($dir. $nombre, "w+b");    // Abrir el archivo, creándolo si no existe
        if( $archivo == false )
          echo "Error al crear el archivo";
        else{
          echo "El archivo ha sido creado";
          file_put_contents($dir. $nombre, $response);
        }
        fclose($archivo);   // Cerrar el archivo
        
        $dir = public_path() . '/' . 'etiquetas/';

        $file = $dir . $nombre;

        $headers = array(
            'Content-Type: application/' . 'pdf'
        );

        return Response::download($file, basename($file), $headers);
        
    }
}
