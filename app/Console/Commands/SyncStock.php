<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MercadoLibreCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MLTokenController;
use App\Mercadolibrestock;
use App\Books;

class SyncStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        MLTokenController::refrescar_token();
        $CRED = MercadoLibreCredentials::all()->first();

        //defino el offset llamando al total de pedidos
        $paginadoUrl = 'https://api.mercadolibre.com/orders/search?seller=303551670';
        $paginadoParams = [];
        $paginadoHeaders = ["Content-Type: application/json", "Authorization: Bearer " . $CRED->ACCESS_TOKEN];
        $paginadoCurl = curl_init($paginadoUrl);
        curl_setopt($paginadoCurl, CURLOPT_URL, $paginadoUrl);
        curl_setopt($paginadoCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($paginadoCurl, CURLOPT_HTTPHEADER, $paginadoHeaders);
        $respuesta = curl_exec($paginadoCurl);
        curl_close($paginadoCurl);
        dd($respuesta);
        $paginado = json_decode($respuesta)->paging->total;
        $offset = $paginado -20;

        //llamada a los últimos 20 pedidos
        $url = 'https://api.mercadolibre.com/orders/search?seller=303551670&offset='.$offset;
        $params = [];
        $headers = ["Content-Type: application/json", "Authorization: Bearer " . $CRED->ACCESS_TOKEN];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);

        if(isset(json_decode($response)->message)){
            $ret = array(
                '0' => ['results' => json_decode($response)->message]
            );
            return json_decode(json_encode(array_values($ret)))[0];
        }

        $estado = json_decode($response)->results;
        //dd($estado[0]->order_items->quantity); //trae la cantidad del pedido
        //dd($estado[0]->order_items[0]->item->id); //trae el MLA(etc etc)

        //esto se ejecuta una sola vez si y solo si la tabla esta vacía.
        for($a = 0; $a < 20; $a++){
            $table = Mercadolibrestock::find($a+1);
            if($table == null){
                Mercadolibrestock::create([
                    'status'=>$estado[$a]->status,
                    'item_id'=>$estado[$a]->order_items[0]->item->id,
                    'fecha'=>$estado[$a]->date_created,
                ]);
                $PedidosAgregados = 'Pedidos agregados a la tabla';
                var_dump($PedidosAgregados);
            }
        }
        
        //comparamos los nuevos pedidos con los viejos
        for($e = 0; $e < 20; $e++){

            $libros = Mercadolibrestock::find($e+1);
            //¿Por qué $e+1? Porque la tabla empieza por la fila 1
            $viejoId = $libros->item_id;
            $nuevoId = $estado[$e]->order_items[0]->item->id;
            $viejaFecha = $libros->fecha;
            $nuevaFecha = $estado[$e]->date_created;
            $condicionIf = $viejoId == $nuevoId;
            
            if($condicionIf){
                $echo = '*| * El cron NO hizo cambios en la fila - '.($e+1).' - |*';
                
                //todo esto pasarlo al else

/* ----------------------- de Mercado Libre a la base de datos ----------------------- */

                //hacemos llamada al stock de los productos agregados nuevos
                $urlStock = 'https://api.mercadolibre.com/items/'.$estado[$e]->order_items[0]->item->id;
                $paramsStock = [];
                $headersStock = ["Content-Type: application/json", "Authorization: Bearer " . $CRED->ACCESS_TOKEN];
                $curlStock = curl_init($urlStock);
                curl_setopt($curlStock, CURLOPT_URL, $urlStock);
                curl_setopt($curlStock, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curlStock, CURLOPT_HTTPHEADER, $headersStock);
                $responseStock = curl_exec($curlStock);
                curl_close($curlStock);

                //guardamos la cantidad del stock en la variable para esta publicacion numero $e
                $stockMl = json_decode($responseStock);
                
                //Cantidad de stock del item en Mercado Libre
                $stockML = $stockMl->available_quantity;
                //var_dump('Stock de Mercado Libre: '.$stockML);

                //buscamos el campo ISBN del producto de ML
                //está en un for porque no siempre está en la misma posición
                for($j = 0; $j < 10; $j++){
                    if($stockMl->attributes[$j]->name == 'ISBN'){
                        $isbnMl = $stockMl->attributes[$j]->value_name;
                        //rompemos el ciclo for cuando lo encuentra, sino tira error
                        break;
                    }
                }
                
                //traigo la fila entera del libro en la DB
                $isbn1 = Books::where('isbn1','=',9781456267568)->get(); // <- ->cambiar el numero por $isbnMl
                $itemTabla = json_decode($isbn1);
                //var_dump('Disponibles: '.$itemTabla[0]->available);

                //si el stock de Mercado Libre es = a 0, actualizamos en la DB la disponibilidad del libro
                //if($stockML == 0){
                //    Books::where('isbn1','=',9781456267568)
                //    ->update(['available'=>0]);//en lugar de update va delete();
                //}
/* ----------------------- fin: de Mercado Libre a la base de datos ----------------------- */

            }
            else{
                Mercadolibrestock::find($e+1)->update([
                    'status'=>$estado[$e]->status,
                    'item_id'=>$estado[$e]->order_items[0]->item->id,
                    'fecha'=>$estado[$e]->date_created,
                ]);
                $echo = '*| * El cron SI hizo cambios en la fila - '.($e+1).' - |*';
                }
            //var_dump($echo);
            //var_dump('ID de la tabla '.$viejoId);
            //var_dump('ID de PedidosML '.$nuevoId);
        }

/* ----------------------- de la base de datos a Mercado Libre ----------------------- */
        $books1 = Books::where('available','=','0')->where('ml_status','=','si')->get();
        $books = json_decode($books1);//en un array todos los libros de stock 0 y publicados en ML
        //dd($books[0]);
        //buscar en ML el producto segun ISBN
        //¿URL del producto por ISBN?
        
    }// <--- fin del handle
}
