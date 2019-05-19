@extends('layouts.app')

@section('content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <style>
        .banner-area{
            background: url(../img/baner.jpg) right;
        }
    </style>
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-between">
            <div class="banner-content col-lg-9 col-md-12">
                <h1 class="text-uppercase">
                    Ми забезпечуємо кращу освіту для майбутнього країни
                </h1>

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
                        <h4>
                            Актуальні Новини життя Ддма
                        </h4>
                    </div>
                    <div class="desc-wrap">
                        <a href="/news">
                            <p style="color: #777">
                               ДДМА відкриті підготовчі курси. Заочні курси працюють за дистанційною формою навчання.
                            </p>
                            Приєднатися
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>Університ №1</h4>
                    </div>
                    <div class="desc-wrap">
                        <a href="http://www.dgma.donetsk.ua/abiturientu.html">
                            <p style="color: #777">
                            У вас є можливість обрати життєвий шлях - здійсніть це за допомогою Донбаської державної машинобудівної академії!
                            </p>
                            Приєднатися
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>
                            Академії стала доступна мережа Uran</h4>
                    </div>
                    <div class="desc-wrap">
                        <a href="/event">
                            <p style="color: #777">
                                Будь в курсі всіх запланованих заходів  пов'язаних з життям інституту і відвідай їх разом з друзями.
                            </p>
                            Приєднатися
                        </a>
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
                    <h1 class="mb-10">Popular Courses we offer</h1>
                    <p>There is a moment in the life of any aspiring.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="active-popular-carusel">
                @foreach($news as $news)
                <div class="single-popular-carusel">
                    <div class="thumb-wrap relative">
                        <div class="thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="{{$news ->getImage()}}" alt="">
                        </div>
                        <div class="meta d-flex justify-content-between">
                            <p><span class="lnr lnr-eye"></span>{{$news ->views}}</p>
                            <p><span class="lnr lnr-user"></span>{{$news ->author}}</p>
                        </div>
                    </div>
                    <div class="details">
                        <a href="{{route('news-show',$news->id)}}">
                            <h4>
                                {{$news ->title}}
                            </h4>
                            <p>
                                {{$news ->short}}
                            </p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End popular-course Area -->




<!-- Start search-course Area -->
<section class="search-course-area relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-6 search-course-left">
                <h1 class="text-white">
                    Не втрачай часу  даремно, приходь і здавай вступні іспити
                </h1>>
                <p>
                    <ul>
                        <li>
                            Кафедри, оснащені сучасними аудиторіями і лабораторіями, що мають багатий науково-дослідний потенціал;
                        </li>
                        <li>
                            Доброзичливий колектив, що дозволяє студентам розвивати свої захоплення, про що свідчать численні нагороди та досягнення.
                        </li>
                        <li>
                            Інститут активно співпрацюює з провідними підприємствами та фірмами на регіональному й міжнародному ринках;
                        </li>
                    </ul>
                </p>
                <div class="row details-content">
                    <div class="col single-detials">
                        <span class="lnr lnr-graduation-hat"></span>
                        <a href="/contact"><h4>Вища освіта залог майбутнього</h4></a>
                        <p>
                            Отримуй кращу вищу освіту в своїй країні (бакалавр / магістр)
                        </p>
                    </div>
                    <div class="col single-detials">
                        <span class="lnr lnr-license"></span>
                        <a href="/contact"><h4>Перспективне майбутнє</h4></a>
                        <p>
                        <ul>
                            <li>Широкі можливості розподілу на фірми IT-індустрії міста</li>
                            <li>Творчі колективи</li>
                        </ul>

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 search-course-right section-gap">
                <form class="form-wrap" action="#">
                    <h4 class="text-white pb-20 text-center mb-30">Search for Available Course</h4>
                    <input type="text" class="form-control" name="name" placeholder="Your Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Твоє ім\'я'" >
                    <input type="password" class="form-control" name="password" placeholder="Your Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Пароль'" >
                    <input type="email" class="form-control" name="email" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ваша електронна адреса'" >
                    <div class="form-select" id="service-select">
                        <select>
                            <option datd-display="">Choose Course</option>
                            <option value="1">Course One</option>
                            <option value="2">Course Two</option>
                            <option value="3">Course Three</option>
                            <option value="4">Course Four</option>
                        </select>
                    </div>
                    <button class="primary-btn text-uppercase">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End search-course Area -->


<!-- Start upcoming-event Area -->
<section class="upcoming-event-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Головні події ДДМА</h1>
                    <p>Не прогав актуальні події пов'язані з життям інституту</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="active-upcoming-event-carusel">
                @foreach($events as $event)
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{$event->getImage()}}" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>Дата початку:    {{$event->start_date}}</p>
                        <a href="{{route('event-show',$event->id)}}"><h4>
                                {{$event->name}}
                            </h4></a>
                        <p>
                            Місце проведення - {{$event->place}}
                        </p>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End upcoming-event Area -->
