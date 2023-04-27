@extends('core::admin.master')

@section('title', __('Mercadolibrepublicaciones'))

@section('content')

    @php
        // || Obteniendo todos los items del vendedor || //
        use App\Http\Controllers\MLTokenController;
        use App\MercadoLibreCredentials;

        MLTokenController::refrescar_token();


        if(isset(MercadoLibreCredentials::first()->ACCESS_TOKEN)){

            //"https://api.mercadolibre.com/users/303551670/items/search"
            //"https://api.mercadolibre.com/sites/MLA/search?seller_id=303551670&limite=20%offset=0"
            //"https://api.mercadolibre.com/sites/MLA/search?q=&seller_id=303551670&limit=20&offset=0"

            $pag = 0;
            $articulos = '';
            $paginado = "";
            //dd($pagina);
            //dd($articulo);

            if($pagina > 0){
                $paginado = "&offset="."$pagina" ;
            } else {
                $paginado ="&offset=0";
            }

            $items_vendedor = call(
                "https://api.mercadolibre.com/sites/MLA/search?q=".$articulo."&seller_id=303551670&limit=20".$paginado,
                [],
                [
                    "Content-Type: application/json",
                    "Authorization: Bearer " . MercadoLibreCredentials::first()->ACCESS_TOKEN
                ]
            )->results;
            //dd($items_vendedor);
            
            $items_ids = '';
            $info_items = [];

            if($items_vendedor == 'ACCESS TOKEN ERR'){
                // || Mostrar error en pantalla, programar notificacion || //
                dd('Error en el access token de Mercado Libre');
            }
            foreach($items_vendedor as $item) {
                $items_ids.= $item->id . ',';
            }

            $info_items = call(
                "https://api.mercadolibre.com/items?ids=" . $items_ids,
                [],
                ["Authorization: Bearer " . MercadoLibreCredentials::first()->ACCESS_TOKEN]
            );
            //Cantidad del stock
            //dd($info_items);
            //dd($info_items[0]->body->category_id); //esto me devuelve la categoria del item

        }

        // || ------------------------------------------//

        function call($url = '', $params = [], $headers = []) {
            $lastUrl = $url;

            if(count($params) >=1) {
                $lastUrl .= '?';
                foreach($params as $p) {
                    $lastUrl .= $p . '&';
                }
            }

            $curl = curl_init($lastUrl);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);
            curl_close($curl);

            if(isset(json_decode($response)->message)){
                if(json_decode($response)->message == "Invalid token"){
                $ret = array(
                    '0' => ['results' => 'ACCESS TOKEN ERR']
                );
                return json_decode(json_encode(array_values($ret)))[0];
            }
            }
            return json_decode($response);
        }

    @endphp

<div class="row mb-2">
    <div class="col">
        <button class="btn btn-danger" onclick='paginar(<?php echo $pagina - 20 ?>)'>Anterior</button>
    </div>
    <div class="col">
        <button class="btn btn-primary" onclick='paginar(<?php echo $pagina +20 ?>)'>Siguiente</button>
    </div>
    <div class="col">
        
    </div>
    <div class="col ">
        <div>
            <input
                name="name"
                class="form-control"
                placeholder="Buscar publicacion"
                id="input"
            />
        </div>
    </div>
    <div class="col ">
        <button class="btn btn-success" onclick='buscar(<?php echo $articulo = $articulos ?>)'>Buscar</button>
    </div>
</div>



<datapublicacionesmeli class="data" dprop="{{json_encode($info_items)}}"
></datapublicacionesmeli>

@endsection
<script>
    function paginar(offset){
        let url = window.location.href;
        let indice = url.indexOf("pagina=");
        let newUrl = url.substr( 0, indice );
        if(offset < 0){
            console.log(newUrl+"pagina=0");
            location.href = newUrl+"pagina=0";
        }
        else{
            console.log(newUrl+"pagina="+offset);
            location.href = newUrl+"pagina="+offset;
        }
    }   
    function buscar(articulo){
        let busca = document.getElementById('input');
        buscador = busca.value;
        articulo = buscador.split(/\s+/).join('');
        let location = window.location.href;
        let index = location.indexOf("articulo=");
        let newLocation = location.substr(0, index);
        window.location.href = newLocation+"articulo="+articulo+"/pagina=0";
    }
</script>
