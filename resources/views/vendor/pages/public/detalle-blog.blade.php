<!doctype html>
<html class="no-js" lang="zxx">
@if($post)
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	@if($post)
	<title>Nueva Libreria – {{$post->title}}</title>
	@endif
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

<body class="blog-details">
	@include('pages::public.components.barra')
	<div class="breadcrumbs-area mb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumbs-menu">
						<ul>
							<li><a href="#">Nueva Libreria</a></li>
							<li><a href="#" class="active">{{$post->title}}</a></li>
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
				<div class="col-lg-3 col-md-12 col-12 order-lg-1 order-2 mt-sm-50">
					<div class="single-blog mb-50">
						<div class="blog-left-title">
							<h3>Buscar en el blog</h3>
						</div>
						<div class="side-form">
							<form action="#">
								<input type="text" placeholder="Buscar...." />
								<a href="#"><i class="fa fa-search"></i></a>
							</form>
						</div>
					</div><!--
					<div class="single-blog mb-50">
						<div class="blog-left-title">
							<h3>Categories</h3>
						</div>
						<div class="blog-side-menu">
							<ul>
								<li><a href="#">Creative (2)</a></li>
								<li><a href="#">Fashion (1)</a></li>
								<li><a href="#">Image (1) </a></li>
								<li><a href="#">Photography (1) </a></li>
								<li><a href="#">Travel (4) </a></li>
								<li><a href="#">Videos (2) </a></li>
								<li><a href="#">Economic (2) </a></li>
							</ul>
						</div>
					</div>
					<div class="single-blog mb-50">
						<div class="blog-left-title">
							<h3>Recent Posts</h3>
						</div>
						<div class="blog-side-menu">
							<ul>
								<li><a href="#">Blog image post</a></li>
								<li><a href="#">Post with Gallery</a></li>
								<li><a href="#">Post with audio</a></li>
								<li><a href="#">Post with vedio</a></li>
								<li><a href="#">Post with image</a></li>
							</ul>
						</div>
					</div>
					<div class="single-blog mb-50">
						<div class="blog-left-title">
							<h3>Recent Comments</h3>
						</div>
						<div class="blog-side-menu">
							<ul>
								<li><a href="#">admin on Maecenas ultricies</a></li>
								<li><a href="#">admin on Tincidunt malesuada</a></li>
								<li><a href="#">admin on Rhoncus eleifend</a></li>
								<li><a href="#">admin on Quisque fringilla</a></li>
								<li><a href="#">admin on Pellentesque posuere</a></li>
							</ul>
						</div>
					</div>
					<div class="single-blog mb-50">
						<div class="blog-left-title">
							<h3>Archive</h3>
						</div>
						<div class="blog-side-menu">
							<ul>
								<li><a href="#"><i class="fa fa-calendar-o"></i>March 2016 (1)</a></li>
								<li><a href="#"><i class="fa fa-calendar-o"></i>April 2016 (2)</a></li>
								<li><a href="#"><i class="fa fa-calendar-o"></i>May 2016 (3)</a></li>
								<li><a href="#"><i class="fa fa-calendar-o"></i>June 2016 (4)</a></li>
								<li><a href="#"><i class="fa fa-calendar-o"></i>July 2016 (5)</a></li>
								<li><a href="#"><i class="fa fa-calendar-o"></i>August 2016 (6)</a></li>
							</ul>
						</div>
					</div>
					<div class="single-blog mb-50">
						<div class="blog-left-title">
							<h3>Blog Archive</h3>
						</div>
						<div class="catagory-menu" id="cate-toggle">
							<ul>
								<li><a href="#">Creative</a></li>
								<li><a href="#">Fashion</a></li>
								<li><a href="#">Image</a></li>
								<li><a href="#">Class Master</a></li>
								<li><a href="#">Travel</a></li>
								<li><a href="#">Video</a></li>
								<li><a href="#">Wordpress</a></li>
							</ul>
						</div>
					</div>
					<div class="single-blog">
						<div class="blog-left-title">
							<h3>Tags</h3>
						</div>
						<div class="blog-tag">
							<ul>
								<li><a href="#">Asian</a></li>
								<li><a href="#">Brown</a></li>
								<li><a href="#">Euro</a></li>
								<li><a href="#">Fashion</a></li>
								<li><a href="#">Franch</a></li>
								<li><a href="#">Hat</a></li>
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Teen</a></li>
								<li><a href="#">Travel</a></li>
								<li><a href="#">White</a></li>
							</ul>
						</div>
					</div>-->
				</div>
				<div class="col-lg-9 col-md-12 col-12 order-lg-2 order-1">
					<div class="blog-main-wrapper">
						<div class="author-destils mb-30">
							<div class="author-left">
								<!--<div class="author-img">
									<a href="#"><img src="/res_es/img/author/1.jpg" alt="man" /></a>
								</div>-->
								<div class="author-description">
									<p>Escrito por:
										<a href="#"><span>{{$post->creado_por}}</span></a>
										
									</p>
									<span>{{$post->created_at}}</span>
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
							@php
								$image_path = '';
								$actual_image = $post->image->name ?? 'img/blog/1.jpg';
								$image_path = ($actual_image != 'img/blog/1.jpg') ? '/storage/files/' . $actual_image : '/res_es/img/blog/1.jpg'

							@endphp
						<div class="blog-img mb-30">
							<img src="{{$image_path}}" alt="blog" />
						</div>
						<div class="single-blog-content">
							<div class="single-blog-title">
								<h3>{{$post->title}}</h3>
							</div>
							<br/>
							<br/>
							<br/>
							<div class="blog-single-content">
								<p>{!! $post->body !!}</p>
							</div>
						</div>
						<!--
						<div class="comment-tag">
							<p>03 Comments/Tags: Asian, t-shirt, teen </p>
						</div>
						<div class="sharing-post mt-20">
							<div class="share-text">
								<span>Share this post</span>
							</div>
							<div class="share-icon">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="comment-title-wrap mt-30">
							<h3>03 Comments</h3>
						</div>
						<div class="comment-reply-wrap mt-50">
							<ul>
								<li>
									<div class="public-comment">
										<div class="comment-img">
											<a href="#"><img src="/res_es/img/author/2.jpg" alt="man" /></a>
										</div>
										<div class="public-text">
											<div class="single-comm-top">
												<a href="#">Scott Salwolke</a>
												<p>March 08, 2017 at 1:38 am <a href="#">Reply</a></p>
											</div>
											<p>Thanks Marcus for the suggestions. I hadn't given much thought in how to craft my own blog entries in order to encourage responses. Yet, the goal is to generate followers and develop interactions so this makes perfect sense. I'll definitely incorporate some of these suggestions into my future writings.</p>
										</div>
									</div>
								</li>
								<li>
									<div class="public-comment public-comment-2">
										<div class="comment-img">
											<a href="#"><img src="/res_es/img/author/3.jpg" alt="man" /></a>
										</div>
										<div class="public-text">
											<div class="single-comm-top">
												<a href="#">Scott Salwolke</a>
												<p>March 08, 2017 at 1:38 am <a href="#">Reply</a></p>
											</div>
											<p>Thanks Marcus for the suggestions. I hadn't given much thought in how to craft my own blog entries in order to encourage responses. Yet, the goal is to generate followers and develop interactions so this makes perfect sense. I'll definitely incorporate some of these suggestions into my future writings.</p>
										</div>
									</div>
								</li>
								<li>
									<div class="public-comment public-comment-2">
										<div class="comment-img">
											<a href="#"><img src="/res_es/img/author/4.jpg" alt="man" /></a>
										</div>
										<div class="public-text">
											<div class="single-comm-top">
												<a href="#">Scott Salwolke</a>
												<p>March 08, 2017 at 1:38 am <a href="#">Reply</a></p>
											</div>
											<p>Thanks Marcus for the suggestions. I hadn't given much thought in how to craft my own blog entries in order to encourage responses. Yet, the goal is to generate followers and develop interactions so this makes perfect sense. I'll definitely incorporate some of these suggestions into my future writings.</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="comment-title-wrap mt-30">
							<h3>Leave a comment </h3>
						</div>
						<div class="comment-input mt-40">
							<p>We will not publish your email address. Required fields are marked*</p>
							<div class="comment-input-textarea mb-30">
								<form action="#">
									<label>Comment</label>
									<textarea name="massage" cols="30" rows="10" placeholder="Write your comment here"></textarea>
								</form>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="single-comment-input mb-30">
										<form action="#">
											<label>Name*</label>
											<input type="text" placeholder="Name" />
										</form>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="single-comment-input mb-30">
										<form action="#">
											<label>Email*</label>
											<input type="text" placeholder="Email" />
										</form>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="single-comment-input mb-30">
										<form action="#">
											<label>Web</label>
											<input type="text" placeholder="Put your web address" />
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="single-post-button">
							<a href="#">Post Comment</a>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('pages::public.components.footer')
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
@endif
</html>