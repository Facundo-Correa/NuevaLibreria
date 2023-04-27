@php
	$libro = [];
	if($b = $lib){
		$libro = $lib;
	}
	//dd($libro);

@endphp

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Nueva Libreria - Detalles</title>
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
    <body class="product-details">
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
								<li><a href="#" class="active">Detalles del libro</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- product-main-area-start -->
		<div class="product-main-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-12 col-12 order-lg-1 order-1">
						<!-- product-main-area-start -->
						<div class="product-main-area">
							<div class="row">
								<div class="col-lg-5 col-md-6 col-12">
									<div class="flexslider">
										@if($libro)
										<ul class="slides">
											<li data-thumb="/res_es/img/thum-2/1.jpg">
											  <img src="/img/covers/{{$libro->isbn1}}.jpg" alt="woman" />
											</li>
										</ul>
										@endif
									</div>
								</div>
								<div class="col-lg-7 col-md-6 col-12">
									<div class="product-info-main">
										<div class="page-title">
											@if($libro)
											<span class="edition" id="{{$libro->isbn}}"></span>
											<h1>{{$libro->title}}</h1>
											@endif
										</div>
										<div class="product-info-stock-sku">
											<!--<span>In stock</span>-->
											<div class="product-attribute">
												@if($libro)
												<span>ISBN:</span>
												<span class="value isbn-value">{{$libro->isbn}}</span>
												<br/>
												<span>Autor/es:</span>
												<span class="value">{{$libro->author_1}} {{$libro->author_2}} {{$libro->author_3}}</span>
												<br/>
												<span>Editorial:</span>
												@if($libro->publisher != '')
													<span class="value">{{$libro->publisher}}</span>
												@else
													<span class="value">Editorial no especificada.</span>
												@endif

												@endif
											</div>
										</div>

										<div class="product-info-price">
											@if($libro)
											<div class="price-final">
												<span class="precio product-price">${{$libro->price}}</span>
												<span class="old-price">${{$libro->price}}</span>
											</div>
											@endif

											@if($libro)
											<script>
												let isbn =  {!! json_encode($libro->isbn) !!};

												axios.post('/api/check-promocion', {isbn: isbn}).then(function(response){

													if(response.data != null){
														document.querySelector('.precio').innerHTML = '$' + response.data;
													}
													else {
														document.querySelector('.old-price').remove();

													}
												});
											</script>
											@endif

										</div>
										<div class="product-add-form">
											<form action="#">
												<div class="quality-button">
													<input class="qty cantidad" type="number" value="1">
												</div>
												<a class="addToCartButton" onclick="sendToCartFromDetails(isbn)" style="cursor:pointer;">Añadir al carrito</a>
											</form>
										</div>
										<div class="product-social-links">
										    <div class="product-addto-links">
												<a href="#"><i class="fa fa-heart"></i></a>
												<a href="#"><i class="fa fa-pie-chart"></i></a>
												<a href="#Preguntar"><i class="fa fa-envelope-o"></i></a>
											</div>
											@if($libro)
											<div class="product-addto-links-text">
												<p>{{$libro->shortdescription}}</p>
											</div>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- product-main-area-end -->
						<!-- product-info-area-start -->
						<div class="product-info-area mt-80">
							<!-- Nav tabs -->
							<ul class="nav">
								<li><a class="active" href="#Details" data-toggle="tab">Indice</a></li>
								<li><a href="#Preguntar" data-toggle="tab">Preguntar</a></li>
								<li><a href="#Preguntas" data-toggle="tab">Preguntas</a></li>
							</ul>
							<div class="tab-content">
                                <div class="tab-pane fade show active" id="Details">
                                    <div class="valu">
										@if($libro)
                                            @if($libro->indice != '')
                                     		    <p>{{$libro->indice}}</p>
                                            @else
                                     		    <p>Sin indice subido</p>
                                            @endif
									  	@endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="Preguntar">
                                    <div class="valu valu-2">
                                        <div class="section-title mb-60 mt-60">
                                            <h2>Preguntar en {{$libro->title}}</h2>
                                        </div>

                                        <!--<div class="review-add">
                                            <h3>You're reviewing:</h3>
                                            <h4>Joust Duffle Bag</h4>
                                        </div>-->
                                        <!--<div class="review-field-ratings">
                                            <span>Your Rating <sup>*</sup></span>
                                            <div class="control">
                                                <div class="single-control">
                                                    <span>Value</span>
                                                    <div class="review-control-vote">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                                <div class="single-control">
                                                    <span>Quality</span>
                                                    <div class="review-control-vote">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                                <div class="single-control">
                                                    <span>Price</span>
                                                    <div class="review-control-vote">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="review-form">
                                            <!--<div class="single-form">
                                                <label>Nombre y Apellido <sup>*</sup></label>
                                                <form action="javascript:void(0)">
                                                    <input type="text" class="nyp"/>
                                                </form>
                                            </div>-->
                                            <!--<div class="single-form single-form-2">
                                                <label>Asunto <sup>*</sup></label>
                                                <form action="#">
                                                    <input type="text" />
                                                </form>
                                            </div>-->
                                            <div class="single-form">
                                                <label>Pregunta <sup>*</sup></label>
                                                <form action="javascript:void(0)">
                                                    <textarea name="massage" cols="10" rows="4" class="pregunta"></textarea>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="review-form-button">
                                            <a href="javascript:void(0)" class="PreguntarButton">Preguntar</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="Preguntas">
                                    <div class="valu">
										<div id="preguntasContainer">

										</div>

										<div >
											<ul id="preguntasPag" style="display: flex; justify-content: end; margin-top: 1rem;">
												<li id="Anterior" style="margin-right: .6rem;"></li>
												<li id="Siguiente"></li>
											</ul>
										</div>
                                    </div>
                                </div>

                            </div>
						</div>


						@php
							$promocion = Promocions::where([
								['status', '=', '{"en":"0","es":"1"}'],
								['seccion', '=', '2'],

							])
							->orWhere([
								['status', '=', '{"en":"0","es":1}'],
								['seccion', '=', '2'],
							])->first();

							$lrec = [];
							$lpri = [];
							$ldesc = [];
							if($promocion != null){
								$lrec = explode(',', $promocion->books_isbns);
								$lpri = explode(',', $promocion->books_prices);
								$ldesc = explode(',', $promocion->books_desc);
							}

							$i = 0;
						@endphp

						<!-- product-info-area-end -->
						<!-- new-book-area-start -->
						<div class="new-book-area mt-60">
							<div class="section-title text-center mb-30">
								<h3>Libros recomendados</h3>
							</div>
							<div class="tab-active-2 owl-carousel">
								<!-- single-product-start -->

								@foreach($lrec as $l)
								@php
									$book = Books::where('isbn', $l)->first();
									if($book == null){
										break;
									}

									$precioDescuento = (int)($book->price) - ((int)($book->price) * (int)($ldesc[$i]) / 100)
								@endphp
								<div class="product-wrapper">
									<div class="product-img" style="min-width:205px; min-height:290px;">
										<a href="/es/libro/{{$book->isbn}}">
											<img src="/img/covers/{{$book->isbn1}}.jpg" alt="book" class="primary" style="min-width:205px; min-height:290px; object-fit:cover;"/>
										</a>
										<div class="quick-view">
                                    	<a class="action-view" onclick="openProductModal('{{$book->isbn}}')" data-target="#productModal" data-toggle="modal" title="Quick View">

                                                <i class="fa fa-search-plus"></i>
                                            </a>
                                        </div>
									</div>
									<div class="product-details text-center">
										<h4><a href="/es/libro/{{$book->isbn}}">{{$book->title}}</a></h4>
										<div class="product-price">
											<ul>
												@if((int)($precioDescuento) != (int)($book->price))
													<li>${{$precioDescuento}}</li>
                                                	<li class="old-price">${{$book->price}}</li>
												@else
													<li>${{$book->price}}</li>
												@endif
											</ul>
										</div>
									</div>
									<div class="product-link">
										<div class="product-button">
											<a onclick="sendToCart('{{$book->isbn}}')" style="cursor: pointer;" title="Add to cart" class="product-button-a" id="promo_{{$book->isbn1}}"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>

										</div>
										<div class="add-to-link">
                                            <ul>
											@if(!empty($book))
                                            	<li><a  href="/es/libro/{{$book->isbn}}" title="Details"><i class="fa fa-external-link"></i></a></li>
                                        	@endif
                                            </ul>
                                        </div>
									</div>
								</div>
								@php
								$i++;
								@endphp
								@endforeach
								<!-- single-product-end -->
							</div>
						</div>
						<!-- new-book-area-start -->
					</div>
					<div class="col-lg-3 col-md-12 col-12 order-lg-2 order-2">
						<div class="shop-left">
							<div class="left-title mb-20">
								<h4>Otros productos</h4>
							</div>

							@php
								$index = 0;
								$productosRelacionados = Books::all()->random(20);
							@endphp

							<div class="random-area mb-30">
								<div class="product-active-2 owl-carousel">
									@for ($i = 0;  $i<round(count($productosRelacionados)/3); $i++)

										<div class="product-total-2">

										@for($j = 0; $j<3; $j++)
											@if($index == count($productosRelacionados))
												@break
											@endif
											@php
												$tempBook = $productosRelacionados[$index];
											@endphp
											<div class="single-most-product bd mb-18">
												<div class="most-product-img">
													<a href="/es/libro/{{$tempBook->isbn}}"><img src="/img/covers/{{$tempBook->isbn1}}.jpg" alt="book" style="
														min-width: 64px;
														min-height: 97px;
														max-width: 64px;
														max-height: 97px;
														object-fit: cover;" /></a>
												</div>
												<div class="most-product-content">
													<!--<div class="product-rating">
														<ul>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
														</ul>
													</div>-->
													<h4><a href="/es/libro/{{$tempBook->isbn}}">{{$tempBook->title}}</a></h4>
													<div class="product-price">
														<ul>
															<li>${{$tempBook->price}} ars</li>
															<!--<li class="old-price">$33.00</li>-->
														</ul>
													</div>
												</div>
											</div>

											@php
												$index++;
											@endphp
										@endfor



											<!--<div class="single-most-product bd mb-18">
												<div class="most-product-img">
													<a href="#"><img src="/res_es/img/product/21.jpg" alt="book" /></a>
												</div>
												<div class="most-product-content">
													<div class="product-rating">
														<ul>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
														</ul>
													</div>
													<h4><a href="#">Savvy Shoulder Tote</a></h4>
													<div class="product-price">
														<ul>
															<li>$30.00</li>
															<li class="old-price">$35.00</li>
														</ul>
													</div>
												</div>
											</div>

											<div class="single-most-product">
												<div class="most-product-img">
													<a href="#"><img src="/res_es/img/product/22.jpg" alt="book" /></a>
												</div>
												<div class="most-product-content">
													<div class="product-rating">
														<ul>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
														</ul>
													</div>
													<h4><a href="#">Compete Track Tote</a></h4>
													<div class="product-price">
														<ul>
															<li>$35.00</li>
														</ul>
													</div>
												</div>
											</div>-->
										</div>

									@endfor



									<!--<div class="product-total-2">
										<div class="single-most-product bd mb-18">
											<div class="most-product-img">
												<a href="#"><img src="/res_es/img/product/23.jpg" alt="book" /></a>
											</div>
											<div class="most-product-content">
												<div class="product-rating">
													<ul>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
													</ul>
												</div>
												<h4><a href="#">Voyage Yoga Bag</a></h4>
												<div class="product-price">
													<ul>
														<li>$30.00</li>
														<li class="old-price">$33.00</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="single-most-product bd mb-18">
											<div class="most-product-img">
												<a href="#"><img src="/res_es/img/product/24.jpg" alt="book" /></a>
											</div>
											<div class="most-product-content">
												<div class="product-rating">
													<ul>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
													</ul>
												</div>
												<h4><a href="#">Impulse Duffle</a></h4>
												<div class="product-price">
													<ul>
														<li>$70.00</li>
														<li class="old-price">$74.00</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="single-most-product">
											<div class="most-product-img">
												<a href="#"><img src="/res_es/img/product/22.jpg" alt="book" /></a>
											</div>
											<div class="most-product-content">
												<div class="product-rating">
													<ul>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
													</ul>
												</div>
												<h4><a href="#">Fusion Backpack</a></h4>
												<div class="product-price">
													<ul>
														<li>$59.00</li>
													</ul>
												</div>
											</div>
										</div>
									</div>-->
								</div>
							</div>

							@php
							$publicidad = (Publicidades::where([
								['pagina', '=', 'libro'],
							]
							)->get());

							$publi = null;
							foreach($publicidad as $p){
								if($p->status == 1 || $p->status == "1"){
									$publi = $p;
									break;
								}
								else {

								}
							}

							if(isset($publi->files)){
								$publiImage = '/storage/' . $publi->files[0]->path ?? null;
							}
						@endphp
							@if(isset($publi) && $publi != null)

							<div class="banner-area mb-30">
								<div class="banner-img-2">
									<a href="{{$publi->link}}" style="
									">

									@if($publiImage != null)
										<img src="{{$publiImage}}" alt="banner" /></a>
									@endif
								</div>
							</div>

							@endif
							<!--<div class="left-title-2 mb-30">
								<h2>Compare Products</h2>
								<p>You have no items to compare.</p>
							</div>
							<div class="left-title-2">
								<h2>My Wish List</h2>
								<p>You have no items in your wish list.</p>
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- product-main-area-end -->
		<!-- footer-area-start -->

		@include('pages::public.components.footer');

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

		<script type="text/javascript"> </script>
		<script src="/js/NotificationController.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

		<script>
			var libro = '{!! json_encode($libro) !!}';
			libro = JSON.parse(libro);
			document.querySelector('.PreguntarButton').addEventListener('click', (event) => {
				axios.post('/admin/preguntas/guardar', {body: document.querySelector('.pregunta').value, publicacion:window.location.href, libro:libro.isbn}).then((response) => {
					//
					if(response.data.message != null) {
						show(response.data.message);
					}
					else {
						show('Pregunta realizada');
						window.location.href = window.location.href;
					}
				});
			});


			///////////////////////////////////////////////////////////////////////////////////////////
			var preguntas = null;
			var paginapreguntas = 1;
			var totalPaginas = 0;

			borrar();
			popular();

			function borrar() {
				$('#preguntasContainer').empty();
				$('#Anterior').empty();
				$('#Siguiente').empty();
			}

			function popular() {
					preguntas = null;

					axios.post('/api/preguntas/get/pub', {publicacion: window.location.href, pagina:paginapreguntas}).then((response)=> {
						preguntas = response.data;
						console.log(response);

						preguntas.sinResponder.data.map((pregunta) => {
							var localhtml = `
								<div>
									<div style="border: 1px solid #9b9b9b; border-radius: 5px; padding: 1rem 0.5rem 0;">
										<div style="display:flex; flex-direction:row;">
											<p>${pregunta.body.es}</p> <p style="font-weight: bold; margin-left:.2rem;">- ${pregunta.Nombre_y_apellido}</p>
										</div>
										<div style="display:flex; flex-direction:row;">
											<p>Tu pregunta sera respondida en la brevedad.</p> <p style="font-weight: bold; margin-left:.2rem;">- Administración</p>
										</div>
									</div>
								</div>
							`;
							$('#preguntasContainer').append(localhtml);
						});
						preguntas.contestadas.data.map((pregunta) => {

							var localhtml = `
								<div>
									<div style="border: 1px solid #9b9b9b; border-radius: 5px; padding: 1rem 0.5rem 0;">
										<div style="display:flex; flex-direction:row;">
											<p>${pregunta.body.es}</p> <p style="font-weight: bold; margin-left:.2rem;">- ${pregunta.Nombre_y_apellido}</p>
										</div>
										<div style="display:flex; flex-direction:row;">
											<p>${JSON.parse(pregunta.respuestas).es}</p> <p style="font-weight: bold; margin-left:.2rem;">- Administración</p>
										</div>
									</div>
								</div>
							`;
							$('#preguntasContainer').append(localhtml);

						});

						totalPaginas = preguntas.totalPaginas;
						if(paginapreguntas >1) {
							$('#Anterior').append(`
								<a href="javascript:void(0)" id="AnteriorA">Anterior</a>
							`);

							document.querySelector("#AnteriorA").addEventListener('click', ()=> {
								paginapreguntas--;
								borrar();
								popular();
							});
						}
						else {
							$('#Anterior').empty();
						}

						if(paginapreguntas < totalPaginas-1) {
							$('#Siguiente').append(`
								<a href="javascript:void(0)" id="SiguienteA">Siguiente</a>
							`);

							document.querySelector("#SiguienteA").addEventListener('click', ()=> {
								paginapreguntas++;
								borrar();
								popular();
							});
						}
						else {
							$('#Siguiente').empty();
						}



					});
			}

		</script>

	</body>
</html>
