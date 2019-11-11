@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>{{ include_page_header('applicants') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Start events-list Area -->
    <section class="events-list-area section-gap event-page-lists">
        <div class="container">
            <div class="col-md-12">
                {!! include_page_content('applicants') !!}
            </div>
        </div>
    </section>
    <!-- End events-list Area -->

    <!-- Start cta-two Area -->
    @component('components.more-info')
    @endcomponent
    <!-- End cta-two Area -->
@endsection
