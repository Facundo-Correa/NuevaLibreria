@extends("pages::public.master")
@php
use App\carrito;use Illuminate\Routing\Route;
/*
$carrito = carrito::where('session_id', Session::getId())->first();
/*
if($carrito != null){
$carrito = $carrito;
}
else if (isset(Auth::user()->id)){
$carrito = carrito::where('UserId', Auth::user()->id)->first();
if($carrito != null){
$carrito = $carrito;
}
}
else {
// || Crear carrito por session_id
$carrito = new carrito();
$carrito->session_id = Session::getId();
//$carrito->Cart = [];
$carrito->save();

$carrito = $carrito;
}*

$productos = carrito::where('session_id', Session::getId())->orWhere('');


$totalPrice = 0;

// || Get total price
foreach($productos as $p){
$totalPrice += (int)($p->price);
}
*/
$totalPrice = 0;
$mpProds =[];
$productos = array();

if(Auth::user()){

    $productos = carrito::where('session_id', Session::getId())->orWhere('user_id', Auth::user()->id)->get();
 

    $isbns = array();
    foreach($productos as $prod){
        if(isset($prod)){
            array_push($isbns, $prod->book_isbn);
            $prods[$prod->book_isbn] = $prod;
        }
    }

    $books = Books::whereIn('isbn', $isbns)->get();

    foreach($books as $b) {
        $totalPrice += (int)($b->price);
        $mpProds[] = [
                    'price' => $b->price,
                    'titulo'=> $b->title,
                    'qtty' => $prods[$b->isbn]->cantidad

                    ];


    }

}

@endphp

