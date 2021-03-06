@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Новини</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start top-category-widget Area -->
    <section class="top-category-widget-area pt-90 pb-90 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-cat-widget">
                        <div class="content relative">
                            <div class="overlay overlay-bg"></div>
                            <a href="/news?categories=1">
                                <div class="thumb">
                                    <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget1.jpg"
                                         alt="">
                                </div>
                                <div class="content-details">
                                    <h4 class="content-title mx-auto text-uppercase">Вступ</h4>
                                    <span></span>
                                    <p>Правила, вимоги, норми</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-cat-widget">
                        <div class="content relative">
                            <div class="overlay overlay-bg"></div>
                            <a href="/news?categories=2">
                                <div class="thumb">
                                    <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget2.jpg"
                                         alt="">
                                </div>
                                <div class="content-details">
                                    <h4 class="content-title mx-auto text-uppercase">Навчання</h4>
                                    <span></span>
                                    <p>Конференції, доповіді, статті</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-cat-widget">
                        <div class="content relative">
                            <div class="overlay overlay-bg"></div>
                            <a href="/news?categories=3">
                                <div class="thumb">
                                    <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget1.jpg"
                                         alt="">
                                </div>
                                <div class="content-details">
                                    <h4 class="content-title mx-auto text-uppercase">Життя кафедри</h4>
                                    <span></span>
                                    <p>Заходи, події, звіти</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-category-widget Area -->

    <!-- Start post-content Area -->
    <section class="post-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    @if(!count($news))
                        @component('components.not-found')
                        @endcomponent
                    @endif
                    @foreach($news as $singleNews)
                        <div class="single-post row">
                            <div class="col-lg-3  col-md-3 meta-details">
                                {{--<ul class="tags">--}}
                                {{--<li><a href="#">Food,</a></li>--}}
                                {{--<li><a href="#">Technology,</a></li>--}}
                                {{--<li><a href="#">Politics,</a></li>--}}
                                {{--<li><a href="#">Lifestyle</a></li>--}}
                                {{--</ul>--}}
                                <div class="user-details row">
                                    <p class="user-name col-lg-12 col-md-12 col-6"><a
                                                href="#">{{ $singleNews->author }}</a> <span
                                                class="lnr lnr-user"></span></p>
                                    <p class="date col-lg-12 col-md-12 col-6"><a
                                                href="#">{{ \Carbon\Carbon::parse($singleNews->publication_date)->format('d.m.Y H:i') }}</a>
                                        <span
                                                class="lnr lnr-calendar-full"></span></p>
                                    <p class="view col-lg-12 col-md-12 col-6"><a
                                                href="#">Перегляди: {{ $singleNews->views }}</a> <span
                                                class="lnr lnr-eye"></span></p>
                                    {{--<p class="comments col-lg-12 col-md-12 col-6"><a href="#">** комментариев</a> <span--}}
                                                {{--class="lnr lnr-bubble"></span></p>--}}
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 ">
                                <div class="feature-img">
                                    <img class="img-fluid" src="{{ admin_uploads($singleNews->image) }}" alt="">
                                </div>
                                <a class="posts-title" href="{{ route('news-show', newsParams($singleNews->id)) }}">
                                    <h3>{{ $singleNews->title }}</h3></a>
                                <p class="excert">
                                    {{ $singleNews->short }}
                                </p>
                                <a href="{{ route('news-show', newsParams($singleNews->id)) }}" class="primary-btn">Докладніше</a>
                            </div>
                        </div>
                    @endforeach


                    <nav class="blog-pagination justify-content-center d-flex">
                        {{ $news->links() }}
                    </nav>
                </div>
                <div class="col-lg-4 sidebar-widgets">
                    @component('news.sidebar', compact(['popularNews', 'categories', 'tags']))
                    @endcomponent
                </div>
            </div>
        </div>
    </section>
    <!-- End post-content Area -->
@endsection
