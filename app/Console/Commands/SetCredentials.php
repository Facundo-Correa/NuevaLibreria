<?php

namespace App\Console\Commands;

use App\Pais;
use App\Subcategoria;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Books\Models\Publisher;
use TypiCMS\Modules\Categorias\Facades\Categorias;
use TypiCMS\Modules\Categorias\Models\Categoria;

use App\MercadoLibreCredentials;
use App\Http\Controllers\MLTokenController;

class SetCredentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:MlCredentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
        MercadoLibreCredentials::truncate();
        $credenciales = new MercadoLibreCredentials();
        $credenciales->AUTH_TOKEN = env('AUTH_CODE');
        $credenciales->save();

        $authCode = MercadoLibreCredentials::first()->AUTH_TOKEN;
        $CURL = curl_init();
        curl_setopt($CURL, CURLOPT_URL, 'https://api.mercadolibre.com/oauth/token?grant_type=authorization_code&client_id=4214006257775007&client_secret=MPV89CEAsHtRZ6OVofLfzok03pndEz9e&code=' . $authCode . '&redirect_uri=https://newsite.nuevalibreria.com.ar/api/refrescar_token');
        curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($CURL, CURLOPT_POSTFIELDS, [
            /*?grant_type=authorization_code&client_id='.env('CLIENT_ID').'&client_secret='.env('SECRET_KEY').'&code='.$authCode.'&redirect_uri=https://newsite.nuevalibreria.com.ar/api/refrescar_token'
                */
            'grant_type' => 'authorization_code',
            'client_id' => '4214006257775007',
            'client_secret' => 'MPV89CEAsHtRZ6OVofLfzok03pndEz9e',
            'code' => $authCode,
            'refresh_token' => $authCode,
            'redirect_uri' => 'https://newsite.nuevalibreria.com.ar/api/refrescar_token',
        ]);
        $response = curl_exec($CURL);
        curl_close($CURL);

        // || Update token

        $response = json_decode($response);
        $APP_ID = env('APP_ID');
        $SELLER_ID = env('SELLER_ID');

        $REFRESH_TOKEN = $response->refresh_token;
        $ACCESS_TOKEN = $response->access_token;

        MercadoLibreCredentials::truncate();

        $MLP = new MercadoLibreCredentials();
        $MLP->APP_ID = $APP_ID;
        $MLP->SELLER_ID = $SELLER_ID;
        $MLP->AUTH_TOKEN = $REFRESH_TOKEN;
        $MLP->ACCESS_TOKEN = $ACCESS_TOKEN;
        $MLP->save();

        return 0;
    }
}
