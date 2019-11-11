@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>{{ include_page_header('general-info') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! include_page_content('general-info') !!}
                </div>
            </div>

        </div>
    </section>
@endsection
