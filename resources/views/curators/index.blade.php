@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Куратори</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page-area section-gap">
        <div class="container text-center">
            <div class="row mb-20">
                <div class="col-md-12">
                    <ul class="list-group">
                        @foreach($groups as $group)
                            @if($group->curator)
                                <li class="list-group-item"><b>{{ $group->name }}</b>
                                    - <a href="/about-us/department-composition/{{ $group->curator->id }}">{{ $group->curator->surname . " " . $group->curator->name . ' ' .$group->curator->last_name }}</a></li>

                            @else
                                <li class="list-group-item"><b>{{ $group->name }}</b>
                                    - {{ 'не призначено' }}</li>
                                @endif
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
