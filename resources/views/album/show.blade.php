@extends('layouts.app')

@section('content')

    <!-- Start gallery Area -->
    <section class="gallery-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 pb-20">
                    <a href="{{ route('album-index') }}" class="primary-btn">Назад</a>
                </div>
                <div class="col-lg-10 text-right">
                    <h2 class="mb-20">{{$album->name}}</h2>
                    <p class="mb-20">{{ $album->description }}</p>
                </div>
                @if(count($files) > 2)
                    @php
                            $cols = [7, 5, 4, 4, 4, 5, 7];
                    @endphp

                    @foreach($files as $key => $file)
                        @if($file !== '.' && $file !== '..')
                            <div class="col-lg-{{ $cols[$key%7] }}">
                                {{--<a href="{{ '/storage/albums/' . $album->id . '/' . $file }}" class="img-gal">--}}
                                <a href="{{ admin_uploads('albums/' . $album->id . '/' . $file) }}" class="img-gal">
                                    <div class="single-imgs relative">
                                        <div class="relative">
                                            <img style="object-fit: cover; height: 300px" class="img-fluid"
                                                 src="{{ admin_uploads('albums/' . $album->id . '/' . $file) }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <section class="v-title text-center">
                        <div class="container">
                            <div class="row d-flex align-items-center justify-content-center">
                                <div class="col-lg-12">
                                    <h4>Элементов не найдено</h4>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

            </div>
        </div>
    </section>
    <!-- End gallery Area -->


    @component('components.more-info')
    @endcomponent
@endsection