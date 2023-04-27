<?php
namespace App\Http\Controllers;

use App\carrito;
use MercadoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use TypiCMS\Modules\Pedidos\Models\Pedido;
use TypiCMS\Modules\Users\Facades\Users;
use TypiCMS\Modules\Users\Models\User;

class PaymentController extends Controller
{
    // || Controlador de pagos

    public $publicData;
    public $publicOrder;

    public function MercadoPagoPay(){
        $order = Session::get('order');
        $this->publicOrder = $order;
        if($order != null){
            \MercadoPago\SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
            $payment = new \MercadoPago\Payment();

            $data = json_decode($order->data);
            $this->publicData = $data;

            if($order->total == "0"){
              $order->total = '1';
              $order->save();
            }

            

            $payment->transaction_amount = $order['total'];
            $payment->token = $data->CardToken;
            $payment->description = "Compra de libros | Nueva Libreria";
            $payment->installments = 1;
            $payment->payment_method_id = $data->PaymentMethod;
            $payment->payer = array(
              "email" => $data->Email
            );
    
            $payment->save();

            if($payment->status != null){
                switch($payment->status){

                  case "approved": {
                    $order->Pago = "Pagado";
                    $order->save();

                    $carrito = carrito::where('UserId', Auth::user()->id)->first();
                    $carrito->delete();

                    $this->updatePedidos('pagoRealizado');

                    return redirect('/es/inicio')->with('message', 'Su pago ha sido aprobado ¡Muchas gracias!')->with('action', 'send_pay_status_OK')
                    ->with('importe', $order['total'])
                    ->with('productos', $order['cart'])
                    ;
                  }

                  case "in_process": {
                      $order->Pago = "Pendiente";
                      $order->save();

                      $this->updatePedidos('pagoPendiente');

                      return redirect('/es/checkout')->with('message', 'Su pago ha quedado pendiente, puede que se acredite mas tarde. Consulte los movimientos de su tarjeta o su bandeja de mail.');
                  }

                  case "cc_rejected_bad_filled_card_number": {
                      $order->Pago = "";
                      $order->save();
                      return redirect('/es/checkout')->with('message', 'Pago rechazado, revise el numero de la tarjeta.');
                    break;
                  }

                  case "cc_rejected_bad_filled_date": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, revise la fecha de expiración.');
                  }

                  case "cc_rejected_bad_filled_other": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, revise los datos ingresados.');
                  }
                  
                  case "cc_rejected_bad_filled_security_code": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, revise el codigo de seguridad.');
                  }
                  
                  case "cc_rejected_blacklist": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, su tarjeta se encuentra en restringida por la entidad bancaria.');
                  }

