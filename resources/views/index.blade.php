@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="banner-area relative" id="home">
        <style>
            .banner-area {
                background: url(../img/baner.jpg) right;
            }
        </style>
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-between">
                <div class="banner-content col-lg-9 col-md-12">
                    <h1 class="text-uppercase">
                        АВП - автоматизація виробничих процесів.
                    </h1>
                    <p class="pt-10 pb-10">
                        Кафедра пропонує підготовку за двома напрямами: автоматізація виробничих процессів
                        та комп'ютрна інженерія.
                    </p>
                    <a href="#" class="primary-btn text-uppercase">Детальніше</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start feature Area -->
    <section class="feature-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Новини</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                Usage of the Internet is becoming more common due to rapid advancement
                                of technology.
                            </p>
                            <a href="/news">Перейти</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Події</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                For many of us, our very first experience of learning about the celestial bodies begins
                                when we saw our first.
                            </p>
                            <a href="/event">Перейти</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Галерея</h4>
                        </div>
                        <div class="desc-wrap">
                            <p>
                                If you are a serious astronomy fanatic like a lot of us are, you can probably remember
                                that one event.
                            </p>
                            <a href="/album">Перейти</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End feature Area -->

    <!-- Start popular-course Area -->
    <section class="popular-course-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Популярні новини</h1>
                        <p>Це може бути цікаво вам:</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="active-popular-carusel">
                    @foreach($popularNews as $news)
                        <div class="single-popular-carusel">
                            <div class="thumb-wrap relative">
                                <div class="thumb relative"
                                     style="height: 262px; width: 262px;
                                         background-image: url({{ admin_uploads($news->image) }});
                                         background-position: center; background-size: cover">
                                    {{--<div class="overlay overlay-bg"></div>--}}
                                    {{--<img class="img-fluid" style="max-width: 100%; max-height: 100%;" src="{{ admin_uploads($news->image) }}" alt="">--}}
                                </div>
                                <div class="meta d-flex justify-content-between">
                                    <p><span class="lnr lnr-users"></span> {{ $news->views }}
                                        {{--<span class="lnr lnr-bubble"></span>35--}}
                                    </p>
                                    <h4>{{ \Carbon\Carbon::parse($news->publication_date)->format('d.m.Y H:i') }}</h4>
                                </div>
                            </div>
                            <div class="details">
                                <a href="{{ route('news-show', $news->id) }}">
                                    <h4>
                                        {{ $news->title }}
                                    </h4>
                                </a>
                                {{--<p>--}}
                                {{--When television was young, there was a hugely popular show based on the still popular--}}
                                {{--fictional characte--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End popular-course Area -->


    <!-- Start search-course Area -->
    @component('components.feedback-section')
    @endcomponent
    <!-- End search-course Area -->


    <!-- Start upcoming-event Area -->
    <section class="upcoming-event-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Цікаві події</h1>
                        <p>Будемо раді бачити Вас!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="active-upcoming-event-carusel">
                    @foreach($events as $event)
                        <div class="single-carusel row align-items-center">
                            <div class="col-12 col-md-6 thumb" style="height: 262px; width: 262px;
                                background-image: url({{ admin_uploads($event->cover) }});
                                background-position: center; background-size: cover">
                                {{--<img class="img-fluid" src="img/e1.jpg" alt="">--}}
                            </div>
                            <div class="detials col-12 col-md-6">
                                <p>{{ $event->start_date }}</p>
                                <a href="{{ route('event-show', $event->id) }}"><h4>{{ $event->name }}</h4></a>
                                {{--<p>--}}
                                {{--For most of us, the idea of astronomy is something we directly connect to--}}
                                {{--“stargazing”,--}}
                                {{--telescopes and seeing magnificent displays in the heavens.--}}
                                {{--</p>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End upcoming-event Area -->

    <!-- Start review Area -->
    {{--<section class="review-area section-gap relative">--}}
    {{--<div class="overlay overlay-bg"></div>--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="active-review-carusel">--}}
    {{--<div class="single-review item">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Fannie Rowe</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="single-review item">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Hulda Sutton</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="single-review item">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Fannie Rowe</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="single-review item">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Hulda Sutton</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="single-review item">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Fannie Rowe</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="single-review item">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Hulda Sutton</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="single-review item">--}}
    {{--<img src="img/r1.png" alt="">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Fannie Rowe</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="single-review item">--}}
    {{--<div class="title justify-content-start d-flex">--}}
    {{--<a href="#"><h4>Hulda Sutton</h4></a>--}}
    {{--<div class="star">--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star checked"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--<span class="fa fa-star"></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<p>--}}
    {{--Accessories Here you can find the best computer accessory for your laptop, monitor, printer,--}}
    {{--scanner, speaker. Here you can find the best computer accessory for your laptop, monitor,--}}
    {{--printer, scanner, speaker.--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    <!-- End review Area -->

    <!-- Start cta-one Area -->
    <section class="cta-one-area relative section-gap" style="background-image: url('/img/telegram-bg.jpg') ">
        <div class="container">
            <div class="overlay overlay-bg" style="background: rgba(4,9,30,0.7)"></div>
            <div class="row justify-content-center">
                <div class="wrap">
                    <h1 class="text-white">Спробуйте нашого телеграм-бота</h1>
                    <p>
                        Наша кафедра крокує в ногу з новітніми технологіями та рішеннями.
                        Раді запропонувати Вам нашого телеграм бота для студентів та абітуріентів.
                        Гарного спілкування!
                    </p>
                    <a class="primary-btn wh" href="#">Телеграм бот для абітуріентів</a>
                    <a class="primary-btn wh" href="#">Телеграм бот для студентів</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End cta-one Area -->

    <!-- Start blog Area -->
    <section class="blog-area section-gap" id="blog">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Наші альбоми</h1>
                        <p>Багато різноманітних фото з життя кафедри і не тільки</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($albums as $album)
                    <div class="col-lg-3 col-md-6 single-blog">
                        <div class="thumb" style="height: 262px; width: 262px;
                            background-image: url({{ admin_uploads($album->cover) }});
                            background-position: center; background-size: cover">
                            {{--<img class="img-fluid" src="img/b1.jpg" alt="">--}}
                        </div>
                        <br>
                        <a href="{{ route('album-show', $album->id) }}">
                            <h5>{{ $album->name }}</h5>
                        </a>
                        <a href="{{ route('album-show', $album->id) }}"
                           class="details-btn d-flex justify-content-center align-items-center"><span
                                class="details">Переглянути</span><span class="lnr lnr-arrow-right"></span></a>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
    <!-- End blog Area -->


    <!-- Start cta-two Area -->
    <section class="cta-two-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 cta-left">
                    <h1>Цікавить як поступити до кафедри?</h1>
                </div>
                <div class="col-lg-4 cta-right">
                    <a class="primary-btn wh" href="#">Це просто! Дивись..</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End cta-two Area -->
@endsection
