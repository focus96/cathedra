<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Site Title -->
    <title>{{ env('APP_NAME', 'АВП | Кафедра автоматизації виробничих процесів') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <script src="{{ asset('js/app.js') }}"></script>

    <link rel="stylesheet" href="/css/linearicons.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/css/nice-select.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/core.css">
    <script src="/js/vendor/jquery-2.2.4.min.js"></script>
</head>
<body>
<header id="header">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
                    <ul>
                        <li><a href="https://www.facebook.com/DonbaskaDerzavnaMasinobudivnaAkademia/?rf=106994689348589"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/dgma_donetsk_ua"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="http://www.dgma.donetsk.ua/kodeks-chesti.html"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
                    <a href="tel:(0626) 41-69-84"><span class="lnr lnr-phone-handset"></span> <span class="text">(0626) 41-69-84</span></a>
                    <a href="mailto:app@dgma.donetsk.ua"><span class="lnr lnr-envelope"></span> <span class="text">app@dgma.donetsk.ua</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="/">
                    <img src="/img/logo1.png" alt="" title=""/></a>
            </div>
            <nav id="nav-menu-container" >
                <style>
                    .nav-menu li{
                        background-color: transparent;
                    }
                </style>
                <ul class="nav-menu">
                    <li ><a href="/">Головна</a></li>
                    <li><a href="/about">Про нас</a></li>
                    <li ><a href="">Студентам</a>
                        <ul class="nav-menu">
                            <li ><a href="/schedule/by-lecture-hall">Розклад</a></li>
                            <li ><a href="{{ route('curators-index') }}">Кураторы</a></li>
                        </ul>
                    </li>
                    <li><a href="/event">Події</a></li>
                    <li><a href="/album">Галерея</a></li>
                    <li><a href="/news">Новини</a></li>
                    <li><a href="/contact">Контакти</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header><!-- #header -->
@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif
@yield('content')

<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>О нас</h4>
                    <ul>
                        <li><a href="#">Общая информация</a></li>
                        <li><a href="#">Бакалавриат</a></li>
                        <li><a href="#">Магистратура</a></li>
                        <li><a href="#">Материальная база</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Абитуриентам</h4>
                    {{--<ul>--}}
                        {{--<li><a href="#">Jobs</a></li>--}}
                        {{--<li><a href="#">Brand Assets</a></li>--}}
                        {{--<li><a href="#">Investor Relations</a></li>--}}
                        {{--<li><a href="#">Terms of Service</a></li>--}}
                    {{--</ul>--}}
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Студентам</h4>
                    <ul>
                        <li><a href="#">Методические указания</a></li>
                        <li><a href="#">Список кураторов</a></li>
                        <li><a href="#">Учебные планы</a></li>
                        <li><a href="#">Расспиание занятий</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Медиа</h4>
                    <ul>
                        <li><a href="/news">Блог</a></li>
                        <li><a href="/event">События</a></li>
                        <li><a href="/album">Галерея</a></li>
                    </ul>
                </div>
            </div>
            <div id="email-subscriber-footer" class="col-lg-4  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h4>Подписка</h4>
                    <p>Будьте в курсе последних наших новостей</p>
                    <div class="" id="mc_embed_signup">
                        <form target="_blank"
                              action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                              method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Введите Email"
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Введите Email '" required="" type="email" v-model="email">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button" @click="subscribe()">
                                        <span class="lnr lnr-arrow-right"></span>
                                    </button>
                                </div>
                                <div class="info">
                                    @component('components.email-subscribe-messages')
                                    @endcomponent
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom row align-items-center justify-content-between">
            <p class="footer-text m-0 col-lg-6 col-md-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                        href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            <div class="col-lg-6 col-sm-12 footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-behance"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- End footer Area -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="/js/easing.min.js"></script>
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>
<script src="/js/jquery.ajaxchimp.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/jquery.tabs.min.js"></script>
<script src="/js/jquery.nice-select.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/mail-script.js"></script>
<script src="/js/main.js"></script>
<script src="/js/app.js"></script>


@stack('scripts')
</body>
</html>
