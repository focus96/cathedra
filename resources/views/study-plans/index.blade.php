@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Навчальні плани</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page-area section-gap">
        <div class="container text-center">
            <div class="row mb-20">
                <div class="col-md-12">
                    @php
                        $bySpecializations = $studyPlans->groupBy('specialization_id');
                    @endphp
                    @foreach($bySpecializations as $idSpecialization => $bySpecialization)
                        @php
                            $specialization = $specializations->where('id', $idSpecialization)->first();
                        @endphp
                        <h3>{{ $specialization ? $specialization->full_name : '-'  }}</h3><br><br>

                        @php
                            $byYears = $bySpecialization->groupBy('year');
                        @endphp
                        <ul class="list-group">
                            @foreach($byYears as $year => $byYear)
                                <li class="list-group-item">
                                        <a href="{{ admin_uploads($byYear->first()->file) }}" download>{{ $year }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <br><br>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
