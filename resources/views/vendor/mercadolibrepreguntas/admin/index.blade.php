@extends('core::admin.master')

@section('title', __('Mercadolibrepreguntas'))

@section('content')

@php
    use App\Http\Controllers\MLTokenController;
    use App\MercadoLibreCredentials;

    MLTokenController::refrescar_token();

    
// || --------------------------------------------- || //
    // || Preguntas
    
    if(isset(MercadoLibreCredentials::first()->ACCESS_TOKEN)){

    }
    $preguntas_vendedor = call(
        'https://api.mercadolibre.com/my/received_questions/search',
        [],
        [
            "Content-Type: application/json",
            "Authorization: Bearer " . MercadoLibreCredentials::first()->ACCESS_TOKEN    
        ],
    );
    // || --------------------------------------------- || //

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

<datapreguntasmeli
dprop="{{json_encode($preguntas_vendedor)}}"
token="{{env('ACCESS_TOKEN')}}"
></datapreguntasmeli>

@endsection
