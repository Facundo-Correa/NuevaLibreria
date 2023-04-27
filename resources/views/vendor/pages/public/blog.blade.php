<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nueva Libreria – Blog</title>
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

<body class="blog">
    <!-- header-area-start -->
    @include('pages::public.components.barra')

    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="/es/inicio">Nueva Libreria</a></li>
                            <li><a class="active">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- blog-main-area-start -->
    <div class="blog-main-area mb-70">
        <div class="container">
            <div class="row">

                <!--|| Categorias, Nuevos-->

                <div class="col-lg-3 col-md-12 col-12 order-lg-1 order-2 mt-sm-50">
                    <div class="single-blog mb-50">
                        <div class="blog-left-title">
                            <h3>Buscar en el blog</h3>
                        </div>
                        <div class="side-form">
                            <div>
                                <input
                                    style="padding: .5em 1em; border-radius: .5em; border: 1px solid rgba(0, 0, 0, 0.449);"
                                    class="blogsearcher" type="text" placeholder="Buscar...." />
                                <a href="javascript:void(0)" class="blogsearcherbutton"><i
                                        class="fa fa-search"></i></a>

                                <script>
                                    document.querySelector('.blogsearcherbutton').addEventListener('click', (event) => {
                                        location = "/es/nuestro-blog/buscar/" + document.querySelector('.blogsearcher').value + '/1';
                                    });

                                    document.querySelector('.blogsearcher').addEventListener('focus', (event) => {
                                        document.addEventListener('keydown', (event) => {
                                            const keyName = event.key;
                                            if (keyName == 'Enter') {
                                                location = "/es/nuestro-blog/buscar/" + document.querySelector('.blogsearcher')
                                                    .value + '/1';

                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="single-blog mb-50">
                        <div class="blog-left-title">
                            <h3>Blogs</h3>
                        </div>
                        <div class="blog-side-menu">
                            <ul>
                                <li><a href="/es/nuestro-blog/noticias/1">Noticias</a></li>
                                <li><a href="/es/nuestro-blog/comunicados/1">Comunicados</a></li>
                                <li><a href="/es/nuestro-blog/exposiciones/1">Exposiciones</a></li>
                            </ul>
                        </div>
                    </div>

                </div>


                <!--|| Blogs ||-->

                <div class="col-lg-9 col-md-12 col-12 order-lg-2 order-1">
                    <div class="blog-main-wrapper">

                        @php
                            $actual_page = request()['pagina'] ?? 1;
                            //dd($actual_page);
                            $posts_per_page = 10;
                            $active_posts = [];
                            $busqueda = false;

                            $total_pages = round(count(News::all()) / $posts_per_page);
                            //$total_pages = 10;
                            if (isset($resultados)) {
                                if (count($resultados) == 0) {
                                    $resultados = [];
                                    $busqueda = true;
                                } else {
                                    $active_posts = array_slice($resultados, ($actual_page - 1) * $posts_per_page, $posts_per_page); // Otra forma de paginar
                                }
                            } else {
                                $resultados = [];
                                $busqueda = false;
                                $posts = News::select('*')
                                    ->orderBy('id', 'ASC')
                                    ->paginate($posts_per_page, ['*'], 'page', $actual_page);
                                $active_posts = [];
                                foreach ($posts as $post) {
                                    if ($post->status) {
                                        array_push($active_posts, $post);
                                    }
                                }
                            }
                        @endphp


                        <h1 class="found" style="text-align: center"></h1>
                        <p class="foundsub" style="text-align: center;"></p>
                        <br />
                        <br />
                        <script>
                            var busqueda = '{!! json_encode($busqueda) !!}';
                            var resultados = '{!! json_encode($resultados) !!}';
                            console.log(busqueda);
                            if (resultados == '[]' && busqueda == 'true') {
                                document.querySelector('.found').innerHTML = 'Sin resultados para su busqueda';
                                document.querySelector('.foundsub').innerHTML = 'Verifique que su busqueda sea correcta';
                            }
                        </script>


                        @foreach ($active_posts as $post)
                            @php
                                $image_path = '';
                                $actual_image = $post->image->name ?? 'img/blog/1.jpg';
                                if ($actual_image == 'img/blog/1.jpg') {
                                    $actual_image = Files::where('id', $post->image_id)->first()->name ?? 'img/blog/1.jpg';
                                }
                                $image_path = $actual_image != 'img/blog/1.jpg' ? '/storage/files/' . $actual_image : '/res_es/img/blog/1.jpg';
                            @endphp

                            <div class="single-blog-post">
                                <div class="author-destils mb-30">
                                    <div class="author-left">

                                        <div class="author-description">
                                            <p>Escrito por:
                                                <a href="#"><span>{{ $post->creado_por }}</span></a>
                                            </p>
                                            <span>{{ $post->created_at }}</span>
                                        </div>
                                    </div>
                                    <div class="author-right">
                                        <span>Compartir:</span>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="blog-img mb-30">
                                    <a href="/es/blog/{{ $post->id }}"><img
                                            style="width:100%; height:100%; max-width:878px; max-height: 345px; object-fit: cover;"
                                            src="{{ $image_path }}" alt="blog" /></a>
                                </div>
                                <div class="single-blog-content">
                                    <div class="single-blog-title">
                                        @if (isset($resultados) && count($resultados) > 0)
                                            <h3><a
                                                    href="/es/blog/{{ $post->id }}">{{ json_decode($post->title)->es }}</a>
                                            </h3>
                                        @else
                                            <h3><a href="/es/blog/{{ $post->id }}">{{ $post->title }}</a></h3>
                                        @endif
                                    </div>
                                    <div class="blog-single-content">

                                        @if (isset($resultados) && count($resultados) > 0)
                                            <p>{{ json_decode($post->summary)->es }}</p>
                                        @else
                                            <p>{{ $post->summary }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="blog-comment-readmore">
                                    <div class="blog-readmore">
                                        <a href="/es/blog/{{ $post->id }}">Seguir leyendo<i
                                                class="fa fa-long-arrow-right"></i></a>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                        @php
                            $paginas = [];
                        @endphp

                        @if ($total_pages > 0)
                            {{-- || Se obtienen las tres páginas anteriores || --}}
                            @php
                                $tempNum = (int) $actual_page - 3;
                                while ($tempNum <= 0) {
                                    $tempNum++;
                                }

                                for ($i = $tempNum; $i < (int) $actual_page; $i++) {
                                    array_push($paginas, $i);
                                }
                            @endphp


                            {{-- Se pushea la página actual --}}
                            @php
                                array_push($paginas, (int) $actual_page);
                            @endphp

                            {{-- || Se obtienen las tres páginas siguientes || --}}
                            @for ($i = 1; $i < 4; $i++)
                                @if ($actual_page + $i > $total_pages)
                                @break
                            @endif

                            @php
                                array_push($paginas, $i + $actual_page);
                            @endphp
                        @endfor

                        @php

                        @endphp

                        <ul style="display:flex; justify-content: end;">
                            <li>
                                <a style="margin-right:.5em;" href="1">
                                    Primer página
                                </a>
                            </li>

                            @foreach ($paginas as $pagina)
                                @if ($pagina != (int) $actual_page)
                                    <li>
                                        <a style="margin-right:.5em;" href="{{ $pagina }}">
                                            {{ $pagina }}
                                        </a>
                                    </li>
                                @endif

                                @if ($pagina == (int) $actual_page)
                                    <li>
                                        <a style="margin-right:.5em; color:#fd7e14;" href="{{ $pagina }}">
                                            {{ $pagina }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                            <li>
                                <a style="margin-right:.5em;" href="/{{ $total_pages }}">
                                    Ultima página
                                </a>
                            </li>
                        </ul>

                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog-main-area-end -->

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