<!doctype html>
<html class="no-js" lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nueva Libreria – Checkout</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/res_es/favicon/favicon.png">

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="/res_es/css/bootstrap.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="/res_es/css/animate.css">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="/res_es/css/meanmenu.min.css">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="/res_es/css/owl.carousel.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" href="/res_es/css/font-awesome.min.css">
    <!-- flexslider.css-->
    <link rel="stylesheet" href="/res_es/css/flexslider.css">
    <!-- chosen.min.css-->
    <link rel="stylesheet" href="/res_es/css/chosen.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="/res_es/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="/res_es/css/responsive.css">
    <link rel="stylesheet" href="/css/posible.css">
    <!-- modernizr css -->
    <script src="/res_es/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="checkout">


    <script src="/js/NotificationController.js"></script>

    <script>
        //console.log(document.cookie);
    </script>

    @php
    @endphp

    @if(!Auth::user())
        <script>
            location.href = '/es/iniciar-sesion';
        </script>

        @php
            dd('Redireccionando, aguarde un momento por favor . . .');
        @endphp
    @endif




    @include('pages::public.components.barra')
    <script>
        var message = '{!! Session::get('message'); !!}';
        if (message != null && message != "") {
            show(message);
        }
    </script>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    <!-- header-area-start -->

    @if($err = Session::get('error'))
    <script>
        var err = '{!! $err !!}';
        show(err);
    </script>
    @endif

    <!-- header-area-end -->
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="#">Nueva Libreria</a></li>
                            <li><a href="#" class="active">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- entry-header-area-start -->
    <div class="entry-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="entry-header-title">
                        <h2>Checkout</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @section('vue')

    @endsection

    <div class="checkout-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">


                    <!-- || El desastre hecho por mi || -->
                    <form id="payform" method="POST" action="/api/guardar-orden">
                        @csrf
                        @if(!isset(Auth::user()->id))

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-12">
                                <div class="checkbox-form">


                                    <a class="abrir-logueo" style="float: right; cursor:pointer; color: #009ee3; box-shadow: 0 0 .9px black; padding: 5px 10px;">Ya estoy registrado</a>

                                    <script>
                                        document.querySelector('.abrir-logueo').addEventListener('click', function() {
                                            document.querySelector('#logueo-modal').setAttribute('class', '');
                                            console.log('cambiado');
                                        });
                                    </script>

                                    <br />
                                    <br />
                                    <br />




                                    <h3>Complete con sus datos personales</h3>
                                    <div class="row">

                                        <div class="col-lg-12 col-md-6 col-12 ">
                                            <div class="checkout-form-list">
                                                <label>Email <span class="required">*</span></label>
                                                <input name="user" type="email" required placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Contraseña <span class="required">*</span></label>
                                                <input name="password" type="password" required placeholder="">
                                            </div>
                                        </div>

                                        <div class=" col-lg-12">
                                            <div class="country-select">
                                                <label>País <span class="required">*</span></label>
                                                <select name="pais" required>
                                                    <option value="Argentina">Argentina</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <div class="checkout-form-list">
                                                <label>Nombre <span class="required">*</span></label>
                                                <input required name="nombre" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Apellido <span class="required">*</span></label>
                                                <input required name="apellido" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="checkout-form-list">
                                                <label>Compañia</label>
                                                <input required name="company" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="checkout-form-list">
                                                <label>Calle<span class="required">*</span></label>
                                                <input required name="calle" type="text" placeholder="Ej: Belisaro">
                                            </div>
                                            <div class="checkout-form-list">
                                                <label>Numero<span class="required">*</span></label>
                                                <input required name="numero" type="text" placeholder="Ej: 333">
                                            </div>
                                            <div class="checkout-form-list">
                                                <label>Localidad<span class="required">*</span></label>
                                                <input required name="localidad" type="text" placeholder="Ej: Burzaco">
                                            </div>
                                        </div>




                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="checkout-form-list">
                                                <input required name="dpu" type="text" placeholder="Departamento, piso, unidad, etc. (opcional)">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="checkout-form-list">
                                                <label>Localidad / Ciudad <span class="required">*</span></label>
                                                <input required name="localidad" type="text" placeholder="Localidad / Ciudad">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Estado o Provincia <span class="required">*</span></label>
                                                <input required name="provincia" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Codigo postal / Zip <span class="required">*</span></label>
                                                <input required name="cPostal" type="text" placeholder="XXXX">
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Telefono<span class="required">*</span></label>
                                                <input required name="telefono" type="text" placeholder="011xxxxxxxx">
                                            </div>
                                        </div>

                                        <!-- || Card Zone || -->


                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <div class="checkout-form-list">
                                                <label>Titular de la tarjeta<span class="required">*</span></label>
                                                <input id="titularField" required name="titular" data-checkout="cardholderName" type="text" placeholder="Tal y como aparece en la tarjeta">
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-md-6 col-12 ">

                                        </div>

                                        <div class="col-lg-5 col-md-6 col-12 ">
                                            <div class="checkout-form-list">
                                                <label>Tipo de documento<span class="required">*</span></label>
                                                <select required name="paymethod" id="docType" name="docType" data-checkout="docType" type="text"><option value="DNI">DNI</option></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 ">
                                            <div class="checkout-form-list">
                                                <label>Documento del titular<span class="required">*</span></label>
                                                <input required data-checkout="docNumber" name="documento" type="text">
                                            </div>
                                        </div>



                                        <input type="hidden" id="paymentMethodId" name="paymethod" data-checkout="paymentMethodId">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Tarjeta de Credito / Debito <span class="required">*</span></label>
                                                <input id="cardNumber" data-checkout="cardNumber" type="text">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Codigo de seguridad <span class="required">*</span></label>
                                                <input data-checkout="securityCode" type="text">
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                                <label>Fecha de expiracion <span class="required">*</span></label>
                                                <div style="display: flex;">
                                                    <input style="margin-right: 10px;" id="cardExpirationMonth" data-checkout="cardExpirationMonth" placeholder="Mes" type="text">
                                                    <input id="cardExpirationYear" data-checkout="cardExpirationYear" placeholder="Año" type="text">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="checkout-form-list">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="different-address">

                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Nota (Opcional)</label>
                                                <textarea name="nOpcional" placeholder="" rows="10" cols="30" id="checkout-mess"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-12">
                                <div class="your-order">
                                    <h3>Productos</h3>
                                    <div class="your-order-table table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Producto</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($productos as $p)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{$p->content->title}} <strong class="product-quantity"> × {{$p->quantity}}</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount amount">${{$p->price}} Ars</span>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong><span class="amount">${{$totalPrice}} Ars</span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="payment-method">
                                        <div class="payment-accordion">
                                            <div class="collapses-group">

                                            </div>
                                        </div>



                                        <div class="order-button-payment">
                                            <input type="submit" style="background-color: #009ee3;" value="Pagar con Tarjeta de credito o debito">
                                        </div>
                                        <div class="mppay">

                                            @php
                                            \MercadoPago\SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
                                            $preference = new MercadoPago\Preference();

                                            // Crea un ítem en la preferencia

                                            $items = array();
                                            foreach($productos as $p){
                                            $item = new \MercadoPago\Item();
                                            $item->title = 'LIBRO';
                                            $item->quantity = $p->quantity;
                                            $item->unit_price = ((int)($p->price) / (int) ($p->quantity));
                                            array_push($items, $item);
                                            }
                                            $preference->items = $items;
                                            $preference->save();
                                            @endphp
                                            <script src="https://sdk.mercadopago.com/js/v2"></script>
                                            <script>
                                                const mp = new MercadoPago("{!! env('MERCADOPAGO_PUBLIC_KEY') !!}", {
                                                    locale: "es-AR"
                                                });


                                                mp.checkout({
                                                    preference: {
                                                        id: '{!! $preference->id !!}',
                                                    },
                                                    render: {
                                                        container: ".mppay", // Indica el nombre de la clase donde se mostrará el botón de pago
                                                        label: "Pagar con Mercado Pago", // Cambia el texto del botón de pago (opcional)
                                                    },
                                                });
                                            </script>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else
                            <div style="display: flex; flex-direction: row;">

                                <div style="width: 100%;">

                                    <div class="col-lg-12 col-md-6 col-12 ">
                                        <div class="checkout-form-list">
                                            <label>Titular de la tarjeta<span class="required">*</span></label>
                                            <input required name="titular" data-checkout="cardholderName" type="text" placeholder="Tal y como aparece en la tarjeta">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-12 ">
                                        <div class="checkout-form-list">
                                            <label>Tipo de documento<span class="required">*</span></label>
                                            <select required name="paymethod" id="docType" name="docType" data-checkout="docType" type="text"><option value="DNI">DNI</option></select>
                                        </div>
                                            <div class="checkout-form-list">
                                                <label>Documento del titular<span class="required">*</span></label>
                                                <input required data-checkout="docNumber" name="documento" type="text" placeholder="XX-XXX-XXX">
                                            </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="checkout-form-list">
                                            <label>Calle<span class="required">*</span></label>
                                            <input required name="calle" type="text" placeholder="Ej: Belisaro">
                                        </div>
                                        <div class="checkout-form-list">
                                            <label>Numero<span class="required">*</span></label>
                                            <input required name="numero" type="text" placeholder="Ej: 333">
                                        </div>
                                        <div class="checkout-form-list">
                                            <label>Localidad<span class="required">*</span></label>
                                            <input required name="localidad" type="text" placeholder="Ej: Burzaco">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="checkout-form-list">
                                            <label>Codigo postal / Zip <span class="required">*</span></label>
                                            <input required name="cPostal" id="cPostal" type="text" placeholder="Ej: 1101">
                                        </div>
                                    </div>




                                    <!--<input type="hidden" id="userId" name="userId" value="{{Auth::user()->id}}">-->
                                    <input type="hidden" id="paymentMethodId" name="paymethod" data-checkout="paymentMethodId">
                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="checkout-form-list">
                                            <label>Tarjeta de Credito / Debito <span class="required">*</span></label>
                                            <input id="cardNumber" data-checkout="cardNumber" type="text" placeholder="Ej: 4569 9135 6923 3004	">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="checkout-form-list">
                                            <label>Codigo de seguridad <span class="required">*</span></label>
                                            <input data-checkout="securityCode" type="text" placeholder="222">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="checkout-form-list">
                                            <label>Fecha de expiracion <span class="required">*</span></label>
                                            <div style="display: flex;">
                                                <input style="margin-right: 10px;" id="cardExpirationMonth" data-checkout="cardExpirationMonth" placeholder="Mes" placeholder="Ej: 03" type="text">
                                                <input id="cardExpirationYear" data-checkout="cardExpirationYear" placeholder="Año" type="text" placeholder="Ej: 21">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-12">
                                        <div class="checkout-form-list">
                                        </div>
                                    </div>

                                </div>





                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="your-order">
                                        <h3>Productos</h3>
                                        <div class="your-order-table table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Producto</th>
                                                        <th class="product-total">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($books as $p)
                                                    <tr class="cart_item">
                                                        <td class="product-name">
                                                            {{$p->title}} <strong class="product-quantity"> × {{$p->quantity}}</strong>
                                                        </td>
                                                        <td class="product-total">
                                                            <span class="amount">${{$p->price}} Ars</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        @php
                                                            $envio = 0;
                                                            $precioEnvio = 0; // Obtenerlo de alguna parte

                                                            if(isset($_COOKIE['EnvioCosto'])){
                                                                $precioEnvio = $_COOKIE['EnvioCosto'];
                                                            }
                                                            $tieneEnvio = false; // Detectar el check

                                                            if(isset($_COOKIE['EnvioEstado'])){
                                                                if($_COOKIE['EnvioEstado'] == '1') {
                                                                    $tieneEnvio = true;
                                                                    //$totalPrice+=$precioEnvio;
                                                                }
                                                                //dd($_COOKIE['EnvioEstado']);

                                                            }
                                                            else {
                                                            }
                                                        @endphp
                                                        <td><strong><span class="amountotal">${{$totalPrice}} Ars</span></strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="payment-method">
                                            <div class="payment-accordion">
                                                <div class="collapses-group">

                                                </div>
                                            </div>

                                            <label style="margin-bottom: 2rem;"> Los pagos realizados por transferencia o Mercado Pago, precisan 24hs de espera para el retiro.</label>

                                            <div class="form-check">
                                                @if($tieneEnvio)
                                                    <input class="form-check-input" type="checkbox" value="1" name="envioAndreani" id="recibirDomicilio" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox" value="0" name="envioAndreani" id="recibirDomicilio">
                                                @endif

                                                <label class="form-check-label" for="flexCheckDefault">
                                                  Quiero recibirlo en mi domicilio (envío ${{$precioEnvio}} Ars)
                                                </label>
                                              </div>

                                            <div class="order-button-payment">
                                                <input type="button" value="Calcular envio" id="calcularEnvio">
                                                <input type="submit" style="background-color: #009ee3;" value="Pagar con Tarjeta de credito o debito">
                                            </div>
                                            <div class="mppay">

                                                @php
                                                    // || var_dump($_COOKIE['EnvioEstado']);
                                                    \MercadoPago\SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
                                                    $preference = new MercadoPago\Preference();
                                                    if($tieneEnvio) {
                                                        $envio = $precioEnvio / count($productos);
                                                    }

                                                    // Crea un ítem en la preferencia

                                                    $items = array();

                                                    foreach($mpProds as $p){

                                                        $item = new \MercadoPago\Item();
                                                        $item->title = $p['titulo'];
                                                        $item->quantity = $p['qtty'];
                                                        //$item->unit_price = (((int)($p->precio) / (int) ($p->quantity)) + $envio);
                                                        array_push($items, $item);
                                                    }
                                                    //dd($items);
                                                    $preference->items = $items;
                                                    $preference->save();
                                                @endphp
                                                <script src="https://sdk.mercadopago.com/js/v2"></script>
                                                <script>
                                                    const mp = new MercadoPago("{!! env('MERCADOPAGO_PUBLIC_KEY') !!}", {
                                                        locale: "es-AR"
                                                    });


                                                    mp.checkout({
                                                        preference: {
                                                            id: '{!! $preference->id !!}',
                                                        },
                                                        render: {
                                                            container: ".mppay", // Indica el nombre de la clase donde se mostrará el botón de pago
                                                            label: "Pagar con Mercado Pago", // Cambia el texto del botón de pago (opcional)
                                                        },
                                                    });
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            @endif





                            <input type="hidden" name="total" value='{{$totalPrice}}'>

                    </form>

                    <!-- || Modal prefabricado de mercado pago, lo gestionan ellos || -->
                    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
                    <script>
                        window.Mercadopago.setPublishableKey("{!! env('MERCADOPAGO_PUBLIC_KEY') !!}");
                        //window.Mercadopago.getIdentificationTypes();

                        // -- OBTENCION DE BANCO -- //

                        document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod);

                        function guessPaymentMethod(event) {
                            let cardnumber = document.getElementById("cardNumber").value;
                            if (cardnumber.length >= 6) {
                                let bin = cardnumber.substring(0, 6);
                                window.Mercadopago.getPaymentMethod({
                                    "bin": bin
                                }, setPaymentMethod);
                            }
                        };

                        function setPaymentMethod(status, response) {
                            console.log(response);
                            if (status == 200) {
                                let paymentMethod = response[0];
                                document.getElementById('paymentMethodId').value = paymentMethod.id;
                                //getIssuers(paymentMethod.id);
                            } else {}
                        }

                        /////////////////////////////////////////////////////////////////////////////////

                        doSubmit = false;
                        document.getElementById('payform').addEventListener('submit', getCardToken);

                        function getCardToken(event) {
                            event.preventDefault();
                            if (!doSubmit) {
                                let $form = document.getElementById('payform');
                                window.Mercadopago.createToken($form, setCardTokenAndPay);
                                return false;
                            }
                        };

                        function setCardTokenAndPay(status, response) {
                            if (status == 200 || status == 201) {
                                let form = document.getElementById('payform');
                                let card = document.createElement('input');
                                card.setAttribute('name', 'token');
                                card.setAttribute('type', 'hidden');
                                card.setAttribute('value', response.id);
                                form.appendChild(card);
                                doSubmit = true;
                                form.submit();
                            } else {
                                //alert("Verify filled data!\n"+JSON.stringify(response, null, 4));
                                // || Show notificacion
                                show(`Compruebe que todos los campos hayan sido llenados y que los datos sean correctos.`);
                            }
                        };
                    </script>

                </div>
            </div>
        </div>
    </div>



    <div id="logueo-modal" class="desactivado">

        <div id="cuerpo-login-modal">
            <div id="formulario-contenedor">
                <div class="close-modal-login">
                    <a class="close-modal-login-a" >&times;</a>
                    <script>
                        document.querySelector('.close-modal-login-a').addEventListener('click', function(){
                            document.querySelector('#logueo-modal').setAttribute('class', 'desactivado');
                        });


                    </script>
                </div>
                <form class="formulario-modal" method="POST" action="/es/verificar-credenciales-manual">
                    @csrf
                    <h2>Iniciar sesion</h2>

                    <div class="form-group">
                        <label for="email-modal">Dirección de correo</label>
                        <input style="text-align: center;" type="email" name="email" class="form-control" id="email-modal" aria-describedby="emailHelp" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="password-modal">Contraseña</label>
                        <input style="text-align: center;" type="password" name="password" class="form-control" id="password" placeholder="**********">
                    </div>

                    <input type="hidden" name="redirect" value="/es/checkout">

                    <br />
                    <button type="submit" id="ingresar-modal">Ingresar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- checkout-area-end -->
    <!-- footer-area-start -->
    @include('pages::public.components.footer')
    <!-- footer-area-end -->


    <!-- all js here -->
    <!-- jquery latest version -->
    <script src="/res_es/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- popper j/res_es/s -->
    <script src="/res_es/js/popper.min.js"></script>
    <!-- bootstra/res_es/p js -->
    <script src="/res_es/js/bootstrap.min.js"></script>
    <!-- owl.caro/res_es/usel js -->
    <script src="/res_es/js/owl.carousel.min.js"></script>
    <!-- meanmenu/res_es/ js -->
    <script src="/res_es/js/jquery.meanmenu.js"></script>
    <!-- wow js -/res_es/->
        <script src="/res_es/js/wow.min.js"></script>
	    jquery.p/res_es/arallax-1.1.3.js -->
    <script src="/res_es/js/jquery.parallax-1.1.3.js"></script>
    <!-- jquery.c/res_es/ountdown.min.js -->
    <script src="/res_es/js/jquery.countdown.min.js"></script>
    <!-- jquery.f/res_es/lexslider.js -->
    <script src="/res_es/js/jquery.flexslider.js"></script>
    <!-- chosen.j/res_es/query.min.js -->
    <script src="/res_es/js/chosen.jquery.min.js"></script>
    <!-- jquery.c/res_es/ounterup.min.js -->
    <script src="/res_es/js/jquery.counterup.min.js"></script>
    <!-- waypoint/res_es/s.min.js -->
    <script src="/res_es/js/waypoints.min.js"></script>
    <!-- plugins /res_es/js -->
    <script src="/res_es/js/plugins.js"></script>
    <!-- main js /res_es/-->
    <script src="/res_es/js/main.js"></script>

    <script>
        var envioState = -1;
        $('#recibirDomicilio').on('click', ()=> {
            envioState = getCookie("EnvioEstado")*-1;
            console.log(envioState);

            if(isNaN(envioState)){
                envioState = 1;
            }

            document.cookie="EnvioEstado="+envioState;
            window.location.reload();

            function getCookie(name) {
                return (document.cookie.match('(^|;) *'+name+'=([^;]*)')||[])[2];
            }
        });



        $('#calcularEnvio').on('click', () => {
            calcularEnvio();
        });

        function calcularEnvio() {
            var cp = $('#cPostal')[0].value;
            var contrato = `{!! (env('CONTRATO_ANDREANI')) !!}`;
            var cliente = `{!! (env('CLIENTE_ANDREANI')) !!}`;
            var sucursalOrigen = `{!! (env('SUCURSAL_ORIGEN_ANDREANI')) !!}`;
            var valorDeclarado = '2500';
            //loginAndreani('https://apisqa.andreani.com/login', 'usuario_test', 'DI$iKqMClEtM');

            axios.get(`https://apisqa.andreani.com/v1/tarifas?cpDestino=${cp}&contrato=${contrato}&cliente=${cliente}&sucursalOrigen=${sucursalOrigen}&bultos[0][valorDeclarado]=${valorDeclarado}`, {}).then((response)=>{
                //console.log(response);

                // Escritura en cookies del costo de envio
                document.cookie=`EnvioCosto=${response.data.tarifaConIva.total}`;
                window.location.reload();
            });
        }

        function loginAndreani(url, user, pass) {
            axios.post(url, {
                userName: user,
                password: pass
            }).then((response)=> {
                var token = response.data.token;
                var refreshToken = response.data.refreshToken;
                console.log(response);
            });
        }


    </script>
</body>

</html>
