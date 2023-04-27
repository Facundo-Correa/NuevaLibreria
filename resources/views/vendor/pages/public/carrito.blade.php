@if($user)

@php

    $preProductos = \App\carrito::where('session_id', Session::getId())->orWhere('user_id', Auth::user()->id)->get();
    /*foreach($userCart as $book) {
        $b = Books::where('isbn', $book)->first();
        array_push($productos, array(
            'barcode' => $b->content->barcode,
            'title' => $b->content->title,
            'quantity' => $b->quantity,
            'price' => getPrice($b->content->isbn, $b->quantity, $b->content->price),
        ));

    }*/
        /*
        $totalPrice = 0;
        foreach($productos as $p){
            $totalPrice += (int)($p['price']);
        }*/


    $productos = array();
    $isbnProds = array();
    $isbns = array();
    foreach($preProductos as $p){
        if(isset($p)){
            array_push($isbns, $p->book_isbn);
            $isbnProds[$p->book_isbn] = $p;
        }
    }
    $prods = Books::whereIn('isbn', $isbns)->get();
    $totalPrice = 0;


    foreach($prods as $p){
        $totalPrice += (int)($p['price']);

        array_push($productos, [
            'barcode' => $p['isbn'],
            'isbn' => $p['isbn'],
            'isbn1' => $p['isbn1'],
            'title' => $p['title'],
            'quantity' => $isbnProds[$p['isbn']]->cantidad,
            'price' => $p['price'],
        ]);

    }

@endphp

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Nueva Libreria – Mi carrito</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


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
    <body class="cart">
        @include('pages::public.components.barra')
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Nueva Libreria</a></li>
								<li><a href="#" class="active">Mi carrito</a></li>
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
							<h2>Mi carrito</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- cart-main-area-start -->
		<div class="cart-main-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<form action="#">
							<div class="table-content table-responsive mb-15 border-1">
								<table>
									<thead>
										<tr>
											<th class="product-thumbnail">Tapa</th>
											<th class="product-name">Libro</th>
											<th class="product-price">Precio</th>
											<th class="product-quantity">Cantidad</th>
											<th class="product-subtotal">Total</th>
											<th class="product-remove">Descartar</th>
										</tr>
									</thead>
									<tbody>
										@foreach($productos as $p)
                                            @php
                                            @endphp
										<tr>
											<td class="product-thumbnail"><a href="#"><img src="/img/covers/{{$p['isbn1']}}.jpg" alt="Imagen no disponible" /></a></td>
											<td class="product-name"><a href="#">{{$p['title']}}</a></td>
											<td class="product-price"><span class="amount">${{$p['price']}}</span></td>
											<td class="product-quantity"><input type="number" onchange="actualizar_cantidad({{json_encode($p['isbn1'])}}, {{json_encode($p['isbn'])}})" id="{{$p['isbn1']}}" value="{{$p['quantity']}}"></td>
											<td class="product-subtotal">${{(int)($p['price'] * $p['quantity'])}}</td>
											<td class="product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
                    <div class="col-lg-8 col-md-6 col-12">
                        <div class="buttons-cart mb-30">
                            <ul>
                                <li><a style="cursor: pointer;" class="actualizar-carrito">Actualizar carrito</a></li>
                                <li><a href="/es/tienda">Seguir comprando</a></li>

								<script>
									document.querySelector('.actualizar-carrito').addEventListener('click', function() {
										location.reload();
									});
								</script>
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="cart_totals" style="">
                            <h2>Precio final</h2>
                            <table>
                                <tbody >

                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>
                                            <span class="amount">${{$totalPrice}}</span>
                                        </td>
									</tr>

                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <strong>
                                                <span class="amount">${{$totalPrice}}</span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="wc-proceed-to-checkout">
                                <a href="/es/checkout">Proceder a pagar</a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>

		@include('pages::public.components.footer')

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
		<!-- jquery.p/res_es/arallax-1.1.3.js -->
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
            function actualizar_cantidad(arg, arg1) {
                console.log(arg, arg1);
                axios.post('/api/modificar-cantidad', {cantidad:document.getElementById(arg).value, isbn:arg1}, ).then((response) => {
                });
            }

            function eliminar() {

            }
        </script>
    </body>
</html>
@endif
