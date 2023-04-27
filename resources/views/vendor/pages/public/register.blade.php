@php
    $tmpc = App\Pais::all() ?? 'Sin paises cargados';
    $countries = [];

    foreach($tmpc as $c){
        array_push($countries, $c->name);
    }
@endphp

<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Nueva Libreria – Registro</title>
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

<body class="register">
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<!-- Add your site or application content here -->
	<!-- header-area-start -->
	@include('pages::public.components.barra')

	<!-- header-area-end -->
	<!-- breadcrumbs-area-start -->
	<div class="breadcrumbs-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs-menu">
						<ul>
							<li><a href="#">Nueva Libreria</a></li>
							<li><a href="#" class="active">registro</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- breadcrumbs-area-end -->
	<!-- user-login-area-start -->
	<div class="user-login-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="login-title text-center mb-30">
						<h2 >Registrarse</h2>
						<p>Para poder registrarte es preciso que completes el siguiente formulario.</p>
					</div>
				</div>
				<div class="offset-lg-2 col-lg-8 col-md-12 col-12">
						
						@if(Session::get('message'))
							<label style="color: red;">{{Session::get('message')}}</label>
						@endif

						<form id="#000B" class="login-form" action="/es/register" method="POST">
							@csrf
							<div class="single-login">
								<label>Nombre</label>
								<input name="first_name" type="text" required />
							</div>
							<div class="single-login">
								<label>Apellido</label>
								<input name="last_name" type="text" required />
							</div>
							<div class="single-login">
								<label>Documento / DNI</label>
								<input name="document" type="text" required />
							</div>
							<div class="single-login">
								<label>Email</label>
								<input name="email" type="email" required />
							</div>

							<div class="single-login">
								<label>Contraseña </label>
								<input name="password" type="password" required/>
							</div>

							<div class="single-login">
								<label>Telefono</label>
								<input name="telefono" type="text" required/>
							</div>

							<div class="single-login">
								<label>País </label>
								<select name="pais" style="padding: 12px 10px; width: 100%; border: 1px solid #eceff8;">
									
									@foreach($countries as $c)
										<option>{{$c}}</option>
									@endforeach
								</select>
							</div>

							<div class="single-login">
								<label>Ciudad</label>
								<input name="ciudad" type="text" required/>
							</div>

							<div class="single-login">
								<label>Localidad</label>
								<input name="localidad" type="text" required/>
							</div>

							<div class="single-login">
								<label>Calle</label>
								<input name="calle" type="text" required/>
							</div>

							<div class="single-login">
								<label>Numero de calle</label>
								<input name="nCalle" type="text" required/>
							</div>

							<div class="single-login">
								<label>Codigo postal</label>
								<input name="cPostal" type="text" required/>
							</div>

							<div class="single-login single-login-2" style="display: flex; justify-content: center; align-items: center;">
								<input class="reg" style="border:none; width: 100%; height: 100%;" type="submit" value="Registrarse" />
							</div>
							
						</form>
				</div>
			</div>
		</div>
	</div>
	<!-- user-login-area-end -->
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
</body>

</html>