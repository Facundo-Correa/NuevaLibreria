

@php
    $config = Configuraciones::all()->first();


@endphp




<!doctype html>
<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nueva Libreria</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/res_es/favicon/favicon.png">
    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- animate css -->
    <link rel="stylesheet" href="/css/animate.css">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="/css/meanmenu.min.css">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- flexslider.css-->
    <link rel="stylesheet" href="/css/flexslider.css">
    <!-- chosen.min.css-->
    <link rel="stylesheet" href="/css/chosen.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- modernizr css -->
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>

    <link rel="stylesheet" href="/css/posible.css">
</head>

<body>
<style>
    .principal>.owl-stage-outer {
        height: 450px;
    }
</style>


    @include('pages::public.components.barra')
    <!-- header-area-start -->
    <script src="/js/NotificationController.js"></script>
    <!-- || Messages detector || -->
    <script>
        var message = '{!! Session::get('message') !!}';
        if(message != "" && message != null){
            show(message);

        }

    </script>
@php
//var_dump(Session::get('message'));
@endphp

    @if(Session::get('action'))
        <script>
            var action = '{!! Session::get("action") !!}';
            switch (action) {
                case 'send_pay_status_OK': {

                    // || Productos
                    let importe = 0;
                    let productos = [];

                    var produc = {!! Session::get("productos") !!};
                    produc.map(function(m) {
                        var str = `${m.content.title} x ${m.quantity}: $${m.price}`;
                        importe+=m.price;
                        productos.push(str);
                    });

                    axios.post('/avisar-pago', {
                        importe: importe,
                        productos: productos
                    }).then(function(response){

                    });
                    break;
                }


                default: {
                    break
                }
            }
        </script>
    @endif

    <!--|| -- ------------------------------------------------------------------------------- -- ||-->

    <div class="slider-area" ;>

        @php
        // || Busqueda del carrusel correspondiente a la posicion
        $carrusel_header = Carrusels::select('*')->where([
        ['seccion', '=', '0'],
        ['posicion', '=', '0'],
        ])->get()->first();

        if($carrusel_header){

        $textos = json_decode($carrusel_header->textos, true);
        }
        @endphp

        @if($carrusel_header && $carrusel_header->status == "1")

        <div class="slider-active owl-carousel principal">
            @if(count($carrusel_header->files)>0)
            <div class="single-slider pt-125 pb-130 bg-img" style="background-image:url(/storage/{{$carrusel_header->files[0]->path}}); min-height: 450px; max-height: 450px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" style="min-height: 700px; max-height: 700px;">
                            <div class="slider-content slider-animated-1 text-center" >

                                @php
                                function hexInvert(string $color):string {
                                $color = trim($color);
                                $prependHash = false;
                                if (strpos($color, '#') !== false) {
                                $prependHash = true;
                                $color = str_replace('#', '', $color);
                                }
                                $len = strlen($color);
                                if($len==3 || $len==6){
                                if($len==3) $color = preg_replace('/(.)(.)(.)/', "\\1\\1\\2\\2\\3\\3", $color);
                                } else {
                                throw new \Exception("Invalid hex length ($len). Length must be 3 or 6 characters");
                                }
                                if (!preg_match('/^[a-f0-9]{6}$/i', $color)) {
                                throw new \Exception(sprintf('Invalid hex string #%s', htmlspecialchars($color, ENT_QUOTES)));
                                }

                                $r = dechex(255 - hexdec(substr($color, 0, 2)));
                                $r = (strlen($r) > 1) ? $r : '0' . $r;
                                $g = dechex(255 - hexdec(substr($color, 2, 2)));
                                $g = (strlen($g) > 1) ? $g : '0' . $g;
                                $b = dechex(255 - hexdec(substr($color, 4, 2)));
                                $b = (strlen($b) > 1) ? $b : '0' . $b;

                                return ($prependHash ? '#' : '') . $r . $g . $b;
                                }

                                $inverted_color_1 = '';
                                $inverted_color_3 = '';
                                $inverted_color_5 = '';

                                if(count($textos[0]) >=1){
                                    $inverted_color_1 = hexInvert($textos[0][1]);
                                }
                                if(count($textos[0]) >=3){
                                    $inverted_color_2 = hexInvert($textos[0][3]);
                                }
                                if(count($textos[0]) >=5){
                                    $inverted_color_3 = hexInvert($textos[0][5]);

                                }
                                @endphp

                                @if($inverted_color_1 != '' && count($textos[0]) >=1)
                                    <h1 style="color:{{$textos[0][1]}}; text-shadow:1.5px 1.5px 1px {{$inverted_color_1}};">{{$textos[0][0]}}</h1>
                                @endif
                                @if($inverted_color_2 != '' && count($textos[0]) >=3)
                                    <h2 style="color:{{$textos[0][3]}}; text-shadow:1.5px 1.5px 1px {{$inverted_color_2}};">{{$textos[0][2]}}</h2>
                                @endif
                                @if($inverted_color_3 != '' && count($textos[0]) >=5)
                                    <h3 style="color:{{$textos[0][5]}}; text-shadow:1.5px 1.5px 1px {{$inverted_color_3}};">{{$textos[0][4]}}</h3>
                                @endif
                                {{--@if(count($textos[0]) >=6)
                                    <a href={{$textos[0][6]}}>Mas informacion</a>
                                @endif--}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @for($i = 1; $i<count($carrusel_header->files); $i++)
                <div class="single-slider pt-125 pb-130 bg-img" style="background-image:url(/storage/{{$carrusel_header->files[$i]->path}}); min-height: 450px; max-height: 450px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12" style="min-height: 700px; max-height: 700px;">
                                <div class="slider-content slider-animated-1 text-center">

                                    @php
                                    $tt0 = 'false';
                                    $tt1 = 'false';
                                    $tt2 = 'false';


                                    if(count($textos[$i]) >=1){
                                        $inverted_color_1 = hexInvert($textos[$i][1]);
                                        $tt0 = 'true';
                                    }
                                    if(count($textos[$i]) >=3){
                                        $inverted_color_2 = hexInvert($textos[$i][3]);
                                        $tt1 = 'true';
                                    }
                                    if(count($textos[$i]) >=5){
                                        $inverted_color_3 = hexInvert($textos[$i][5]);
                                        $tt2 = 'true';
                                    }


                                    @endphp

                                    @if($tt0 == 'true' && count($textos[$i]) >=0)
                                    <h1 style="color: {{$textos[$i][1]}}; text-shadow: 1.5px 1.5px 1px {{$inverted_color_1}};">{{$textos[$i][0]}}</h1>
                                    @endif
                                    @if($tt1 == 'true' && count($textos[$i]) >=3)
                                        <h2 style="color: {{$textos[$i][3]}}; text-shadow: 1.5px 1.5px 1px {{$inverted_color_2}};">{{$textos[$i][2]}}</h2>
                                    @endif
                                    @if($tt2 == 'true'  && count($textos[$i]) >=5)
                                        <h3 style="color: {{$textos[$i][5]}}; text-shadow: 1.5px 1.5px 1px {{$inverted_color_3}};">{{$textos[$i][4]}}</h3>
                                    @endif
                                    {{--@if(count($textos[$i])>=6)
                                        <a href={{$textos[$i][6]}}>Mas informacion</a>
                                    @endif--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

        </div>
    </div>

    @endif


    </div>
    <!-- slider-area-end -->
    <!-- product-area-start -->
    <div class="product-area pt-95 xs-mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2>Promociones</h2>
                        @if(isset($config))
                        <p>{{$config->frase_promociones_1}} <br/> {{$config->frase_promociones_2}}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <!-- tab-menu-start -->
                    <div class="tab-menu mb-40 text-center">
                        <ul class="nav justify-content-center">

                            @foreach(Promocions::all() as $promo)
                            @if(($promo->status == "1" || $promo->status == 1) && $promo->seccion == "0" && $promo->posicion == "0")
                            <li><a href="#{{$promo->name}}" data-toggle="tab">{{$promo->title}}</a></li>
                            @else
                                @php
                                    //dd($promo->status == 1);
                                @endphp
                            @endif
                            @endforeach

                        </ul>
                    </div>


                    <!-- tab-menu-end -->
                </div>
            </div>
            <!-- tab-area-start -->
            <div class="tab-content">

                @php

                $promociones = Promocions::select('*')
                ->where('posicion', '0')
                //->where('status', '{"en":"0","es":"1"}')
                //->orWhere('status', '{"en":"0","es":1}')
                //->orWhere('status', 1)
                ->orderBy('id', 'asc')->get();

                $promocion_0 = '';

                if(count($promociones)>=1){
                    $promocion_0 = $promociones[0];
                    //  unset($promociones[0]);
                }
                @endphp

                <!-- || Promocion 0 || -->
                @if($promocion_0 && $promocion_0->status == 1 || $promocion_0->status == '{"en":"0","es":1}' || $promocion_0->status == '{"en":"0","es":"1"}')
                <div class="tab-pane promo fade show active" id="{{$promocion_0->name}}">
                    <div class="tab-active owl-carousel">

                        @php
                        $num = 0;
                        @endphp

                        @foreach(explode(',', $promocion_0->books_isbns) as $book)
                        @php
                        $actualBook = Books::where('isbn', $book)->first();
                        @endphp

                        @if($actualBook)
                        <!-- single-product-start -->
                        <div class="product-wrapper">
                            <div class="product-img">

                                <a href="/es/libro/{{$actualBook->isbn}}">
                                    <img alt="book" class="primary imagen-libro" src="/img/covers/{{$actualBook->isbn1}}.jpg" />

                                </a>
                                <div class="quick-view">
                                    <a class="action-view" onclick="openProductModal('{{$actualBook->isbn}}')" data-target="#productModal" data-toggle="modal" title="Quick View">
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </div>
                                <div class="product-flag">
                                    <ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details detalles-producto text-center">


                                <span class="edition" hidden id="{{$actualBook->isbn}}"></span>
                                @if(!empty($actualBook))
                                    <h4><a href="/es/libro/{{$actualBook->isbn}}">{{$actualBook->isbn}} {{$actualBook->title}}</a></h4>
                                @endif

                                @if($actualBook)
                                <div class="product-price">
                                    <ul>
                                        @if(!empty($actualBook))
                                            {{--@if(isset(explode(',', $promocion_0->books_desc)[$num]))
                                                    @if($desc = explode(',', $promocion_0->books_desc)[$num])
                                                        <li class="producto-precio">${{ (int)($actualBook->price) - ( ( (int)($desc) * (int)($actualBook->price) ) /100) }}</li>
                                                    @endif
                                                @endif--}}


                                                <li class="producto-precio">${{$actualBook->price}}</li>
                                        @endif

                                    </ul>
                                </div>
                                    @endif
                            </div>
                            <div class="product-link">


                                <div class="product-button">
                                    <a onclick="sendToCart('{{$actualBook->isbn}}')" style="cursor: pointer;" title="Add to cart" class="product-button-a" id="promo_{{$actualBook->isbn1}}"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        @if(!empty($actualBook))
                                            <li><a  href="/es/libro/{{$actualBook->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-end -->
                        @endif

                            @if($actualBook)
                                @php
                                    $num++;
                                @endphp
                            @endif

                        @endforeach

                    </div>
                </div>
                @endif

                @foreach($promociones as $promo)
                @php
                if($promo->status != 1 && $promo->status != '{"en":"0","es":1}' && $promo->status != '{"en":"0","es":"1"}') {
                    continue;
                }
                @endphp

                <div class="tab-pane promo fade" id="{{$promo->name}}">

                    <div class="tab-active owl-carousel">


                        @php
                        $num = 0;
                        @endphp


                        @foreach(explode(',', $promo->books_isbns) as $book)

                        @php
                        $actualBook = Books::where('isbn', $book)->first();

                        @endphp


                        <!-- single-product-start -->
                        @if(!empty($actualBook))
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="/es/libro/{{$actualBook->isbn}}">
                                    <img alt="book" class="primary imagen-libro" src="/img/covers/{{$actualBook->isbn1}}.jpg" />

                                </a>
                                <div class="quick-view">
                                    <a class="action-view" style="cursor: pointer;" onclick="openProductModal('{{$actualBook->isbn}}')" data-target="#productModal" data-toggle="modal" title="Quick View">
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </div>
                                <div class="product-flag">
                                    <ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details detalles-producto text-center">
                                <span class="edition" hidden id="{{$actualBook->isbn}}"></span>
                                <h4><a href="/es/libro/{{$actualBook->isbn}}">{{$actualBook->isbn}} {{$actualBook->title}}</a></h4>

                                <div class="product-price">
                                    <ul>
                                        @if(!empty($actualBook))
                                            @php
                                                $exp = explode(',', $promo->books_desc);
                                            @endphp
                                            @if(count($exp)>=$num)
                                                @php
                                                    //$desc = $exp[$num];
                                                @endphp
                                                {{--<li class="producto-precio">${{ (int)($actualBook->price) - ( ( (int)($desc) * (int)($actualBook->price) ) /100) }}</li>--}}
                                                <li class="producto-precio">${{ (int)($actualBook->price) }}</li>

                                            @else
                                                <li class="producto-precio">Error</li>


                                                @endif

                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div class="product-link">
                                <div class="product-button">
                                    <a onclick="sendToCart('{{$actualBook->isbn}}')" style="cursor: pointer;" class="product-button-a" title="Add to cart"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        @if(!empty($actualBook))
                                        <li><a href="/es/libro/{{$actualBook->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- single-product-end -->
                        @php
                        $num++;
                        @endphp
                        @endforeach

                    </div>
                </div>
                @endforeach



            </div>
            <!-- tab-area-end -->
        </div>
    </div>
    <!-- product-area-end -->
    <!-- banner-area-start -->
    <div class="banner-area-5 mtb-95">
        <!--
                Publicidades donde tipo 1 (publicidad), posicion 1 (principal), status 1 (activado), pagina: Pagina Principal (home)
        -->
        @php
        $publicidad_principal = Publicidades::select('*')->where([
        ['tipo', '=', '1'],
        ['posicion', '=', '1'],
        ['status', '=', '{"en":"0","es":"1"}'],
        ['pagina', '=', 'home'],
        ])
        ->orWhere([
        ['tipo', '=', '1'],
        ['posicion', '=', '1'],
        ['status', '=', '{"en":"0","es":1}'],
        ['pagina', '=', 'home'],
        ])
        ->first();
        // || dd($publicidad_principal->files);


        @endphp

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-img-2">

                        @if($publicidad_principal != null   )
                        @if(count($publicidad_principal->files) >=1)

                            @if($publicidad_principal->link)
                                <a href="{{$publicidad_principal->link}}"><img src="/storage/{{$publicidad_principal->files[0]->path}}" alt="banner" style="max-width: 1110px; max-height: 135px; object-fit:cover;" alt="banner" /></a>
                            @endif




                            @if(!$publicidad_principal->link)
                                <a href="#"><img src="/storage/{{$publicidad_principal->files[0]->path}}" alt="banner" style="max-width: 1110px; max-height: 135px; object-fit:cover;" alt="banner" /></a>
                            @endif



                        @if(!$publicidad_principal->link)
                        <a href="#"><img src="" alt="banner" style="max-width: 1110px; max-height: 135px; object-fit:cover;" alt="banner" /></a>
                        @endif



                        <div class="banner-text">
                            <h3 style="color:{{$publicidad_principal->color_1}};">{{$publicidad_principal->texto_1}}</h3>
                            <h2 style="color:{{$publicidad_principal->color_2}};">{{$publicidad_principal->texto_2}}</h2>
                        </div>

                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

                @php
                    $otrasP = Promocions::select('*')
                    //->where('posicion', '1')
                    ->where('status', '{"en":"0","es":"1"}')
                    ->orWhere('status', '{"en":"0","es":1}')
                    ->orderBy('id', 'asc')->get();


                    $otras_promociones = [];
                    foreach($otrasP as $o) {
                        if($o->posicion == '1') {
                            array_push($otras_promociones, $o);
                        }
                    }

                    //dd($otras_promociones);

                    $books = [];
                    $libros = [];
                    $precios = [];
                    $descuentos = [];

                    if(count($otras_promociones)>=1){
                        $libros = explode(',', $otras_promociones[0]->books_isbns);
                        $descuentos = explode(',', $otras_promociones[0]->books_desc);
                    }

                    // || Los datos desde la DB
                    foreach($libros as $libro){
                        $b = Books::where('isbn', $libro)->first();
                        array_push($books, $b);
                    }

                    // || Comprobación de seguridad

                    $lCount = count($books);
                    $dCount = count($descuentos);

                    if($lCount != $dCount){
                        //dd('Algo salió mal a la hora de crear las listas en "Otras promociones": Las longitudes no coinciden.');
                    }
                    else {
                        // || Todo salió bien || //
                    }


                @endphp

    <div class="new-book-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title bt text-center pt-100 mb-30 section-title-res">
                        <h2>Otras promociones</h2>
                    </div>
                </div>
            </div>
            <div class="tab-active owl-carousel op">

                @for($i = 0; $i<$lCount; $i+=2)
                    @if(isset($books[$i]->isbn))
                    <div class="tab-total">
                        <div class="product-wrapper mb-40">
                            <div class="product-img">
                                <a href="/es/libro/{{$books[$i]->isbn}}">
                                    <img style="width:205px; height: 265px; max-width: 205px; max-height: 265px; object-fit: cover;" src="/img/covers/{{$books[$i]->isbn1}}.jpg" alt="book" class="primary" />
                                </a>
                                <div class="quick-view">
                                    <a class="action-view" style="cursor: pointer;" onclick="openProductModal('{{$books[$i]->isbn}}')" data-target="#productModal" data-toggle="modal" title="Quick View">
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </div>
                                <!--<div class="product-flag">
                                    <ul>
                                        <li><span class="sale">new</span> </li>
                                        <li><span class="discount-percentage">-5%</span></li>
                                    </ul>
                                </div>-->
                            </div>
                            <div class="product-details detalles-producto text-center">
                                <span class="edition" hidden id="{{$books[$i]->isbn}}"></span>
                                <h4><a href="/es/libro/{{$books[$i]->isbn}}">{{$books[$i]->isbn}} {{$books[$i]->title}}</a></h4>

                                <div class="product-price">
                                    <ul>
                                        {{--<li class="producto-precio">${{ $books[$i]->price - (($descuentos[$i] * $books[$i]->price) / 100)}}</li>--}}
                                        {{--<li class="old-price">${{$books[$i]->price}}</li>--}}
                                        <li class="producto-precio">${{$books[$i]->price}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-link">
                                <div class="product-button">
                                    <a onclick="sendToCart('{{$books[$i]->isbn}}')" style="cursor: pointer;" title="Add to cart"  class="product-button-a"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li><a href="/es/libro/{{$books[$i]->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @if($lCount-1>=($i+1))
                            @if(isset($books[$i+1]))
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="/es/libro/{{$books[$i+1]->isbn}}">
                                    <img style="width:205px; height: 265px; max-width: 205px; max-height: 265px; object-fit: cover;" src="/img/covers/{{$books[$i+1]->isbn1}}.jpg" alt="book" class="primary" />
                                </a>
                                <div class="quick-view">
                                    <a class="action-view" style="cursor: pointer;" onclick="openProductModal('{{$books[$i+1]->isbn}}')" data-target="#productModal" data-toggle="modal" title="Quick View">
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </div>
                                <!--
                                <div class="product-flag">
                                    <ul>
                                        <li><span class="sale">new</span> <br></li>
                                    </ul>
                                </div>-->
                            </div>
                            <div class="product-details detalles-producto text-center">
                                    <span class="edition" hidden id="{{$books[$i+1]->isbn}}"></span>
                                    <h4><a href="/es/libro/{{$books[$i+1]->isbn}}">{{$books[$i+1]->isbn}} {{$books[$i+1]->title}}</a></h4>
                                <div class="product-price">
                                    <ul>
                                        {{--<li class="producto-precio">${{ $books[$i+1]->price - (($descuentos[$i+1] * $books[$i+1]->price) / 100)}}</li>
                                        <li class="old-price">${{$books[$i+1]->price}}</li>--}}
                                        <li class="producto-precio">${{$books[$i+1]->price}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-link">
                                <div class="product-button">
                                    <a onclick="sendToCart('{{$books[$i+1]->isbn}}')" style="cursor: pointer;"  class="product-button-a" title="Add to cart"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li><a href="/es/libro/{{$books[$i+1]->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                                @endif
                        @endif

                        @if($lCount-1<($i+1))
                        {{-- // || Rellenar con el primer libro del arreglo || // --}}
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="/es/libro/{{$books[0]->isbn}}">
                                    <img style="width:205px; height: 265px; max-width: 205px; max-height: 265px; object-fit: cover;" src="/img/covers/{{$books[0]->isbn1}}.jpg" alt="book" class="primary" />
                                </a>
                                <div class="quick-view">
                                    <a class="action-view" onclick="openProductModal('{{$books[0]->isbn}}')" data-target="#productModal" data-toggle="modal" title="Quick View">
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </div>
                                <!--
                                <div class="product-flag">
                                    <ul>
                                        <li><span class="sale">new</span> <br></li>
                                    </ul>
                                </div>-->
                            </div>
                            <div class="product-details detalles-producto text-center">
                                    <span class="edition" hidden id="{{$books[0]->isbn}}"></span>
                                    <h4><a href="/es/libro/{{$books[0]->isbn}}">{{$books[0]->isbn}} {{$books[0]->title}}</a></h4>
                                <div class="product-price">
                                    <ul>
                                        {{--<li class="producto-precio">${{ $books[0]->price - (($descuentos[0] * $books[0]->price) / 100)}}</li>
                                        <li class="old-price">${{$books[0]->price}}</li>--}}
                                        <li class="producto-precio">${{$books[0]->price}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-link">
                                <div class="product-button">
                                    <a onclick="sendToCart('{{$books[0]->isbn}}')" style="cursor: pointer;"  class="product-button-a" title="Add to cart"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li><a href="/es/libro/{{$books[0]->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                    @endif
                @endfor

            </div>
        </div>
    </div>



    <!-- new-book-area-start -->
    <!-- banner-static-area-start -->

    @php
    $path_1 = '';
    $path_2 = '';

    if(isset($config) && $config->fondo_publicidades_home -1 >=0){
    $path_1 = $config->files[$config->fondo_publicidades_home-1]->name ?? '';
    }
    else {
    $path_1 = '';
    }


    @endphp


    <div class="banner-static-area bg ptb-100" style="background-image: url(/storage/files/{{$path_1}}); background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="banner-shadow-hover xs-mb">
                        @php
                        /*
                        Pagina home
                        Posicion 2
                        Tipo publicidad
                        Estado 1
                        */
                        $publicidad_2 = Publicidades::select('*')
                        ->where([
                        ['pagina', '=', 'home'],
                        ['posicion', '=', '2'],
                        ['tipo', '=', '1'],
                        ['status', '=', '{"en":"0","es":1}'],
                        ])
                        ->orWhere([
                        ['pagina', '=', 'home'],
                        ['posicion', '=', '2'],
                        ['tipo', '=', '1'],
                        ['status', '=', '{"en":"0","es":"1"}'],
                        ])->first()
                        ;

                        $publicidad_3 = Publicidades::select('*')
                        ->where([
                        ['pagina', '=', 'home'],
                        ['posicion', '=', '3'],
                        ['tipo', '=', '1'],
                        ['status', '=', '{"en":"0","es":1}'],
                        ])
                        ->orWhere([
                        ['pagina', '=', 'home'],
                        ['posicion', '=', '3'],
                        ['tipo', '=', '1'],
                        ['status', '=', '{"en":"0","es":"1"}'],
                        ])->first()
                        ;
                        @endphp


                        @if($publicidad_2 != null)
                        @if(count($publicidad_2->files) >0)

                            @if($publicidad_2 && $path = $publicidad_2->files[0]->path)
                                <a href="#"><img src="/storage/{{$path}}" alt="banner" style="width:100%; max-width: 540px; max-height: 388px; height: 388px; object-fit: cover;" /></a>
                            @else
                                <a href="#"><img src="img/banner/8.jpg" alt="banner" /></a>
                            @endif

                        @endif
                        @endif


                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="banner-shadow-hover">
                        @if($publicidad_3 != null)
                        @if(count($publicidad_3->files) > 0)
                            @if($publicidad_3 && $path = $publicidad_3->files[0]->path)
                                <a href="#"><img src="/storage/{{$path}}" alt="banner" style="width:100%; height: 388px; max-width: 540px; max-height: 388px; object-fit: cover;" /></a>
                            @else
                                <a href="#"><img src="img/banner/8.jpg" alt="banner" /></a>
                            @endif
                        @endif
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>


    @php
        $contador_1 = Contadores::select('*')->where([['status', '=', '{"en":"0","es":"1"}'], ['indice', '=', '0']])
        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '0']
        ])->first() ?? [];

        $contador_2 = Contadores::select('*')->where([['status', '=', '{"en":"0","es":"1"}'], ['indice', '=', '1']])
        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '1']
        ])->first() ?? [];

        $contador_3 = Contadores::select('*')->where([['status', '=', '{"en":"0","es":"1"}'], ['indice', '=', '2']])
        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '2']
        ])->first() ?? [];

        $contador_4 = Contadores::select('*')->where([['status', '=', '{"en":"0","es":"1"}'], ['indice', '=', '3']])
        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '3']
        ])->first() ?? [];
    @endphp


    <div style="display: flex; justify-content: space-around; align-items: center; width: 90%; height: 250px;  margin: auto;">
        @if($contador_1)
        <div style="display: flex;">
            <div style="width: 60px; height: 60px; background-color: #93648d; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                <img src="/fonts/chat.svg" style="margin: auto; width: 50%; height: 100%; color: white;">

            </div>
            <div style="margin-left: 14px; text-align: center;">
                <p style="color:#93648d; margin-bottom: 2px; margin-top: 6px;"><strong>{{$contador_1->titulo}}</strong></p>
                <p style="font-size: 16px;">{{$contador_1->numero}}</p>
            </div>
        </div>
        @endif

        @if($contador_2)
        <div style="display: flex;">
            <div style="width: 60px; height: 60px; background-color: #4cc3d9; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                <img src="/fonts/heart-pulse.svg" style="margin: auto; margin-top: 2px; width: 50%; height: 100%; color: white;">
            </div>

            <div style="margin-left: 14px; text-align: center;">
                <p style="color:#4cc3d9; margin-bottom: 2px; margin-top: 6px;"><strong>{{$contador_2->titulo}}</strong></p>
                <p style="font-size: 16px;">{{$contador_2->numero}}</p>
            </div>
        </div>
        @endif

        @if($contador_3)
        <div style="display: flex;">
            <div style="width: 60px; height: 60px; background-color: #7bc8a4; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                <img src="/fonts/heart.svg" style="margin-top: 6px; width: 60%; height: 100%; color: white;">
            </div>
            <div style="margin-left: 14px; text-align: center;">
                <p style="color:#7bc8a4; margin-bottom: 2px; margin-top: 6px;"><strong>{{$contador_3->titulo}}</strong></p>
                <p style="font-size: 16px;">{{$contador_3->numero}}</p>
            </div>
        </div>
        @endif

        @if($contador_4)
        <div style="display: flex;">
            <div style="width: 60px; height: 60px; background-color: #f16745; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                <img src="/fonts/star.svg" style="margin:auto;  width: 60%; height: 100%; color: white;">
            </div>
            <div style="margin-left: 14px; text-align: center;">
                <p style="color:#f16745; margin-bottom: 2px; margin-top: 6px;"><strong>{{$contador_4->titulo}}</strong></p>
                <p style="font-size: 16px;">{{$contador_4->numero}}</p>
            </div>
        </div>
        @endif
    </div>


    @if(isset($config) && count($config->files) >= 1)
    @if(isset($config) && $config->fondo_citas_home-1>=0 && $imagen = $config->files[$config->fondo_citas_home-1]->name)

        <div class="testimonial-area ptb-100 bg" style="background-image: url('/storage/files/{{$imagen}}') !important; background-size: cover; ">
    @else
        <div class="testimonial-area ptb-100 bg" style="background-image: url('/storage/files/CitaFondo.png') !important; background-size: cover; ">
    @endif
    @endif


            <div class="container">
                <div class="row">
                    <div class="testimonial-active owl-carousel">
                        <!--
                        Tipo == 2
                        Pagina == home
                        Status == 1
                        Posicion == 5
                    -->
                        @php
                        $citas = Publicidades::select('*')->where([
                        ['tipo', '=', '2'],
                        ['pagina', '=', 'home'],
                        ['posicion', '=', '5'],
                        ['status', '=', '{"en":"0","es":"1"}'],
                        ])->orWhere([
                        ['tipo', '=', '2'],
                        ['pagina', '=', 'home'],
                        ['status', '=', '{"en":"0","es":1}'],
                        ['posicion', '=', '5'],
                        ])
                        ->get();
                        @endphp



                        @foreach($citas as $cita)
                        <div class="col-lg-12">
                            <div class="single-testimonial text-center">
                                <div class="testimonial-img">
                                    <a href="#"><i class="fa fa-quote-right"></i></a>
                                </div>
                                <div class="testimonial-text">
                                    <p>{{$cita->texto_1}}</p>
                                    <a href="#">{{$cita->texto_2}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach




                    </div>
                </div>
            </div>
        </div>

        <div class="recent-post-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-30 section-title-res">
                            <h2>Lo ultimo de nuestro blog</h2>
                        </div>
                    </div>
                    <div class="post-active owl-carousel text-center">



                        @php
                            $posts = News::where([
                                ['status', '=', '{"en":"0","es":"1"}'],
                            ])
                            ->orWhere([
                                ['status', '=', '{"en":"0","es":1}'],
                            ])
                            ->get();

                        @endphp

                        @foreach($posts as $p)

                            @php
								$image_path = '';
								$actual_image = $p->image->name ?? 'img/blog/1.jpg';
								//$actual_image = 'img/blog/1.jpg';
								$image_path = ($actual_image != 'img/blog/1.jpg') ? '/storage/files/' . $actual_image : '/res_es/img/blog/1.jpg'

							@endphp


                        <div class="col-lg-12">
                            <div class="single-post">
                                <div class="post-img">
                                    <a href="/es/blog/{{$p->id}}"><img src="{{$image_path}}" style="width: 878px; height: 345px; object-fit: cover;" alt="post" /></a>
                                    <!--<div class="blog-date-time">
                                        <span class="day-time">06</span>
                                        <span class="moth-time">Dec</span>
                                    </div>-->
                                </div>
                                <div class="post-content">
                                    <h3><a href="/es/blog/{{$p->id}}">{{$p->title}}</a></h3>
                                    <span class="meta-author"> {{$p->creado_por}} </span>
                                    <p>{{$p->summary}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        @include('pages::public.components.footer')
        <!-- footer-area-end -->
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="modal-tab">
                                    <div class="product-details-large tab-content">

                                        <div class="tab-pane active" id="image-1">
                                            <img class="modal-img" src="" alt="" />
                                        </div>

                                        <div class="tab-pane" id="image-2">
                                            <img src="/res_es/img/product/quickview-l2.jpg" alt="" />
                                        </div>
                                        <div class="tab-pane" id="image-3">
                                            <img src="/res_es/img/product/quickview-l3.jpg" alt="" />
                                        </div>
                                        <div class="tab-pane" id="image-4">
                                            <img src="/res_es/img/product/quickview-l5.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="product-details-small quickview-active owl-carousel imagenes-modal">
                                        <a class="active" href="#image-1"><img src="/res_es/img/product/quickview-s4.jpg" alt="" /></a>
                                        <a href="#image-2"><img src="/res_es/img/product/quickview-s2.jpg" alt="" /></a>
                                        <a href="#image-3"><img src="/res_es/img/product/quickview-s3.jpg" alt="" /></a>
                                        <a href="#image-4"><img src="/res_es/img/product/quickview-s5.jpg" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <div class="modal-pro-content">
                                    <h3 class="product-title"></h3>
                                    <div class="price" style="margin-top: 10px;">
                                        <span class="product-price"></span>
                                    </div>
                                    <div class="isbn-book" style="font-weight: bold;">
                                        <span class="isbn-book-span"></span>
                                    </div>
                                    <div class="autor" style="font-weight: bold;">
                                        <span class="product-author"></span>
                                    </div>
                                    <div class="editorial" style="font-weight: bold;">
                                        <span class="product-publisher"></span>
                                    </div>
                                    <p class="product-description"></p>
                                    <br/>
                                    <form action="#">
                                        <input class="cantidad" type="number" value="1" />
                                        <button type="button" data-dismiss="modal" onclick="addToChartFromModal()" class="addToCartButton">Añadir al carrito</button>
                                    </form>
                                    <span><i class="fa fa-check"></i> In stock</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->


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
