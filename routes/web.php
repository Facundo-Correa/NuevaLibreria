<?php
ini_set('max_execution_time', 58000);

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\RegisterController;
use App\Mail\AvisoPago;
use App\Mail\AvisoPagoComprador;
use App\SobreNosotros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Concerns\ToArray;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Books\Models\Bookauthor;
use TypiCMS\Modules\Books\Models\Publisher;
use TypiCMS\Modules\Categorias\Facades\Categorias;
use TypiCMS\Modules\Categorias\Models\Categoria;
use TypiCMS\Modules\Clientesinternacionales\Models\Clientesinternacionale;
use TypiCMS\Modules\Contadores\Models\Contadore;
use TypiCMS\Modules\Inicios\Http\Controllers\ExposicionesController;
use TypiCMS\Modules\Inicios\Http\Controllers\SobreNosotrosController;
use TypiCMS\Modules\Users\Http\Controllers\ApiController;
use TypiCMS\Modules\Users\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function() {


});


Route::post('/imagenes/imagenes', [ImagenesController::class, 'get']);
Route::post('/admin/books/obtener', function () {
    return Book::all();

});


// ----------------------------------- //
// || Registro y logueo || //
// ----------------------------------- //

Route::post('/es/verificar-credenciales-manual', [LoginController::class, 'verifyManual']);
Route::post('/es/verificar-credenciales', [LoginController::class, 'verify']);
Route::get('/es/logout', [LoginController::class, 'logout']);

Route::get('/es/nuestro-blog/{pagina}', [BlogController::class, 'get']);
Route::get('/es/nuestro-blog/buscar/{busqueda}/{pagina}', [BlogController::class, 'find']);
Route::get('/es/nuestro-blog/{categoria}/{pagina}', [BlogController::class, 'categoria']);

Route::post('/es/register', [RegisterController::class, 'register']);

// ----------------------------------- //



// ----------------------------------- //
// || Paginación tienda || //
// ----------------------------------- //


Route::get('/es/tienda/{page?}', [BookController::class, 'paginate']);
//Route::get('/es/tienda/busqueda/{busqueda}', [BookController::class, 'search']);
Route::get('/es/tienda/{categoria}/{page}', [BookController::class, 'paginateWithCategory']);

Route::get('/es/libro/{isbn}', [BookController::class, 'getBook']);

Route::get('/es/nuestra-editorial/{page}', [BookController::class, 'getOurEditorial']);
Route::get('/es/nuestra-editorial/{category}/{page}', [BookController::class, 'getOurEditorialWithCategory']);


// ----------------------------------- //

Route::get('en/', function(){
    return redirect('/es/inicio');
});
Route::get('es/', function(){
    return redirect('/es/inicio');
});
Route::get('/', function(){
    return redirect('/es/inicio');
});

// ----------------------------------- //


// ----------------------------------- //
// || Controlador de imagenes || //
// ----------------------------------- //

Route::get('/es/cover/{isbn}', [CoverController::class, 'get']);
// ----------------------------------- //

Route::get('/es/mi-carrito/{userID}', [CarritoController::class, 'detailCart']);
Route::get('/es/mi-carrito/', [CarritoController::class, 'redirect']);
Route::post('/api/obtener-usuario', [ApiController::class, 'getUser']);


//Route::post('/api/obtener-carrito', [ApiController::class, 'getCart']);
//Route::post('/api/actualizar-carrito', [ApiController::class, 'updateCart']);

Route::post('/api/add-carrito', [CarritoController::class, 'addToCart']);
Route::post('/api/obtener-carrito', [CarritoController::class, 'getCart']);
Route::post('/api/vaciar-carrito', [CarritoController::class, 'emptyCart']);
Route::post('/api/modificar-cantidad', [CarritoController::class, 'modifyCantidad']);
Route::post('/api/eliminar-del-carrito', [CarritoController::class, 'removeFromCart']);



// ----------------------------------- //
// || Blog || //
// ----------------------------------- //

Route::get('/es/blog/{id}', [BlogController::class, 'show']);
Route::get('/es/blog/', function() {
    return redirect('/es/nuestro-blog');
});

Route::get('/es/checkout', [checkoutController::class, 'checkLogin']);
Route::post('/api/guardar-orden', [OrderController::class, 'saveOrder']);

// || Mercado Pago
Route::get('/api/MercadoPagoPagar', [PaymentController::class, 'MercadoPagoPay']);

Route::post('/avisar-pago', function(Request $req) {
    $correo = new AvisoPago();
    $user = User::where('id', Auth::user()->id)->first();
    $data = array(
        'productos' => $req->productos,
        'comprador' => $user->email,
        'importe' => '$' . $req->importe,
        'user' => $user
    );
    $correo->info = $data;

    // || Correo de la libreria
    Mail::to('martinezlucassebastiann41@gmail.com')->send($correo);

    $correo = new AvisoPagoComprador();
    $data = array(
        'productos' => $req->productos,
        'importe' => '$' . $req->importe
    );
    $correo->info = $data;

    // || Correo para el usuario
    Mail::to($user->email)->send($correo);

    return 'emitido';
});

Route::get('/admin/pedidos/mercado-libre', function() {
    return redirect('/admin/mercadolibrepedidos')->with('ok', 'ok');
});

Route::post('/admin/preguntas/guardar', [PreguntasController::class, 'guardar']);