<!-- Start review Area -->
<section class="review-area section-gap relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row">
            <div class="active-review-carusel">
                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Fannie Rowe</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Hulda Sutton</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Fannie Rowe</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Hulda Sutton</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Fannie Rowe</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Hulda Sutton</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
                <div class="single-review item">
                    <img src="img/r1.png" alt="">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Fannie Rowe</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#"><h4>Hulda Sutton</h4></a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End review Area -->

<!-- Start cta-one Area -->
<section class="cta-one-area relative section-gap">
    <div class="container">
        <div class="overlay overlay-bg"></div>
        <div class="row justify-content-center">
            <div class="wrap">
                <h1 class="text-white">Become an instructor</h1>
                <p>
                    There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station whether that is on the deck.
                </p>
                <a class="primary-btn wh" href="#">Apply for the post</a>
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
                    <h1 class="mb-10">Latest posts from our Blog</h1>
                    <p>In the history of modern astronomy there is.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 single-blog">
                <div class="thumb">
                    <img class="img-fluid" src="img/b1.jpg" alt="">
                </div>
                <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                <a href="blog-single.html">
                    <h5>Addiction When Gambling Becomes A Problem</h5>
                </a>
                <p>
                    Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their.
                </p>
                <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>
            </div>
            <div class="col-lg-3 col-md-6 single-blog">
                <div class="thumb">
                    <img class="img-fluid" src="img/b2.jpg" alt="">
                </div>
                <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                <a href="blog-single.html">
                    <h5>Computer Hardware Desktops And Notebooks</h5>
                </a>
                <p>
                    Ah, the technical interview. Nothing like it. Not only does it cause anxiety, but it causes anxiety for several different reasons.
                </p>
                <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>
            </div>
            <div class="col-lg-3 col-md-6 single-blog">
                <div class="thumb">
                    <img class="img-fluid" src="img/b3.jpg" alt="">
                </div>
                <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                <a href="blog-single.html">
                    <h5>Make Myspace Your Best Designed Space</h5>
                </a>
                <p>
                    Plantronics with its GN Netcom wireless headset creates the next generation of wireless headset and other products such as wireless.
                </p>
                <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>
            </div>
            <div class="col-lg-3 col-md-6 single-blog">
                <div class="thumb">
                    <img class="img-fluid" src="img/b4.jpg" alt="">
                </div>
                <p class="meta">25 April, 2018  |  By <a href="#">Mark Wiens</a></p>
                <a href="blog-single.html">
                    <h5>Video Games Playing With Imagination</h5>
                </a>
                <p>
                    About 64% of all on-line teens say that do things online that they wouldn’t want their parents to know about.   11% of all adult internet
                </p>
                <a href="#" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>
            </div>
        </div>
    </div>
</section>
<!-- End blog Area -->

<!-- Start cta-two Area -->
<section class="cta-two-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 cta-left">
                <h1>Бажаєте дізнатися про кафедру більше?</h1>
            </div>
            <div class="col-lg-4 cta-right">
                <a class="primary-btn wh" href="/about">Подивитися</a>
            </div>
        </div>
    </div>
</section>
<!-- End cta-two Area -->
@endsection