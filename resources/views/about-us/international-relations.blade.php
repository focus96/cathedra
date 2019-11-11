@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>{{ include_page_header('international-relations') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="item-page">
                        {!! include_page_content('international-relations') !!}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
