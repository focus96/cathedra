<div class="widget-wrap news-sidebar">
    <div class="single-sidebar-widget search-widget">
        <form class="search-form" method="get" action="{{ route('news-index') }}">
            <input placeholder="Поиск новостей" name="search" type="text"
                   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Поиск новостей'"
                   value="{{ request()->get('search', null) }}">
            @if(request()->get('categories', null))
                <input type="hidden" name="categories" value="{{ request()->get('categories', null) }}">
            @endif
            @if(request()->get('tags', null))
                <input type="hidden" name="tags" value="{{ request()->get('tags', null) }}">
            @endif

            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    {{--<div class="single-sidebar-widget user-info-widget">--}}
    {{--<img src="/img/blog/user-info.png" alt="">--}}
    {{--<a href="#"><h4>Charlie Barber</h4></a>--}}
    {{--<p>--}}
    {{--Senior blog writer--}}
    {{--</p>--}}
    {{--<ul class="social-links">--}}
    {{--<li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
    {{--<li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
    {{--<li><a href="#"><i class="fa fa-github"></i></a></li>--}}
    {{--<li><a href="#"><i class="fa fa-behance"></i></a></li>--}}
    {{--</ul>--}}
    {{--<p>--}}
    {{--Boot camps have its supporters andit sdetractors. Some people do not understand why you--}}
    {{--should have to spend money on boot camp when you can get. Boot camps have itssuppor ters--}}
    {{--andits detractors.--}}
    {{--</p>--}}
    {{--</div>--}}
    <div class="single-sidebar-widget popular-post-widget">
        <h4 class="popular-title">Популярные новости</h4>
        <div class="popular-post-list">
            @foreach($popularNews as $singlePopularNews)
                <div class="single-post-list d-flex flex-row align-items-center">
                    <div class="thumb" style="width: 40%">
                        <img class="img-fluid" src="{{ admin_uploads($singlePopularNews->image) }}" alt="">
                    </div>
                    <div class="details" style="width: 60%">
                        <a href="{{ route('news-show', newsParams($singlePopularNews->id)) }}">
                            <h6>{{ $singlePopularNews->title }}</h6></a>
                        <p>{{ \Carbon\Carbon::parse($singlePopularNews->publication_date)->diffForHumans() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="single-sidebar-widget post-category-widget">
        <h4 class="category-title">Категории</h4>
        <ul class="cat-list">
            @php
                $categoriesParams = array_filter(explode('_', request()->get('categories', null)));
            @endphp
            @foreach($categories as $category)
                <li class="{{ in_array($category->id, $categoriesParams) ? 'active' : ' ' }}">
                    <a class="d-flex justify-content-between"
                       href="{{ route('news-index', newsParams(null, setInSearchParams($categoriesParams, $category->id))) }}">
                        <p>{{ $category->name }}</p>
                        <p>{{ $category->news_count }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="single-sidebar-widget newsletter-widget">
        <h4 class="newsletter-title">Подписка</h4>
        <p>
            Подпишитесь на наши обновления, чтобы быть в курсе последних событий.
        </p>
        <div class="form-group d-flex flex-row">
            <div class="col-autos">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"
                                                         aria-hidden="true"></i>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup"
                           placeholder="Введите email" onfocus="this.placeholder = ''"
                           onblur="this.placeholder = 'Введите email'">
                </div>
            </div>
            <a href="#" class="bbtns">Подписаться</a>
        </div>
        <p class="text-bottom">
            Вы можете отписаться в любое время
        </p>
    </div>
    <div class="single-sidebar-widget tag-cloud-widget">
        <h4 class="tagcloud-title">Теги</h4>
        <ul>
            @php
                $tagsParams = array_filter(explode('_', request()->get('tags', null)));
            @endphp
            @foreach($tags as $tag)
                <li class="{{ in_array($tag->id, $tagsParams) ? 'active' : ' ' }}">
                    <a href="{{ route('news-index', newsParams(null, null, setInSearchParams($tagsParams, $tag->id))) }}">
                        {{ $tag->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