                  case "cc_rejected_card_disabled": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, su tarjeta se encuentra deshabilitada.');
                  }

                  case "cc_rejected_insufficient_amount": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, dinero insuficiente en la tarjeta.');
                  }

                  case "cc_rejected_max_attempts": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, limite de intentos excedido.');
                  }

                  case "cc_rejected_high_risk": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, transacción insegura.');
                  }
                  case "cc_rejected_duplicated_payment": {
                    $order->Pago = "";
                    $order->save();
                    return redirect('/es/checkout')->with('message', 'Pago rechazado, por seguridad rechazamos tu pago. Ya hiciste un pago por el mismo valor.');
                  }

                  default:
                    return redirect('/es/checkout')->with('message', 'Pago rechazado.');
                    break;
                }

            }else {
                return redirect('/es/inicio')->with('message', 'Su pago no ha podido efectuarse.');
            }

            // Eliminación de orden.
            // $order->delete();
        }

    }

    function updatePedidos($var) {
      $costoEnvio = Session::get('costoEnvio') ?? 0;

      if($var == 'pagoRealizado'){
          $pedido = new Pedido();

          $pedido->clienteID = $this->publicData->userId;
          $user = Users::where('id', $pedido->clienteID)->first();

          //dd(json_decode($this->publicOrder->data));
          
          $pedido->nombreCliente = $user->first_name . ' ' . $user->last_name;
          $pedido->productos = ($this->publicOrder->cart);
          $pedido->costoEnvio = $costoEnvio;
          $pedido->costoTotal = ($costoEnvio + $this->publicOrder->total);
          $pedido->estadoEnvio = 'Pendiente';
          $pedido->direccionEnvio = json_decode($this->publicOrder->data)->Calle . ' ' . json_decode($this->publicOrder->data)->Numero;
          
          // $pedido->save();

          // || Si y solo si el usuario quiere envio
          if(Session::get('envioAndreani') != null){

          // || Create the Andreani's Order
          $bultos = array();

          foreach(json_decode($pedido->productos) as $producto) {
            array_push($bultos, array(
              "kilos"=> 1.0,
              "volumenCm"=> 2500,
              "referencias"=> [
                [
                  "meta"=> "observaciones",
                  "contenido"=> $producto->content->title
                ],
              ]
            ));
          }


          $orderData = json_decode($this->publicOrder->data);
          $data = array(
            'contrato' => env('CONTRATO_ANDREANI'),
            'origen' => array(
              'postal' => array(
                "codigoPostal"=> env('CODIGO_POSTAL_DESPACHO'),
                "calle"=> env('CALLE_DESPACHO'),
                "numero"=> env('CALLE_NUMERO_DESPACHO'),
                "localidad"=> env('LOCALIDAD_DESPACHO'),
                "region"=> "",
                "pais"=> env('PAIS'),
                
              )
            ),
            'destino' => array(
              'postal' => array(
                "codigoPostal"=> Session::get('cPostal'),
                "calle"=> $orderData->Calle,
                "numero"=> $orderData->Numero,
                "localidad"=> $orderData->Localidad,
                "region"=> "",
                "pais"=> "Argentina",
                
              )
            ),
            'remitente' => array(
              "nombreCompleto"=> "Alberto Lopez",
              "email"=> "remitente@andreani.com",
              "documentoTipo"=> "DNI",
              "documentoNumero"=> "33111222",

              // Queda rellenar los datos del remitente
            ),
            'destinatario' => array(
              0=>array(
                  "nombreCompleto"=> $user->first_name . ' ' . $user->last_name,
                  "email"=> $user->email,
                  "documentoTipo"=> "DNI",
                  "documentoNumero"=> $orderData->Documento,
                  
              ),
            ),
            'bultos' => $bultos,
          );
          
          // || Obtención del Token
          $curl = curl_init('https://apisqa.andreani.com/login');
          curl_setopt($curl, CURLOPT_URL, 'https://apisqa.andreani.com/login');
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            'userName' => env('TEST_USER_ANDREANI'),
            'password' => env('TEST_PASS_ANDREANI'),
          ]));

          $response = curl_exec($curl);
          curl_close($curl);
          ///////////////////////////////////////////////////////////////////////////
          $token = json_decode($response)->token;
          $response = $this->call('https://apisqa.andreani.com/v2/ordenes-de-envio', json_decode(json_encode($data)), [], true, $token);
          // || Guardado de bultos, estado general y etiquetas por agrupador
          if(isset($response->estado)){
          $pedido->estado = $response->estado;
          $pedido->etiquetas = $response->etiquetasPorAgrupador;
          $pedido->bultos = json_encode($response->bultos);
          $pedido->save();
          }
          else {
            dd($response);
          }
        }
      }
    }

    function call($url = '', $params = [], $headers = [], $post = false, $authToken = '') {
      $lastUrl = $url;

      if($params != [] && !$post) {
          $lastUrl .= '?';
          foreach($params as $p) {
              $lastUrl .= $p . '&';
          }
      }
      
      $curl = curl_init($lastUrl);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      if ($params != [] && $post) {

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
      }

      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'x-authorization-token: ' . $authToken
      ));
      
      
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
