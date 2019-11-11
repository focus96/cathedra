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
                <div class="col-lg-8">
                    <form class="form-area contact-form text-center" id="myForm" action="mail.php" method="post">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <h5>Юридичні підстави для здійснення освітньої діяльності:</h5>
                                <p>
                                    Ліцензія на надання освітніх послуг навчальними закладами, пов’язаних із одержанням
                                    вищої освіти на рівні кваліфікаційних
                                    вимог до молодшого спеціаліста, бакалавра, спеціаліста, магістра (у т. ч. для
                                    іноземних громадян) серія АЕ №636131 від 15.04.2015 р.
                                </p>
                            </div>

                            <div class="col-md-12">
                                <div style="width: 100%"><iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;coord=48.73352130451414, 37.57594585418702&amp;q=Kramators%E2%80%99k%2C%20bul.%20Mashinobudivnykiv%2C%2039%2C%20DSEA%2C%202nd%20bld+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/coordinates.html">find my coordinates</a></iframe></div><br />
                         </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <h4>ПРИЙМАЛЬНА КОМІСІЯ</h4>
            </div>
            <div class="row">
                <p>ДДМА, м. Краматорськ, б-р Машинобудівників, 39 (2-й корпус), ауд. 2214</p>
            </div>
        </div>
    </section>
    <!-- End contact-page Area -->
@endsection
