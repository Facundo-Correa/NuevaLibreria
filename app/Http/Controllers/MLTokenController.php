<?php

namespace App\Http\Controllers;

use App\MercadoLibreCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MLTokenController extends Controller
{
    public function refrescar_token() {
            $authCode = MercadoLibreCredentials::first()->AUTH_TOKEN;
            $appUserCode = MercadoLibreCredentials::first()->ACCESS_TOKEN;
            $CURL = curl_init();
            curl_setopt($CURL, CURLOPT_URL, 'https://api.mercadolibre.com/oauth/token?grant_type=authorization_code&client_id=7299230720486138&client_secret=hl1SZ5ymp2eslyQ1kc3J0OIXywvRbIHE&code='.$authCode.'&redirect_uri=https://newsite.nuevalibreria.com.ar/api/refrescar_token');
            curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($CURL, CURLOPT_POSTFIELDS, [
                /*?grant_type=authorization_code&client_id='.env('CLIENT_ID').'&client_secret='.env('SECRET_KEY').'&code='.$authCode.'&redirect_uri=https://newsite.nuevalibreria.com.ar/api/refrescar_token'
                */
                'grant_type' => 'refresh_token',
                'client_id' => '7299230720486138',
                'client_secret' => 'hl1SZ5ymp2eslyQ1kc3J0OIXywvRbIHE',
                'code' => $authCode,
                'refresh_token' => $authCode,
                'redirect_uri' => 'https://newsite.nuevalibreria.com.ar/api/refrescar_token',
            ]);
            $response = curl_exec($CURL);
            //dd($response);
            curl_close($CURL);

            // || Update token

            $response = json_decode($response);
            $APP_ID = 7299230720486138;
            $SELLER_ID = 303551670;
            
            $REFRESH_TOKEN = $authCode;
            $ACCESS_TOKEN = $appUserCode;
            //$REFRESH_TOKEN = $response->refresh_token;
            //$ACCESS_TOKEN = $response->access_token;

            MercadoLibreCredentials::truncate();

            $MLP = new MercadoLibreCredentials();
            $MLP->APP_ID = $APP_ID;
            $MLP->SELLER_ID = $SELLER_ID;
            $MLP->AUTH_TOKEN = $REFRESH_TOKEN;
            $MLP->ACCESS_TOKEN = $ACCESS_TOKEN;
            $MLP->save();
            
            
            //return redirect('/admin/pedidos/mercado-libre');
            //return redirect('/admin');
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
            if(json_decode($response)->message == "Invalid token"){
            
            }
        }
        else if($response == ""){
            $ret = array(
                '0' => ['results' => '']
            );
            return json_decode(json_encode(array_values($ret)))[0];
        }
        return json_decode($response);
    }
}
