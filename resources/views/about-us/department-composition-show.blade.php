@extends('layouts.app')

@section('content')

    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="events-list-area section-gap event-page-lists">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-10 pb-30">
                                    <a href="/about-us/department-composition" class="genric-btn primary">Назад</a>
                                    <br><br>

                                    <div class="single-carusel row ">

                                        <div class="col-12 col-md-4">
                                            <div style="height: 350px; width: 250px !important;
                                                background-image: url({{ admin_uploads($teacher->foto) }});
                                                background-position: center; background-size: cover"></div>
                                            {{--                                                <img class="img-fluid" src="{{ admin_uploads($teacher->foto) }}" alt="">--}}
                                        </div>
                                        <div class="detials col-12 col-md-8">
                                            <p>{{ $teacher->academic_degree }}</p>
                                            <p>{{ $teacher->function }}</p>
                                            <h3>{{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->last_name }}</h3>
                                            <div>
                                                <div>{{ $teacher->email }}</div>
                                                @if($teacher->publicity_phone)
                                                    <div>{{ $teacher->phone }}</div>
                                                @endif
                                            </div>
                                            @if($teacher->specialization)
                                                <div>
                                                    <h4>Специальзация:</h4>
                                                    {!!  trim($teacher->specialization) !!}
                                                </div>
                                            @endif
                                            @if($teacher->additional_information)
                                                <div>
                                                    <h4>Дополнительная информация:</h4>
                                                    {!!  trim($teacher->additional_information) !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </section>


                </div>
            </div>

        </div>
    </section>
@endsection
