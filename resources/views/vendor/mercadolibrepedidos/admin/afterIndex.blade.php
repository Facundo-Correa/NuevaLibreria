@extends('core::admin.master')

@section('title', __('Mercadolibrepedidos'))

@php
use App\MercadoLibreCredentials;
    $pedidos = '';
    
    $CRED = MercadoLibreCredentials::all()->first();
    if(isset($CRED->auth_token)){
        
        $pedidos = call('https://api.mercadolibre.com/orders/search?seller=' . $CRED->auth_token, [], [
            "Content-Type: application/json",
            "Authorization: Bearer " . $CRED->access_token
        ])->results;
    }
    
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


@section('content')
<datapedidosmeli
    dprop="{{json_encode($pedidos)}}"
></datapedidosmeli>
@endsection
