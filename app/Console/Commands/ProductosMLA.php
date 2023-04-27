<?php

namespace App\Console\Commands;
use App\MercadoLibreCredentials;
use App\Http\Controllers\MLTokenController;
use App\MlaProductos;
use Illuminate\Console\Command;

class ProductosMLA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'productos:mla';

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

        //buscamos el total de los items publicados
        $paginadoUrl = 'https://api.mercadolibre.com/users/303551670/items/search';
        $paginadoParams = [];
        $paginadoHeaders = ["Content-Type: application/json", "Authorization: Bearer " . $CRED->ACCESS_TOKEN];
        $paginadoCurl = curl_init($paginadoUrl);
        curl_setopt($paginadoCurl, CURLOPT_URL, $paginadoUrl);
        curl_setopt($paginadoCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($paginadoCurl, CURLOPT_HTTPHEADER, $paginadoHeaders);
        $respuesta = curl_exec($paginadoCurl);
        curl_close($paginadoCurl);
        $total = json_decode($respuesta)->paging->total;

        //vamos creando de a 1 item en la tabla por el tital de items publicados en ML
        for ( $i = 0; $i < $total; $i++)
        {
            $offset = 1152 + ($i*10);
            $linea = 11520;

            //buscamos el id del producto publicado por vendedor ya que desconocemos su id
            $url = 'https://api.mercadolibre.com/sites/MLA/search?q=&seller_id=303551670&limit=10&offset='.$offset;
            $parametros = [];
            $header = ["Content-Type: application/json", "Authorization: Bearer " . $CRED->ACCESS_TOKEN];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            $response = curl_exec($curl);
            curl_close($curl);
            $estado = json_decode($response)->results;

            for ($k = 0; $k < 10; $k++){
            
                //obtenemos su id y se lo asignamos a una variable
                $mla = $estado[$k]->id;
            
                //ahora que conocemos su id, buscamos su isbn
                $url2 = 'https://api.mercadolibre.com/items/'.$mla;
                $parametros2 = [];
                $header2 = ["Content-Type: application/json", "Authorization: Bearer " . $CRED->ACCESS_TOKEN];
                $curl2 = curl_init($url2);
                curl_setopt($curl2, CURLOPT_URL, $url2);
                curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl2, CURLOPT_HTTPHEADER, $header2);
                $response2 = curl_exec($curl2);
                curl_close($curl2);
                $estado2 = json_decode($response2);
                
                if($estado2 != null){
                    if($estado2->attributes){
                        for( $j = 0; $j < 10; $j++){
                            if($estado2->attributes[$j]->name == 'ISBN'){
                                $isbn = $estado2->attributes[$j]->value_name;
                                break;
                            }
                        }
                    }
                }
                
                
                //creamos el item siempre que $i sea menor al total de los items
                if( $i < $total){
                    $table = MlaProductos::find($i+1+$linea);
                    if($table == null){
                        MlaProductos::create([
                            'MLA'=>$estado2->id,
                            'title'=>$estado2->title,
                            'ISBN'=>$isbn,
                        ]);
                        $echo = 'Se creó un nuevo item en la fila: '.($linea+$i+1+$k);
                        var_dump($echo);
                    }
                }
                else{
                    $echo = 'No se creó ningún nuevo item';
                    var_dump($echo);
                }
            }
        }
    }
}
