@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Учебные планы</h1>
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
                        <h1>{{ $specialization ? $specialization->full_name : '-'  }}</h1>

                        @php
                            $byYears = $bySpecialization->groupBy('year');
                        @endphp
                        @foreach($byYears as $year => $byYear)
                            <h2>{{ $year }}:
                                @php
                                    $byLevels = $bySpecialization->groupBy('level');
                                @endphp
                                @foreach($byLevels as $level => $byLevel)
                                    <a href="{{ admin_uploads($byLevel->first()->file) }}" download>{{ $level }} курс</a>
                                @endforeach
                            </h2>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection