@php
use Illuminate\Pagination\Paginator;
use TypiCMS\Modules\Promocions\Models\Promocion;


$categ = '';
$category = '';
$actual_page = 1;
$total_pages = 0;
$paginated_num = 5;
$books_per_page = 24;


if($page != null){
    $actual_page = (int) ($page);
}

if($categoria){

if($categoria != null){
    if($category = Categorias::where('name', utf8_encode($categoria))->first()){
        $category = $category->codigocat;
    }
    else if ($category = App\Subcategoria::where('nombre', utf8_encode($categoria))->first()){
        $category = $category->id_catalogo;
    }
}

}




Paginator::currentPageResolver(function () use ($actual_page) {
    return $actual_page;
});

$actual_books = DB::table('books')
->where('book_category', $category)
->orWhere('theme_1', $category)
->orWhere('theme_2', $category)
->orWhere('theme_3', $category)
->paginate($books_per_page);



/*
$busqueda = '';
if(Session::get('busqueda')){
    $busqueda = utf8_encode(Session::get('busqueda'));
}*/

if(request()->has('busqueda')){
    if($c = Categorias::where('name', request()->get('busqueda'))->first()){
        // || En categorias
        $codigocat = $c->codigocat;
        $actual_books = DB::table('books')
        ->where('book_category', $codigocat)
        ->paginate($books_per_page);
    }
    else {
        $actual_books = DB::table('books')
        ->whereFullText('title', request()->get('busqueda'))
        ->orWhereFullText('isbn', request()->get('busqueda'))
        ->orWhereFullText('publisher', request()->get('busqueda'))
        ->orWhereFullText('author_1', request()->get('busqueda'))
        ->orWhereFullText('author_2', request()->get('busqueda'))
        ->orWhereFullText('author_3', request()->get('busqueda'))
        ->orWhereFullText('edition', request()->get('busqueda'))
        ->orWhereFullText('root_publisher', request()->get('busqueda'))
        ->paginate($books_per_page);
    }

    if($a = Books::where('isbn', request()->get('busqueda'))->first()){
        if($b = DB::table('books')->where('isbn', request()->get('busqueda'))->paginate($books_per_page)){
            $actual_books = $b;
        }
    }


}
$publisher = null;
if($nuestraEditorial == 'yes'){
    $publisher = 'NUEVA LIBRERIA';

    $actual_books = DB::table('books')
    ->where('publisher', $publisher)
    ->paginate($books_per_page);
}



// || Tienda con categoria
if($publisher != null && $category != '')
{
    $actual_books = DB::table('books')
    ->where([
        ['publisher', '=', $publisher],
        ['book_category', '=', $category],
    ])
    ->paginate($books_per_page);
}


// || Reinicio Categorias
if($category != null){
    if($categg = Categorias::where('codigocat', $category)->first()){
        $categ = $categg->name;
    }
    else if($categg = App\Subcategoria::where('id_catalogo', $category)->first()){
        $categ = $categg->nombre;
    }
}

$total_pages = $actual_books->lastPage();
@endphp


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nueva Libreria - tienda</title>
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

<body class="shop">

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
                            <li><a href="#" class="active">tienda</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- shop-main-area-start -->

    <div class="shop-main-area mb-70">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-12 col-12 order-lg-1 order-2 mt-sm-50 mt-xs-40">
                    <div class="shop-left">
                        @if($categ)
                        <div class="section-title-5 mb-30">
                            <h2>Categoria</h2>
                        </div>
                        <div class="left-title mb-20">
                            <h4>{{$categ}}</h4>

                        </div>
                        @endif
                        <div class="left-menu mb-30">
                            <ul style="list-style: none;">

                            @php
                                // $subcategorias = App\Subcategoria::all();
                                $categorias = Categorias::all();

                            @endphp

                                <!--// || Subcategorias || //-->
                                @foreach($categorias as $c)

                                @php
                                    $catBooks = Books::where('book_category', $c->codigocat)->get();
                                    $subc = App\Subcategoria::where('codigotema', $c->codigocat)->get();
                                @endphp
                                @if(count($catBooks) >= 1 || count($subc)>=1)
                                    <div class="dropdown dropdown-menu-bottom" style="width: 100%; border-bottom: 1px solid #e5e5e5; display: flex; align-items: center">


                                        @if(count($subc) >=1)
                                            <button style="width: 12%; text-align: left; border:none; background:none; border-bottom: 1px solid #e5e5e5; box-sizing: border-box; color:#333; border-radius: 0px; font-size: 15px; font-family: 'Rufina', serif; font-weight: 400;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{--$c->name--}}
                                            </button>
                                        @endif

                                        @if(count($catBooks) >= 1)
                                            @if(count($subc) >=1)
                                                    <a href="/es/tienda/{{$c->name}}/1" style="color: black;">{{$c->name}}</a>
                                                @else
                                                    <a href="/es/tienda/{{$c->name}}/1" style="color: black; width: 100%; padding-top: .5em; padding-bottom: .5em; padding-left: 2.13em">{{$c->name}}</a>

                                                @endif

                                            @else
                                                <a href="javascript:void(0)" style="color: black;">{{$c->name}}</a>
                                        @endif

                                            {{--Nombre subcate--}}
                                        @if(count($subc)>=1)
                                        <div class="dropdown-menu" style="width: 100%; transform: translate3d(0px, 34px, 0px);" aria-labelledby="dropdownMenuButton">
                                            @foreach($subc as $s)
                                                <a class="dropdown-item" style="white-space: pre-wrap;" href="/es/tienda/{{$s->nombre}}/1">{{$s->nombre}}</a>
                                                {{--
                                                @if(count(Books::where('theme_1', $)))

                                                @endif--}}
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    @endif

                                @endforeach

                                <!-- Example split danger button -->

                            </ul>
                        </div>
                        <!--
						<div class="left-title mb-20">
							<h4>Color</h4>
						</div>
						<div class="color-menu mb-30">
							<ul class="color">
								<li><a href="#"></a></li>
								<li><a href="#" class="bg-2"></a></li>
								<li><a href="#" class="bg-3"></a></li>
								<li><a href="#" class="bg-4"></a></li>
							</ul>
						</div>-->
                    </div>
                </div>

                <div class="col-lg-9 col-md-12 col-12 order-lg-2 order-1">
                    <div class="category-image mb-30">
                        <!--878 345-->
                        @php
                            $imagePath = '/res_es/img/banner/31.jpg';
                            if(!isset($config->banner_tienda)) {
                                if(count(Configuraciones::all()) >=1){
                                    $config = Configuraciones::all()[0];

                                    if($config->banner_tienda-1 >= 0) {
                                        $imagePath = '/' . $config->files[$config->banner_tienda-1]->path ?? '/res_es/img/banner/32.jpg';
                                    }
                                }

                            } /*else {
                                    $imagePath = '/res_es/img/banner/31.jpg';
                                }*/

                        @endphp


                        <a href=""><img src="/storage{{$imagePath}}" style="width: 878px; height: 345px; object-fit: cover;" alt="banner" /></a>

                    </div>
                    <div class="section-title-5 mb-30">
                        <h2>Libros</h2>
                    </div>
                    <div class="toolbar mb-30">
                        <div class="shop-tab">
                            <div class="tab-3">
                                <ul class="nav">
                                    <li><a class="active" href="#th" data-toggle="tab"><i class="fa fa-th-large"></i>Mosaicos</a></li>
                                    <li><a href="#list" data-toggle="tab"><i class="fa fa-bars"></i>Lista</a></li>
                                </ul>
                            </div>
                            <div class="list-page">
                                <p> Pagina {{$actual_page}} de {{$total_pages}} </p>
                            </div>
                        </div>
                        {{--
                        <div class="field-limiter">
                            <div class="control">
                                <span>Mostrar</span>
                                <!-- chosen-start -->
                                <select data-placeholder="Default Sorting" style="width:50px;" class="chosen-select" tabindex="1">
                                    <option value="Sorting">1</option>
                                    <option value="popularity">2</option>
                                    <option value="rating">3</option>
                                    <option value="date">4</option>
                                </select>
                                <!-- chosen-end -->
                            </div>
                        </div>

                        <div class="toolbar-sorter">
                            <span>Ordenar por</span>
                            <select id="sorter" class="sorter-options" data-role="sorter">
                                <option selected="selected" value="position"> Posicion </option>
                                <option value="name"> Nombre </option>
                                <option value="price"> Precio </option>
                            </select>
                            <a href="#"><i class="fa fa-arrow-up"></i></a>
                        </div>
                        --}}
                    </div>
                    <!-- tab-area-start -->
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="th">
                            <div class="row">

                                @foreach($actual_books as $book)

                                <!-- || Check if it is an offer || -->
                                @php
                                /*
                                    $origPrice = 0;
                                    $isPromo = false;
                                    foreach (Promocion::orderBy('id', 'desc')->get() as $promo) {
                                        $imp = explode(',', $promo->books_isbns);
                                        if(in_array($book->isbn, $imp)){

                                            $index = array_search($book->isbn, $imp);
                                            $origPrice = $book->price;
                                            $price = explode(',', $promo->books_prices)[$index] - (explode(',', $promo->books_prices)[$index] * explode(',', $promo->books_desc)[$index] / 100);
                                            $book->price = $price;
                                            $isPromo = true;
                                            break;
                                        }
                                    }*/
                                @endphp

                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <!-- single-product-start -->
                                    <div class="product-wrapper mb-40" style="
                                            display: flex;
                                            flex-direction: column;
                                            align-items: center;
                                        ">
                                        <div class="product-img" style="
                                                    width: 158px;
                                                    min-width: 158px;
                                                    max-width: 158px;

                                                    height: 233px;
                                                    min-height: 233px;
                                                    max-height: 233px;
