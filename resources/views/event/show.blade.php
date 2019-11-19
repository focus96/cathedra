@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>{{ $event->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Start event-details Area -->
    <section class="event-details-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 event-details-left">
                    <div class="main-img">
                        <img class="img-fluid" src="{{ admin_uploads($event->cover) }}" alt="">
                    </div>
                    <div class="details-content">
                        <a href="#">
                            <h4></h4>
                        </a>
                        <div>
                            {!! $event->content !!}
                        </div>
                    </div>
                    <div class="social-nav row no-gutters">
                        <div class="col-lg-6 col-md-6 ">
                            {{--<ul class="focials">--}}
                            {{--<li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
                            {{--<li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
                            {{--<li><a href="#"><i class="fa fa-dribbble"></i></a></li>--}}
                            {{--<li><a href="#"><i class="fa fa-behance"></i></a></li>--}}
                            {{--</ul>--}}
                        </div>
                        <div class="col-lg-6 col-md-6 navs">
                            @if($previous)
                                <a href="{{ route('event-show', $previous->id) }}" class="nav-prev"><span
                                            class="lnr lnr-arrow-left"></span>Назад</a>
                            @else
                                <span><span class="lnr lnr-arrow-left"></span>Назад</span>
                            @endif

                            @if($next)
                                <a href="{{ route('event-show', $next->id) }}" class="nav-next">Вперед<span
                                            class="lnr lnr-arrow-right"></span></a>
                            @else
                                <span>Вперед<span class="lnr lnr-arrow-right"></span></span>
                            @endif


                        </div>
                    </div>
                </div>
                <div class="col-lg-4 event-details-right">
                    <div class="single-event-details">
                        <h4>Деталі</h4>
                        <ul class="mt-10">
                            <li class="justify-content-between d-flex">
                                <span>Дата початку</span>
                                <span>{{ $event->start_date }}</span>
                            </li>
                            <li class="justify-content-between d-flex">
                                <span>Дата завершення</span>
                                <span>{{ $event->end_date }}</span>
                            </li>
                            <li class="justify-content-between d-flex">
                                <span>Вартість</span>
                                <span>{{ $event->price == 0 ? 'Бесплатно' :  ($event->price . ' грн') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="single-event-details">
                        <h4>Місце проведення</h4>
                        <ul class="mt-10">
                            <li class="justify-content-between d-flex">
                                <span>{{ $event->place }}</span>
                            </li>
                        </ul>
                    </div>
                    @if($event->organization)
                        <div class="single-event-details">
                            <h4>Організатор</h4>
                            <ul class="mt-10">
                                <li class="justify-content-between d-flex">
                                    <span>{{ $event->organization }}</span>
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- End event-details Area -->


    <!-- Start cta-two Area -->
    @component('components.more-info')
    @endcomponent
    <!-- End cta-two Area -->
@endsection
