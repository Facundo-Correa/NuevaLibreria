<?php

namespace App\Http\Controllers;

use App\carrito;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use TypiCMS\Modules\Users\Models\User;

class OrderController extends Controller
{
    //
    public $costoEnvio;
    public $cPostal;
    public $envioAndreani;
    public function saveOrder(Request $req) {
        if(isset($req->envioAndreani)){
            $this->envioAndreani = $req->envioAndreani;
        }
        else {
            $this->envioAndreani = nulL;
        }
        $this->cPostal = $req->cPostal;

        $user = new User();
        $this->verify($req->user, $req->password, false);

        if(isset(Auth::user()->id)){
            // || Se pudo loguear
        }
        else {
            // || Avisarle que algo salio mal
            $user = new User();

            $user->email = $req->user;
            $user->password = Hash::make($req->password);
            $user->country = $req->pais;
            $user->activated = 1;
            $user->first_name = $req->nombre;
            $user->last_name = $req->apellido;
            $user->street = $req->direccion;
            $user->number = $req->dpu;
            $user->city = $req->localidad . ', ' . $req->provincia;
            $user->postal_code = $req->cPostal;
            $user->phone = $req->telefono;
            $user->privacy_policy_accepted = 1;

            $user->save();
            $this->verify($user->email, $user->password, false);
            //return redirect('/es/ checkout')->with('error', 'Verifique usuario y contraseña');
        }

        //$data = json_decode($req->data);
        $cart = carrito::where('SessionID', Session::getId())->first();

        if($cart != null){
            $cart = $cart->Cart;
        }
        else if (isset(Auth::user()->id)){
            $cart = carrito::where('UserId', Auth::user()->id)->first();
            if($cart != null){
                $cart = $cart->Cart;
            }
        }

        if($cart == null){
            $cart = new carrito();
            $cart->SessionID = Session::getId();
            if (isset(Auth::user()->id)){
                $cart->UserId = Auth::user()->id;
            }
            $cart->Cart = '[]';
            $cart->save();
            $cart = $cart->Cart;
        }

        $total = $req->total;
        $this->costoEnvio = ($this->call('https://apisqa.andreani.com/v1/tarifas?contrato=400006709&cliente=CL0003750&sucursalOrigen=MIC&bultos[0][valorDeclarado]=2500&cpDestino=1852',
        [],
        []
        )->tarifaConIva->total);

        // dd($total);

        if(!isset(Auth::user()->id)){

        }
        else {
            $user = User::where('id', Auth::user()->id)->first();
            $data = Array(
                'Pais' => $user->country,
                'Nombre' => $user->first_name,
                'Apellido' => $user->last_name,
                'userId' => $user->id,
                'SessionID' => Session::getId(),
                'CardToken' => $req->token,
                'PaymentMethod' => $req->paymethod,
                'Email' => $user->email,
                'Calle' => $req->calle,
                'Numero' => $req->numero,
                'Localidad' => $req->localidad,
                'Documento' => $req->documento
            );
        }

        $order = new Order();
        if($ord = Order::where('SessionID', Session::getId())->orWhere('UserId', Auth::User()->id)->first()){
            $order = $ord;
        }
        $order->cart = $cart;
        $order->total = $total + $this->costoEnvio;
        $order->data = json_encode($data);
        $order->SessionID = Session::getId();
        $order->UserId = Auth::User()->id;

        $order->save();
        return $this->ToMp($order);
    }

    public function ToMp($order) {
        return redirect('/api/MercadoPagoPagar')->with('order', $order)->with('costoEnvio', $this->costoEnvio)->with('cPostal', $this->cPostal)->with('envioAndreani', $this->envioAndreani);
    }


    function verify($email, $password, $debug) {
        $credenciales = array('email' => $email, 'password' => $password);
        // || Todo bien, todo correcto y yo que me alegro.

        if(Auth::attempt($credenciales)){

            $user = User::where('email', $email)->first();
            if($user != null){
                if($user->activated == 1){
                    request()->session()->regenerate();
                }
            }
        }
        if($debug){
            dd(Auth::attempt($credenciales), $credenciales);
        }

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
}