"                                           >
                                            <a href="/es/libro/{{$book->isbn}}">
                                                {{--<img src="https://nuevalibreria.com.ar/images/covers/{{$book->isbn1}}.jpg" alt="book" class="primary" />--}}
                                                <img src="/img/covers/{{$book->isbn1}}.jpg" style="
                                                    object-fit: cover;
                                                    width: 158px;
                                                    min-width: 158px;
                                                    max-width: 158px;

                                                    height: 233px;
                                                    min-height: 233px;
                                                    max-height: 233px;
                                                "
                                                     alt="book" class="primary" />

                                            </a>
                                            <div class="quick-view">
                                                <a class="action-view" style="cursor: pointer;" onclick="openProductModal('{{$book->isbn}}')" data-target="#productModal" data-toggle="modal" title="Quick View">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>
                                            </div>
                                            <div class="product-flag">
                                                <ul><!--
                                                    <li><span class="sale">new</span></li>
                                                    <li><span class="discount-percentage">-5%</span></li>
                                                    -->
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-details detalles-producto text-center">
                                            <span class="edition" hidden id="{{$book->isbn}}"></span>
                                            <h4><a href="/es/libro/{{$book->isbn}}" class="product-title">{{$book->isbn}} <br> {{$book->title}}</a></h4>
                                            <div class="product-price">
                                                <ul>
                                                    <li class="book-price producto-precio">${{$book->price}}</li>
                                                    {{--@if($isPromo)
                                                        <!--<li class="old-price">${{$origPrice}}</li>-->
                                                    @endif--}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-link">
                                            <div class="product-button">
                                                <a onclick="sendToCart('{{$book->isbn}}')" href="javascript:void(0)" class="product-button-a" title="Añadir al carrito"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
                                            </div>
                                            <div class="add-to-link">
                                                <ul>
                                                    <li><a href="/es/libro/{{$book->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-end -->
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="tab-pane fade" id="list">
                            <!-- single-shop-start -->


                            @foreach($actual_books as $book)
                            <!--205 x 290-->
                            <div class="single-shop mb-30">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="product-wrapper-2">
                                            <div class="product-img">
                                                <a href="/es/libro/{{$book->isbn}}"">
                                                    {{--<img src="https://nuevalibreria.com.ar/images/covers/{{$book->isbn1}}.jpg" alt="book" class="primary" />--}}
                                                    <img src="/img/covers/{{$book->isbn1}}.jpg" style="width: 205px; height: 290px; max-width: 205px; max-height: 290px; min-width: 205px; min-height: 290px; object-fit: cover;" alt="book" class="primary" />

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-12">
                                        <div class="product-wrapper-content">
                                            <div class="product-details detalles-producto">
                                                <!--<div class="product-rating">
													<ul>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
													</ul>
												</div>-->
                                                <span class="edition" hidden id="{{$book->isbn}}"></span>
                                                <h4><a href="/es/libro/{{$book->isbn}}">{{$book->title}}</a></h4>
                                                <div class="product-price">
                                                    <ul>
                                                        <li class="producto-precio">${{$book->price}}</li>
                                                    </ul>
                                                </div>
                                                @if($book->shortdescription != "")
                                                <p>{{$book->shortdescription}}</p>

                                                @else
                                                <p>Sin descripcion disponible.</p>
                                                @endif
                                            </div>
                                            <div class="product-link">
                                                <div class="product-button">
                                                    <a href="javascript:void(0)" onclick="sendToCart('{{$book->isbn}}')" class="product-button-a" title="Añadir al carrito"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
                                                </div>
                                                <div class="add-to-link">
                                                    <ul>
                                                        <li><a href="/es/libro/{{$book->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- single-shop-end -->
                        </div>
                    </div>
                    <!-- tab-area-end -->
                    <!-- pagination-area-start -->
                    <div class="pagination-area mt-50">
                        <div class="list-page-2">
                            <p> Pagina {{$actual_page}} de {{$total_pages}} </p>

                        </div>
                        <div class="page-number">
                            <ul>
                                @if($actual_page >1)

                                @if($category != '')
                                    @if($publisher)
                                        <li><a href="/es/nuestra-editorial/{{strtolower($categ)}}/1">Primer página</a></li>
                                    @else
                                        <li><a href="/es/tienda/{{strtolower($categ)}}/1">Primer página</a></li>
                                    @endif

                                @else
                                    @if($publisher)
                                        <li><a href="/es/nuestra-editorial/1">Primer página</a></li>

                                    @else
                                        <li><a href="/es/tienda/1">Primer página</a></li>
                                    @endif

                                @endif
                                <!-- || Primer página || -->
                                ...

                                @php
                                $tmp_list = [];
                                @endphp

                                @for($i = $actual_page; $i>((int)($actual_page-4)); $i--)
                                @if($i >= $actual_page-5 && $i>0 && $i!=$actual_page)
                                @php
                                array_push($tmp_list, $i);
                                @endphp
                                @endif
                                @endfor

                                @for($i = (int)(count($tmp_list)); $i>0; $i--)
                                @if($categ != '')

                                        @if($publisher)
                                            <li><a href="/es/nuestra-editorial/{{strtolower($categ)}}/{{$tmp_list[$i-1]}}">{{$tmp_list[$i-1]}}</a></li>
                                        @else
                                            <li><a href="/es/tienda/{{strtolower($categ)}}/{{$tmp_list[$i-1]}}">{{$tmp_list[$i-1]}}</a></li>
                                        @endif

                                    @else
                                        @if($publisher)
                                                <li><a href="/es/nuestra-editorial/{{$tmp_list[$i-1]}}">{{$tmp_list[$i-1]}}</a></li>
                                        @else
                                            <li><a href="/es/tienda/{{$tmp_list[$i-1]}}">{{$tmp_list[$i-1]}}</a></li>
                                        @endif

                                @endif

                                @endfor

                                @endif



                                @if($categ != '')
                                    @if($publisher)
                                        <li><a href="/es/nuestra-editorial/{{strtolower($categ)}}/{{$actual_page}}" class="active">{{$actual_page}}</a></li>
                                    @else
                                        <li><a href="/es/tienda/{{$categ}}/{{$actual_page}}" class="active">{{$actual_page}}</a></li>
                                    @endif
                                @else
                                    <li><a href="/es/tienda/{{$actual_page}}" class="active">{{$actual_page}}</a></li>

                                @endif

                                @if((int)($actual_page) != (int)($total_pages))

                                @for($i = 1; $i<4; $i++) @if((int)($actual_page + $i) <=$total_pages)

                                <li>
                                    @if($categ != '')
                                        @if($publisher)
                                            <a href="/es/nuestra-editorial/{{strtolower($categ)}}/{{(int)($actual_page +$i)}}"> {{(int)($actual_page +$i)}} </a>
                                        @else
                                            <a href="/es/tienda/{{strtolower($categ)}}/{{(int)($actual_page +$i)}}"> {{(int)($actual_page +$i)}} </a>
                                        @endif

                                    @else
                                        @if($publisher)
                                            <a href="/es/nuestra-editorial/{{(int)($actual_page +$i)}}"> {{(int)($actual_page +$i)}} </a>
                                        @else
                                            <a href="/es/tienda/{{(int)($actual_page +$i)}}"> {{(int)($actual_page +$i)}} </a>

                                        @endif
                                    @endif

                                </li>
                                    @endif

                                    @php
                                        if($i >= $total_pages){
                                            break;
                                        }
                                    @endphp

                                    @endfor


                                    ...



                                    @if($category != '')

                                        @if($publisher)
                                            <li><a href="/es/nuestra-editorial/{{strtolower($categ)}}/{{$total_pages}}">Ultima página</a></li>
                                        @else
                                            <li><a href="/es/tienda/{{strtolower($categ)}}/{{$total_pages}}">Ultima página</a></li>
                                        @endif

                                    @else

                                        @if($publisher)
                                            <li><a href="/es/nuestra-editorial/{{$total_pages}}">Ultima página</a></li>

                                        @else
                                            <li><a href="/es/tienda/{{$total_pages}}">Ultima página</a></li>

                                        @endif

                                    @endif

                                    <li><a href="#" class="angle"><i class="fa fa-angle-right"></i></a></li>
                                    @endif
                            </ul>
                        </div>
                    </div>
                    <!-- pagination-area-end -->
                </div>

            </div>
        </div>
    </div>

    <!-- shop-main-area-end -->
    <!-- footer-area-start -->

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
                                        <img class="modal-img" style="width: 100%; object-fit: cover;" src="" alt="" />
                                    </div>
                                </div>
                                {{--<div class="product-details-small quickview-active owl-carousel" style="">
                                    <a class="active" href="#image-1"><img src="/res_es/img/product/quickview-s4.jpg" alt="" /></a>
                                    <a href="#image-2"><img src="/res_es/img/product/quickview-s2.jpg" alt="" /></a>
                                    <a href="#image-3"><img src="/res_es/img/product/quickview-s3.jpg" alt="" /></a>
                                    <a href="#image-4"><img src="/res_es/img/product/quickview-s5.jpg" alt="" /></a>
                                </div>--}}
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">

                            <div class="modal-pro-content">
                                <h3 class="product-title"></h3>
                                <div class="isbn-book" style="font-weight: bold;">
                                    <span class="isbn-book-span"></span>
                                </div>
                                <div class="autor" style="font-weight: bold;">
                                    <span class="product-author"></span>
                                </div>
                                <div class="editorial" style="font-weight: bold;">
                                    <span class="product-publisher"></span>
                                </div>
                                <div class="price" style="margin-top: 10px;">
                                    <span class="product-price"></span>
                                </div>
                                <p class="product-description"></p>
                                <br/>
                                <div class="quick-view-select">
                                    <!--<div class="select-option-part">
                                        <label>Size*</label>
                                        <select class="select">
                                            <option value="">S</option>
                                            <option value="">M</option>
                                            <option value="">L</option>
                                        </select>
                                    </div>

                                    <div class="quickview-color-wrap">
                                        <label>Color*</label>
                                        <div class="quickview-color">
                                            <ul>
                                                <li class="blue">b</li>
                                                <li class="red">r</li>
                                                <li class="pink">p</li>
                                            </ul>
                                        </div>
                                    </div>-->
                                </div>

                                <form>
                                    <input type="number" class="cantidad" value="1" />
                                    <button type="button" data-dismiss="modal" class="addToCartButton" onclick="addToChartFromModal()">Añadir al carrito</button>
                                </form>
                                <span><i class="fa fa-check"></i> Hay stock</span>
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
    <!-- popper j/res_es/s -->
    <script src="/res_es/js/popper.min.js"></script>
    <!-- bootstra/res_es/p js -->
    <script src="/res_es/js/bootstrap.min.js"></script>
    <!-- owl.caro/res_es/usel js -->
    <script src="/res_es/js/owl.carousel.min.js"></script>
    <!-- meanmenu/res_es/ js -->
    <script src="/res_es/js/jquery.meanmenu.js"></script>
    <!-- wow js -/res_es/--->
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


<!--<script src="{{ App::environment('production') ? mix('/js/public.js') : asset('/js/public.js') }}"></script>-->
</body>

<style>
    .product-wrapper {

    }

    .product-img {

    }
</style>

</html>
