@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Состав кафедры</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="events-list-area section-gap event-page-lists">
                        <div class="container">
                            <div class="row align-items-center">
                                @foreach($teachers as $teacher)
                                    <div class="col-lg-6 pb-30">
                                        <div class="single-carusel row align-items-center">
                                            <div class="col-12 col-md-6 thumb">
                                                <div style="height: 350px; width: 250px !important;
                                                    background-image: url({{ admin_uploads($teacher->foto) }});
                                                    background-position: center; background-size: cover"></div>
{{--                                                <img class="img-fluid" src="{{ admin_uploads($teacher->foto) }}" alt="">--}}
                                            </div>
                                            <div class="detials col-12 col-md-6">
                                                <p>{{ $teacher->academic_degree }}</p>
                                                <p>{{ $teacher->function }}</p>
                                                <a href="/about-us/department-composition/{{ $teacher->id }}">
                                                    <h4>{{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->last_name }}</h4>
                                                </a>
                                                <div>
                                                    <div>{{ $teacher->email }}</div>
                                                    @if($teacher->publicity_phone)
                                                        <div>{{ $teacher->phone }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>


                </div>
            </div>

        </div>
    </section>
@endsection
