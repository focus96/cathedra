@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Кураторы</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page-area section-gap">
        <div class="container text-center">
            <div class="row mb-20">
                <div class="col-md-12">
                    @foreach($groups as $group)
                        <div><strong>{{ $group->name_group }}</strong> - {{ $group->curator ? $group->curator->surname : 'не назначен' }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection