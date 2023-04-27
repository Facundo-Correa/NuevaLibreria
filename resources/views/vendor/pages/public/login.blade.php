<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Nueva Libreria – Iniciar sesion</title>
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
		<!-- modernizr css -->
        <script src="/res_es/js/vendor/modernizr-2.8.3.min.js"></script>
		<link rel="stylesheet" href="/css/posible.css">

    </head>
    <body class="login">
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
								<li><a href="/es/">Nueva Libreria</a></li>
								<li><a class="active" style="color: #7551c2;">Inicio de sesion</a></li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- user-login-area-start -->
		<div class="user-login-area mb-70">

			@auth
				<script>
					window.location = '/';
				</script>
			@endauth

			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="login-title text-center mb-30">
							<h2>Inicio de sesion</h2>
							<p>Ingrese sus datos para continuar</p>
						</div>
					</div>
					<div class="offset-lg-3 col-lg-6 col-md-12 col-12">

						@if(Session::get('message'))
						<label style="color: red;">{{Session::get('message')}}</label>
						@endif

						<form id="#000A" class="login-form" action="/es/verificar-credenciales" method="POST">
							@csrf
							<div class="single-login" style="display: block !important;">
								<label>Email</label>
								<input name="email" type="text" />
							</div>

							@if(isset($checkout))
								<div class="single-login">
									<input name="checkout" value="true" type="hidden" />
								</div>
							@endif

							<div class="single-login" style="display: block !important;">
								<label>Contraseña </label>
								<input name="password" type="password" />
							</div>

							<div class="single-login single-login-2">
							
								<input class="ingresar" style="border:none; width: 30%; height: 100%;" type="submit" value="Ingresar" />
							
							</div>
							<a href="#" class="perdiste-contraseña" style="color: #7551c2;">¿Perdiste la contraseña?</a>
						</form>

						<!--<form action="/es/verificar-credenciales" method="POST">
							@csrf
							<div class="single-login">
								<label>Email</label>
								<input name="email" type="text" />
							</div>
							<input class="single-login" name="password" type="password">
							<input type="submit" value="Iniciar Sesion">
						</form>-->
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
		<!-- popper js -->
        <script src="/res_es/js/popper.min.js"></script>
		<!-- bootstrap js -->
        <script src="/res_es/js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
        <script src="/res_es/js/owl.carousel.min.js"></script>
		<!-- meanmenu js -->
        <script src="/res_es/js/jquery.meanmenu.js"></script>
		<!-- wow js -->
        <script src="/res_es/js/wow.min.js"></script>
		<!-- jquery.parallax-1.1.3.js -->
        <script src="/res_es/js/jquery.parallax-1.1.3.js"></script>
		<!-- jquery.countdown.min.js -->
        <script src="/res_es/js/jquery.countdown.min.js"></script>
		<!-- jquery.flexslider.js -->
        <script src="/res_es/js/jquery.flexslider.js"></script>
		<!-- chosen.jquery.min.js -->
        <script src="/res_es/js/chosen.jquery.min.js"></script>
		<!-- jquery.counterup.min.js -->
        <script src="/res_es/js/jquery.counterup.min.js"></script>
		<!-- waypoints.min.js -->
        <script src="/res_es/js/waypoints.min.js"></script>
		<!-- plugins js -->
        <script src="/res_es/js/plugins.js"></script>
		<!-- main js -->
        <script src="/res_es/js/main.js"></script>
    
	</body>
</html>
