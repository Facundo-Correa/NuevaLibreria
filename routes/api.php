<?php

use App\Http\Controllers\AndreaniController;
use App\Http\Controllers\MLTokenController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PreguntasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Preguntas\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('pedidos', [PedidosController::class, 'getPedidos']);
Route::get('pedidos/all', [PedidosController::class, 'getPedidosAll']);
Route::post('cambiar-estado-pedido', [PedidosController::class, 'changeEstado']);
Route::post('eliminar-pedidos', [PedidosController::class, 'delete']);
Route::get('refrescar_token', [MLTokenController::class, 'refrescar_token']);


Route::post('preguntas/get', [PreguntasController::class, 'get']);
Route::post('preguntas/get/id', [PreguntasController::class, 'getByID']);
Route::post('preguntas/get/pub', [PreguntasController::class, 'getByPub']);
Route::post('pregunta/responder', [PreguntasController::class, 'answer']);

Route::get('andreani/download/{pedidoID}', [AndreaniController::class, 'download']);
/*Route::get('andreani/downloadtest', function() {
    $dir = public_path() . '/' . 'etiquetas/';
        $nombre = 'etiquetas.pdf';

        $file = $dir . $nombre;

        $headers = array(
            'Content-Type: application/' . 'pdf'
        );

        return Response::download($file, basename($file), $headers);
});*/

Route::post('promociones/actualizar', [\App\Http\Controllers\UpdatePromosController::class, 'update']);
