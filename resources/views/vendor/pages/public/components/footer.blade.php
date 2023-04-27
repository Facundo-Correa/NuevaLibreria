<footer>
            <!-- footer-top-start -->
            <div class="footer-top">

                <div class="banner-area banner-res-large pt-30 pb-5">
                    @php
                        $col_1 = Features::select('*')->where([['status','=', '{"en":"0","es":"1"}'], ['indice', '=', '0']])
                        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '0']])->first();

                        $col_2 = Features::select('*')->where([['status','=', '{"en":"0","es":"1"}'], ['indice', '=', '1']])
                        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '1']])->first();

                        $col_3 = Features::select('*')->where([['status','=', '{"en":"0","es":"1"}'], ['indice', '=', '2']])
                        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '2']])->first();

                        $col_4 = Features::select('*')->where([['status','=', '{"en":"0","es":"1"}'], ['indice', '=', '3']])
                        ->orWhere([['status', '=', '{"en":"0","es":1}'], ['indice', '=', '3']])->first();
                    @endphp

                    <div class="container">
                        <div class="row">
                            @if($col_1)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-banner mb-30">
                                    <div class="banner-img">
                                        <a href="#"><img src="/res_es/img/banner/1.png" alt="banner" /></a>
                                    </div>
                                    <div class="banner-text">
                                        <h4 style="color:white;">{{$col_1->titulo}}</h4>
                                        <p style="color:white;">{{$col_1->descripcion}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($col_2)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-banner mb-30">
                                    <div class="banner-img">
                                        <a href="#"><img src="/res_es/img/banner/2.png" alt="banner" /></a>
                                    </div>
                                    <div class="banner-text">
                                        <h4 style="color:white;">{{$col_2->titulo}}</h4>
                                        <p style="color:white;">{{$col_2->descripcion}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($col_3)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-banner mb-30">
                                    <div class="banner-img">
                                        <a href="#"><img src="/res_es/img/banner/3.png" alt="banner" /></a>
                                    </div>
                                    <div class="banner-text">
                                        <h4 style="color:white;">{{$col_3->titulo}}</h4>
                                        <p style="color:white;">{{$col_3->descripcion}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($col_4)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-banner mb-30">
                                    <div class="banner-img">
                                        <a href="#"><img src="/res_es/img/banner/4.png" alt="banner" /></a>
                                    </div>
                                    <div class="banner-text">
                                        <h4 style="color:white;">{{$col_4->titulo}}</h4>
                                        <p style="color:white;">{{$col_4->descripcion}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
<!--
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-top-menu bb-2">
                                <nav>
                                    <ul>
                                        <li><a href="#">home</a></li>
                                        <li><a href="#">Enable Cookies</a></li>
                                        <li><a href="#">Privacy and Cookie Policy</a></li>
                                        <li><a href="#">contact us</a></li>
                                        <li><a href="#">blog</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             footer-top-start -->
            <!-- footer-mid-start -->
            <div class="footer-mid ptb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">


                            <div class="col-lg-4 col-md-4 col-12 footer-item">
                                <div class="single-footer br-2 xs-mb">
                                    <div class="footer-title mb-20">
                                        <h3>Atención</h3>
                                    </div>
                                    <div class="footer-mid-menu">
                                        <ul>

                                        <li><a href="javascript:void(0);">Estados Unidos 301 | 4362-9266</a></li>
                                        <li><a href="javascript:void(0);">Medrano 951 | 4867-2772 </a></li>
                                        <li><a href="javascript:void(0);">Mozart 2300 | 4602-4020 </a></li>
                                        <li><a href="javascript:void(0);">San Vicente 206 | 4206-9068 </a></li>
                                        <li><p>Lunes a viernes de 9:00 a 19:00 </p></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12 footer-item">
                                <div class="single-footer br-2 xs-mb">
                                    <div class="footer-title mb-20">
                                        <h3>Mi cuenta</h3>
                                    </div>
                                    

                                    @if(isset(Auth::user()->id))
                                    <div class="footer-mid-menu">
                                        <ul>
                                            <li><a href="javascript:void(0);">Informacion personal</a></li>
                                            <li><a href="javascript:void(0);">Mis compras</a></li>
                                        </ul>
                                    </div>
                                    @else
                                    <div class="footer-mid-menu">
                                        <ul>
                                            <li><a href="/es/iniciar-sesion">Informacion personal</a></li>
                                            <li><a href="/es/iniciar-sesion">Mis compras</a></li>
                                        </ul>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12 footer-item" style="padding: 0; border:none;">
                                <div class="single-footer br-2 xs-mb">
                                    <div class="footer-title mb-20">
                                        <h3>Data fiscal</h3>
                                    </div>
                                    <div class="footer-mid-menu">
                                        <ul>
                                            <li><a href="http://qr.afip.gob.ar/?qr=pHqoNsGEpmFvQEU_5ryArA,,"><img style="width: 85px; max-width: 100%; height: auto;" src="/res_es/img/DATAWEB.jpg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>

                        {{--<div class="col-lg-4 col-md-4 col-12 footer-item">
                            <div class="single-footer br-2 xs-mb">
                                <div class="footer-title mb-20">
                                    <h3>Nuestras redes</h3>
                                </div>
                                <div class="footer-contact">
                                    <p class="adress">
                                        <span>My Company</span>
                                        Your address goes here.
                                    </p>
                                    <p><span>Call us now:</span> 0123456789</p>
                                    <p><span>Email:</span> demo@example.com</p>
                                </div>
                            </div>
                        </div>--}}

                    </div>
                </div>
            </div>
            <!-- footer-mid-end -->
            <!-- footer-bottom-start -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row bt-2">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="copy-right-area">
                                <p>&copy; 2021 made by<strong> <a href="https://www.trememote.com.ar/">Trememote </strong></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom-end -->
        </footer>
