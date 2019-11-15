@extends('layouts.app')

@section('content')
    <style>
        .banner-area {
            background: url(../img/baner2.jpg) right;
        }
    </style>
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Контакти
                    </h1>
                    <p class="text-white link-nav"><a href="/">Головна</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start contact-page Area -->
    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 d-flex flex-column address-wrap">
                    <div class="mb-4">
                        <h3 class="text-center">Кафедра АВП</h3>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-home"></span>
                        </div>
                        <div class="contact-details">
                            <h5> м. Краматорськ, б-р Машинобудівників, 39</h5>
                            <p>
                                корп. 2, ауд. 2212 (каф. АВП)
                            </p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-phone-handset"></span>
                        </div>
                        <div class="contact-details">
                            <h5>(0626) 41-69-84</h5>
                            <h5>(099) 094-97-27</h5>
                            <h5>(067) 628-39-89</h5>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-envelope"></span>
                        </div>
                        <div class="contact-details">
                            <h5>E-mail: app@dgma.donetsk.ua</h5>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 d-flex flex-column address-wrap">
                    <div class="mb-4">
                        <h3 class="text-center">Приймальна комiсiя</h3>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-home"></span>
                        </div>
                        <div class="contact-details">
                            <h5> м. Краматорськ,
                                б-р Машинобудівників, 39 </h5>
                            <p>
                                корп. 2, ауд. 2214
                            </p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-phone-handset"></span>
                        </div>
                        <div class="contact-details">
                            <h5>+38(0626)41-69-38</h5>
                            <h5>+38(066)051-74-89</h5>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-envelope"></span>
                        </div>
                        <div class="contact-details">
                            <h5>E-mail: pk@dgma.donetsk.ua</h5>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 d-flex flex-column address-wrap">
                    <div class="mb-4">
                        <h3 class="text-center">ДДМА</h3>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-home"></span>
                        </div>
                        <div class="contact-details">
                            <h5> м. Краматорськ, вул. Академічна (Академічна), 72</h5>
                            <p>
                                84313, Донецька обл.

                            </p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-phone-handset"></span>
                        </div>
                        <div class="contact-details">
                            <h5>тел.: (0626) 41-68-09, (0626) 41-80-68</h5>
                            <p>факс: (0626) 41-63-15, (0626) 41-66-76</p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-envelope"></span>
                        </div>
                        <div class="contact-details">
                            <h5>E-mail: dgma@dgma.donetsk.ua</h5>
                            <p>Web: <a href="http://www.dgma.donetsk.ua">http://www.dgma.donetsk.ua</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End contact-page Area -->
@endsection
