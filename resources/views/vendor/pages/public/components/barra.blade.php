@section('vue')

    <header>
        <!-- header-top-area-start -->
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <!--
                        <div class="language-area">
                            <ul>

                                <li><img src="img/flag/1.jpg" alt="flag" /><a href="#">English<i class="fa fa-angle-down"></i></a>
                                    <div class="header-sub">
                                        <ul>
                                            <li><a href="#"><img src="img/flag/2.jpg" alt="flag" />france</a></li>
                                            <li><a href="#"><img src="img/flag/3.jpg" alt="flag" />croatia</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li><a href="#">USD $<i class="fa fa-angle-down"></i></a>
                                    <div class="header-sub dolor">
                                        <ul>
                                            <li><a href="#">EUR €</a></li>
                                            <li><a href="#">USD $</a></li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="account-area text-right">
                            <ul>
                                @auth
                                <li><a class="username" href="my-account.html">{{utf8_decode(auth()->user()->first_name)}}  {{utf8_decode(auth()->user()->last_name)}}</a></li>
                                @if(auth()->user()->superuser == 1 && auth()->user()->activated == 1)
                                    <li><a href="/admin">Administración</a></li>
                                @endif
                                <li><a href="/es/checkout" class="barbut">Checkout</a></li>
                                <li><a href="/es/logout" class="barbut">Cerrar Sesion</a></li>



                                @endauth

                                @guest
                                <li><a class="inicio" href="/es/iniciar-sesion">Iniciar Sesion</a></li>
                                <li><a class="Registrarse" href="/es/registrarse">Registrarse</a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-top-area-end -->
        <!-- header-mid-area-start -->
        <div class="header-mid-area ptb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-12" style="display: flex; align-items: center;">
                        <div class="header-search">

                            <form method="get" action="/es/tienda/">
                                <div class="col" style="display:flex;">
                                    <input name="busqueda" type="text" placeholder="Buscar productos" id="busqueda-productos"/>
                                    <button class="btn" style="background-color: #7551c2">
                                        <i class="fa fa-search" style="color: white;"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-12">
                        <div class="logo-area text-center logo-xs-mrg">
                            <a href="/es/inicio"><img style="width: 60%; height: 100px; object-fit: cover;" src="/img/logo/logo2.png" alt="logo" /></a>
                        </div>
                    </div>
                    
                    @if(Auth::check())
                    <carrito session="{{Session::getId()}}" logged="true"></carrito>

                    @else
                    <carrito session="{{Session::getId()}}" logged="false"></carrito>
                    @endif

                    {{--
                    <div class="col-lg-3 col-md-3 col-12" style="display: flex; align-items: center;">
                        <div id="carrito">

                        <div class="my-cart">
                            <ul>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i>Carrito</a>
                                    <span class="cantidad-carrito">0</span>
                                    <div class="mini-cart-sub">
                                        <div class="cart-product">
                                            <!--<div class="single-cart">
                                                <div class="cart-img">
                                                    <a href="#"><img src="/img/product/1.jpg" alt="book" /></a>
                                                </div>
                                                <div class="cart-info">
                                                    <h5><a href="#">Joust Duffle Bag</a></h5>
                                                    <p>1 x £60.00</p>
                                                </div>
                                                <div class="cart-icon">
                                                    <a href="#"><i class="fa fa-remove"></i></a>
                                                </div>
                                            </div>
                                            <div class="single-cart">
                                                <div class="cart-img">
                                                    <a href="#"><img src="/res_es/img/product/3.jpg" alt="book" /></a>
                                                </div>
                                                <div class="cart-info">
                                                    <h5><a href="#">Chaz Kangeroo Hoodie</a></h5>
                                                    <p>1 x £52.00</p>
                                                </div>
                                                <div class="cart-icon">
                                                    <a href="#"><i class="fa fa-remove"></i></a>
                                                </div>
                                            </div>-->
                                        </div>
                                        <div class="cart-totals">
                                            <h5>Total <span class="precioTotal">Carrito vacío</span></h5>
                                        </div>
                                        <div class="cart-bottom">
                                            <a class="view-cart" href="/es/mi-carrito/{{Session::getId()}}">Ver en detalle</a>
                                            <a class="view-cart" href="/es/checkout"f>Comprar</a>
|
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    --}}

                </div>
            </div>
        </div>
        <!-- header-mid-area-end -->
        <!-- main-menu-area-start -->
        <div class="main-menu-area d-md-none d-none d-lg-block sticky-header-1" id="header-sticky">
            <div class="notification-container">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="display: flex; justify-content: space-around;">
                        <div class="menu-area">
                            <nav>
                                <ul>


                                    <li><a href="/es/nuestra-editorial/1">Nuestra editorial<i class="fa fa-angle-down"></i></a>
                                        <div class="mega-menu">

                                                @php
                                                    $nuestra_editorial_tmp = Books::select('*')->where('publisher', 'LIKE', 'NUEVA LIBRERIA')->get();
                                                    $nuestra_editorial = [];

                                                    foreach($nuestra_editorial_tmp as $n){
                                                        if($n->book_category != ''){
                                                            array_push($nuestra_editorial, $n);
                                                        }
                                                    }

                                                    $categorias = [];
                                                    $length = count($nuestra_editorial);

                                                    for($i = 0; $i<$length; $i++){
                                                                $cat = Categorias::where('codigocat', $nuestra_editorial[$i]->book_category)->first()->name;
                                                                if(!in_array($cat, $categorias)){
                                                                    array_push($categorias, $cat);
                                                                }
                                                    }
                                                    sort($categorias);
                                                    $cantidad_editorial = ceil(count($categorias)/4);

                                                @endphp


                                            @for($i=0; $i<4; $i++)
                                            <span>
                                                @for($j=0; $j<$cantidad_editorial; $j++)
                                                @php if(empty($categorias)){ break; } @endphp
                                                <a href="/es/nuestra-editorial/{{strtolower($categorias[0])}}/1">{{$categorias[0]}}</a>
                                                    @php
                                                        \array_splice($categorias, 0, 1);
                                                    @endphp
                                                @endfor
                                            </span>
                                            @endfor


                                        </div>
                                    </li>

                                    <!--<li><a href="/es/tienda">Catalogo<i class="fa fa-angle-down"></i></a>
                                        <div class="mega-menu">
                                            @php
                                            $categorias = array();

                                            foreach(Categorias::all() as $categ){

                                                if(count(Books::where('book_category', $categ->codigocat)->get())>=1){
                                                    array_push($categorias, $categ);
                                                }

                                            }

                                            $cantidad_catalogo = ceil(count($categorias)/4);

                                            @endphp


                                            @for($i=0; $i<4; $i++) <span>
                                                @for($j=0; $j<$cantidad_catalogo; $j++)
                                                @php
                                                    if(empty($categorias)){ break; }
                                                @endphp

                                                <a href="/es/tienda/{{strtolower($categorias[0]->name)}}/1">{{$categorias[0]->name}}</a>
                                                    @php
                                                    \array_splice($categorias, 0, 1);
                                                    @endphp
                                                    @endfor
                                                    </span>
                                            @endfor
                                            <br/>
                                            <br/>
                                            <br/>
                                            <span>
                                                <a href="/es/tienda">Mas en la tienda</a>
                                            </span>

                                        </div>
                                    </li>-->

                                    <li>
                                        <a href="/es/tienda">Tienda</a>
                                        <!--<div class="mega-menu">
                                            @php
                                            $exposiciones = array();
                                            foreach(
                                            Pages::select('*')
                                            ->where([
                                            ['status', '=', '{"en":"0","es":"1"}'],
                                            ['template', '=', 'Exposicion'],
                                            ])
                                            ->orWhere([
                                            ['status', '=', '{"en":"0","es":1}'],
                                            ['template', '=', 'Exposicion'],
                                            ])->orderBy('position', 'ASC')->get()
                                            as $expo
                                            ){
                                            array_push($exposiciones, $expo);
                                            }



                                            $length = 4;
                                            $cantidad = ceil(count($exposiciones)/4)
                                            @endphp

                                            @for($i = 0; $i<$length; $i++)
                                            <span>
                                                @for($j = 0; $j<$cantidad; $j++) @php if(empty($exposiciones)){ break; } @endphp
                                                <a href="{{str_replace("\/", "/", $exposiciones[0]->uri);}}">{{$exposiciones[0]->title}}</a>
                                                @php
                                                    \array_splice($exposiciones, 0, 1);
                                                @endphp
                                            @endfor
                                            </span>

                                            @endfor
                                        </div>-->
                                    </li>

                                    <li><a href="/es/nuestro-blog/1">Blog</a>
                                        <!--<div class="mega-menu mega-menu-2">

                                            @php
                                            $clientes = [];
                                            foreach(Clientesinternacionales::select('*')
                                            ->where([
                                            ['status', '=', '{"en":"0","es":"1"}'],
                                            ])
                                            ->orWhere([
                                            ['status', '=', '{"en":"0","es":1}'],
                                            ])->get()
                                            as $c
                                            ){
                                            array_push($clientes, $c);
                                            }

                                            $cantidad = ceil(count($clientes)/4);
                                            $num = 4;
                                            @endphp
                                            @for($i=0; $i<$num; $i++) @php if(empty($clientes)){ break; } @endphp
                                            <span>
                                                @for($j=0; $j<$cantidad; $j++)
                                                <a href="/es/clientes-internacionales/{{$clientes[0]->id}}">{{$clientes[0]->nombre}}</a>

                                                    @php
                                                    \array_splice($clientes, 0, 1);
                                                    @endphp
                                                    @endfor
                                                    </span>

                                                    @endfor

                                        </div>-->
                                    </li>

                                    <li><a href="#">Contacto</a>
                                        <!--<div class="sub-menu sub-menu-2">
                                            <ul>
                                                @foreach(Pages::select('*')->orderBy('position', 'ASC')->get() as $p)

                                                @if($p->parent_id == null && $p->title != "Login" && $p->title != "Registro")
                                                    @if($p->status)
                                                        <li><a href="{{str_replace("\/", "/", $p->uri);}}">{{$p->title}}</a></li>
                                                    @endif
                                                @endif


                                                @endforeach
                                            </ul>
                                        </div>-->
                                    </li>
                                    {{--
                                    <li><a href="#">Paginas<i class="fa fa-angle-down"></i></a>
                                        <div class="sub-menu sub-menu-2">
                                            <ul>
                                                @foreach(Pages::select('*')->orderBy('position', 'ASC')->get() as $p)
                                                @if($p->parent_id == null && $p->title != "Login" && $p->title != "Registro" && $p->template != 'detalle-libro')
                                                    @if($p->status)
                                                        <li><a href="{{str_replace("\/", "/", $p->uri);}}">{{$p->title}}</a></li>
                                                    @endif
                                                @endif


                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>--}}
                                    {{--
                                    <li><a href="#">Nuestro blog<i class="fa fa-angle-down"></i></a>
                                        <div class="mega-menu mega-menu-2">
                                            <span>
                                                <a href="#" class="title">Tops</a>
                                                <a href="shop.html">Shirts</a>
                                                <a href="shop.html">Florals</a>
                                                <a href="shop.html">Crochet</a>
                                                <a href="shop.html">Stripes</a>
                                            </span>
                                            <span>
                                                <a href="#" class="title">Bottoms</a>
                                                <a href="shop.html">Shorts</a>
                                                <a href="shop.html">Dresses</a>
                                                <a href="shop.html">Trousers</a>
                                                <a href="shop.html">Jeans</a>
                                            </span>
                                            <span>
                                                <a href="#" class="title">Shoes</a>
                                                <a href="shop.html">Heeled sandals</a>
                                                <a href="shop.html">Flat sandals</a>
                                                <a href="shop.html">Wedges</a>
                                                <a href="shop.html">Ankle boots</a>
                                            </span>
                                        </div>
                                    </li>--}}

                                </ul>
                            </nav>
                        </div>
                        <!--
                        <div class="safe-area">
                            <a href="product-details.html">sales off</a>
                        </div>
                        -->
                    </div>
                </div>
            </div>

        </div>

        <!-- main-menu-area-end -->
        <!-- mobile-menu-area-start -->
        <div class="mobile-menu-area d-lg-none d-block fix">
            <div class="notification-container">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul id="nav">
                                    <li><a href="index.html">Home</a>
                                        <ul>
                                            <li><a href="index.html">Home-1</a></li>
                                            <li><a href="index-2.html">Home-2</a></li>
                                            <li><a href="index-3.html">Home-3</a></li>
                                            <li><a href="index-4.html">Home-4</a></li>
                                            <li><a href="index-5.html">Home-5</a></li>
                                            <li><a href="index-6.html">Home-6</a></li>
                                            <li><a href="index-7.html">Home-7</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product-details.html">Book</a>
                                        <ul>
                                            <li><a href="shop.html">Tops & Tees</a></li>
                                            <li><a href="shop.html">Polo Short Sleeve</a></li>
                                            <li><a href="shop.html">Graphic T-Shirts</a></li>
                                            <li><a href="shop.html">Jackets & Coats</a></li>
                                            <li><a href="shop.html">Fashion Jackets</a></li>
                                            <li><a href="shop.html">Crochet</a></li>
                                            <li><a href="shop.html">Sleeveless</a></li>
                                            <li><a href="shop.html">Stripes</a></li>
                                            <li><a href="shop.html">Sweaters</a></li>
                                            <li><a href="shop.html">hoodies</a></li>
                                            <li><a href="shop.html">Heeled sandals</a></li>
                                            <li><a href="shop.html">Polo Short Sleeve</a></li>
                                            <li><a href="shop.html">Flat sandals</a></li>
                                            <li><a href="shop.html">Short Sleeve</a></li>
                                            <li><a href="shop.html">Long Sleeve</a></li>
                                            <li><a href="shop.html">Polo Short Sleeve</a></li>
                                            <li><a href="shop.html">Sleeveless</a></li>
                                            <li><a href="shop.html">Graphic T-Shirts</a></li>
                                            <li><a href="shop.html">Hoodies</a></li>
                                            <li><a href="shop.html">Jackets</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product-details.html">Audio books</a>
                                        <ul>
                                            <li><a href="shop.html">Tops & Tees</a></li>
                                            <li><a href="shop.html">Sweaters</a></li>
                                            <li><a href="shop.html">Hoodies</a></li>
                                            <li><a href="shop.html">Jackets & Coats</a></li>
                                            <li><a href="shop.html">Long Sleeve</a></li>
                                            <li><a href="shop.html">Short Sleeve</a></li>
                                            <li><a href="shop.html">Polo Short Sleeve</a></li>
                                            <li><a href="shop.html">Sleeveless</a></li>
                                            <li><a href="shop.html">Sweaters</a></li>
                                            <li><a href="shop.html">Hoodies</a></li>
                                            <li><a href="shop.html">Wedges</a></li>
                                            <li><a href="shop.html">Vests</a></li>
                                            <li><a href="shop.html">Polo Short Sleeve</a></li>
                                            <li><a href="shop.html">Sleeveless</a></li>
                                            <li><a href="shop.html">Graphic T-Shirts</a></li>
                                            <li><a href="shop.html">Hoodies</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product-details.html">children’s books</a>
                                        <ul>
                                            <li><a href="shop.html">Shirts</a></li>
                                            <li><a href="shop.html">Florals</a></li>
                                            <li><a href="shop.html">Crochet</a></li>
                                            <li><a href="shop.html">Stripes</a></li>
                                            <li><a href="shop.html">Shorts</a></li>
                                            <li><a href="shop.html">Dresses</a></li>
                                            <li><a href="shop.html">Trousers</a></li>
                                            <li><a href="shop.html">Jeans</a></li>
                                            <li><a href="shop.html">Heeled sandals</a></li>
                                            <li><a href="shop.html">Flat sandals</a></li>
                                            <li><a href="shop.html">Wedges</a></li>
                                            <li><a href="shop.html">Ankle boots</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">blog</a>
                                        <ul>
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog-details.html">blog-details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product-details.html">Page</a>
                                        <ul>
                                            <li><a href="shop.html">shop</a></li>
                                            <li><a href="shop-list.html">shop list view</a></li>
                                            <li><a href="product-details.html">product-details</a></li>
                                            <li><a href="product-details-affiliate.html">product-affiliate</a></li>
                                            <li><a href="blog.html">blog</a></li>
                                            <li><a href="blog-details.html">blog-details</a></li>
                                            <li><a href="contact.html">contact</a></li>
                                            <li><a href="about.html">about</a></li>
                                            <li><a href="login.html">login</a></li>
                                            <li><a href="register.html">register</a></li>
                                            <li><a href="my-account.html">my-account</a></li>
                                            <li><a href="cart.html">cart</a></li>
                                            <li><a href="compare.html">compare</a></li>
                                            <li><a href="checkout.html">checkout</a></li>
                                            <li><a href="wishlist.html">wishlist</a></li>
                                            <li><a href="404.html">404 Page</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile-menu-area-end -->
</header>

@endsection


@extends('pages::public.master')

<script src="/res_es/js/vendor/jquery-1.12.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    var user = '{!! Session::getId() !!}';
</script>

<script src="/js/NotificationController.js"></script>
<script src="/js/ModalProductController.js"></script>
<script src="/js/CarritoController.js"></script>
