@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Про нас
                    </h1>
                    <p class="text-white link-nav"><a href="/">Головна </a> <span
                            class="lnr lnr-arrow-right"></span> <a href="javasript:;"> Про нас</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start feature Area -->
    <section class="feature-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title unpointer">
                            <h4>Загальна інформація</h4>
                        </div>
                        <div class="desc-wrap unpointer">
                            <ul class="about-us-submenu">
                                <li><a href="/about-us/general-info">Загальна інформація</a></li>
                                <li><a href="/about-us/branches">Філії АВП</a></li>
                                <li><a href="/about-us/firms">Пропозиції для підприємств і фірм АВП</a></li>
                                <li><a href="/about-us/international-relations">Міжнародні зв'язки АВП</a></li>
                                <li><a href="/about-us/history">Історія кафедри</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title unpointer">
                            <h4>Навчання</h4>
                        </div>
                        <div class="desc-wrap unpointer">
                            <ul class="about-us-submenu">
                                <li><a href="/about-us/material-base">Матеріальна база</a></li>
                                <li><a href="/about-us/science-work">Наукова робота</a></li>
                                <li><a href="/about-us/practic">Програми практичної підготовки</a></li>
                                <li><a href="/about-us/department-composition">Склад кафедри</a></li>
                                <li><a href="/about-us/nvk">Склад НВК кафедри</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title unpointer">
                            <h4>Спеціальності</h4>
                        </div>
                        <div class="desc-wrap unpointer">
                            <ul class="about-us-submenu">
                                <li><a href="/about-us/branch-app">Автоматизація та комп'ютерно-інтегровані технології</a></li>
                                <li><a href="/about-us/branch-medical">Медичні системи, прилади та мікросхемотехніка</a></li>
                                <li><a href="/about-us/branch-network">Комп’ютерні системи та мережі</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title unpointer">
                            <h4>Життя кафедри</h4>
                        </div>
                        <div class="desc-wrap unpointer" style="">
                            <ul class="about-us-submenu">
                                <li><a href="/about-us/life">Студентське життя АВП</a></li>
                                <li><a href="/news">Новини</a></li>
                                <li><a href="/event">Подіі</a></li>
                                <li><a href="/album">Галерея</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End feature Area -->

    <!-- Start info Area -->
    <section class="info-area pb-120">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 no-padding info-area-left">
                    <img class="img-fluid" src="img/about1.jpg" alt="">
                </div>
                <div class="col-lg-6 info-area-right">
                    <h2>{{ include_page_header('about-us-use-specialist') }}</h2>
                    <br>
                    {!! include_page_content('about-us-use-specialist') !!}
                </div>
            </div>
        </div>
    </section>
    <!-- End info Area -->

    <!-- Start course-mission Area -->
    <section class="course-mission-area pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h2 class="mb-10">{{ include_page_header('about-us-posts') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 accordion-left">
                    {!! include_page_content('about-us-posts') !!}
                </div>
                <div class="col-md-6 justify-content-center align-items-center d-flex relative">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/rchad-V0jfE" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- End course-mission Area -->

    <!-- Start info Area -->
    <section class="info-area pb-120">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 no-padding info-area-left">
                    <img class="img-fluid" src="img/about2.jpg" alt="">
                </div>
                <div class="col-lg-6 info-area-right">
                    <h2>{{ include_page_header('about-us-knowledge') }}</h2>
                    <br>
                    {!! include_page_content('about-us-knowledge') !!}
                </div>
            </div>
        </div>
    </section>
    <!-- End info Area -->

    <div class="container">
        <div class="section-top-border">
            <h3 class="mb-30">{{ include_page_header('about-us-work') }}</h3>
            <div class="row">
                <div class="col-lg-12">
                    {!! include_page_content('about-us-work') !!}
                </div>
            </div>
        </div>
    </div>


    <!-- Start search-course Area -->
    @component('components.feedback-section')
    @endcomponent
    <!-- End search-course Area -->

    <!-- Start review Area -->
{{--    <section class="review-area section-gap relative">--}}
{{--        <div class="overlay overlay-bg"></div>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="active-review-carusel">--}}
{{--                    <div class="single-review item">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Fannie Rowe</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="single-review item">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Hulda Sutton</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="single-review item">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Fannie Rowe</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="single-review item">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Hulda Sutton</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="single-review item">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Fannie Rowe</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="single-review item">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Hulda Sutton</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="single-review item">--}}
{{--                        <img src="img/r1.png" alt="">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Fannie Rowe</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="single-review item">--}}
{{--                        <div class="title justify-content-start d-flex">--}}
{{--                            <a href="#"><h4>Hulda Sutton</h4></a>--}}
{{--                            <div class="star">--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star checked"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                                <span class="fa fa-star"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p>--}}
{{--                            Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
{{--                            scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
{{--                            printer, scanner, speaker.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- End review Area -->

    <!-- Start cta-two Area -->
    <section class="cta-two-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 cta-left">
                    <h1>Цікавить як поступити до кафедри?</h1>
                </div>
                <div class="col-lg-4 cta-right">
                    <a class="primary-btn wh" href="/applicants">Це просто! Дивись..</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End cta-two Area -->
@endsection
