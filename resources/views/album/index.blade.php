@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Галерея</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start gallery Area -->
    <section class="gallery-area section-gap">
        <div class="container">
            @if(!count($albums))
                @component('components.not-found')
                @endcomponent
            @else
                <div class="row">
                    @php
                        $cols = [7, 5, 4, 4, 4, 5, 7];
                    @endphp

                    @foreach($albums as $key => $album)
                        <div class="col-lg-{{ $cols[$key%7] }}">
                            <a href="{{ route('album-show', $album->id) }}">
                                <div class="single-imgs relative">
                                    <div class="overlay overlay-bg text-center">
                                        <h4 style="color: #fff; margin-top:40px;">{{ $album->name }}</h4>
                                    </div>
                                    <div class="relative">
                                        <img style="object-fit: cover; height: 300px" class="img-fluid"
                                             src="{{ admin_uploads($album->cover) }}" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End gallery Area -->


    <!-- Start cta-two Area -->
    @component('components.more-info')
    @endcomponent
    <!-- End cta-two Area -->
@endsection
