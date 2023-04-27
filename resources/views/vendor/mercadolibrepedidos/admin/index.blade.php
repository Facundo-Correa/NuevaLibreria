@extends('core::admin.master')

@section('title', __('Mercadolibrepedidos'))

@push('js')
    <script>/*
        // || Obtener auth token 

        //  https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=4214006257775007&redirect_uri=https://newsite.nuevalibreria.com.ar/api/refrescar_token
        axios.post('https://auth.mercadolibre.com.ar/authorization', {
            response_type:'code',
            client_id: '4214006257775007',
            redirect_uri: 'https://newsite.nuevalibreria.com.ar/api/refrescar_token'
        }).then((response) => {
            console.log(response);
        });

        // || Obtener access token
        */
       //window.location = "https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=4214006257775007&redirect_uri=https://newsite.nuevalibreria.com.ar/api/refrescar_token";
       //window.location = "http://localhost:8000/api/refrescar_token?code=TG-624749f2622f99001ac89045-1047842538";
    </script>
@endpush





@section('content')


@php

    use App\MercadoLibreCredentials;
    use App\Http\Controllers\MLTokenController;
    MLTokenController::refrescar_token();


        $pedidos = null;

        $CRED = MercadoLibreCredentials::all()->first();
        if(isset($CRED->AUTH_TOKEN)){
            $paginado = call('https://api.mercadolibre.com/orders/search?seller=303551670', [], [
                "Content-Type: application/json",
                "Authorization: Bearer " . $CRED->ACCESS_TOKEN
            ])->paging->total; //total de items pedidos

        }
        //dd($paginado);

        $offset = $paginado - 20; //total de items a mostrar <=20

        if(isset($CRED->AUTH_TOKEN)){
            $pedidos = call('https://api.mercadolibre.com/orders/search?seller=303551670&offset='.$offset, [], [
                "Content-Type: application/json",
                "Authorization: Bearer " . $CRED->ACCESS_TOKEN
            ])->results;

        }

        //dd($pedidos);
        //dd($pedidos[0]->status); //item pagado
        //dd($pedidos[0]->order_items[0]->item); //item
        //dd($pedidos[0]->order_items[0]->item->id); //id
        //dd($pedidos[0]->order_items[0]->item->title); //titulo del articulo pedido
        //dd($pedidos[0]->date_created); //fecha del pedido
        //dd($pedidos[0]->order_items[0]->quantity); //cantidad del item
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
                $ret = array(
                    '0' => ['results' => json_decode($response)->message]
                );
                return json_decode(json_encode(array_values($ret)))[0];
            }
            
            return json_decode($response);
    }
@endphp

<datapedidosmeli
    dprop="{{json_encode($pedidos)}}"
></datapedidosmeli>

@endsection
