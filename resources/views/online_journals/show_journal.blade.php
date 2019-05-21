<style type="text/css">
    .yellow {
        background: #ffff00;
        color: #ff0000;
    }

    .red {
        background: #ff0000;
        color: #ffffff;
    }
</style>

@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">

        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Онлайн-журнал</h1>
                    <p class="text-white link-nav"><a href="/">Головна</a> </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->
    <div class="mytable">
        <section class="contact-page-area section-gap">
            <div class="container">

                @if($journal->is_close === 0)
                    <h4>Журнал № {{ $journal->id }} Статус: Открыт</h4>
                @else
                    <h4>Журнал № {{ $journal->id }} Статус: Закрыт</h4>
                @endif
                <div class="col-md-12s">
                    <div class="col-md-6s menu-down">
                        <a href="/save-pdf/{{ $journal->id }}" class="genric-btn primary"><i class="fa fa-download"></i> PDF</a>
                        <a href="edit.html" class="genric-btn primary"><i class="fa fa-download"></i> Excel</a>
                        <a href="edit.html" class="genric-btn primary"><i class="fa fa-download"></i> Png</a>
                    </div>

                    <div class="col-md-6s">
                        <table class="table table-bordered table-st">
                            <tr>
                                <th>{{ $journal->groupRelation->name_group }}</th>
                                @foreach($journal->checkpoints as $checkpoint)
                                    <th>
                                        {{ $checkpoint->name }}
                                    </th>
                                @endforeach
                            </tr>
                            @foreach($journal->groupRelation->students as $student)
                                <tr>
                                    <td>{{ $student->surname }}</td>
                                    @foreach($journal->checkpoints as $checkpoint)
                                        @php
                                            $point = $student->points->where('checkpoint_id', $checkpoint->id)->first();
                                        @endphp
                                        <td
                                                data-journal-id="{{$journal->id}}"
                                                data-student-id="{{$student->id}}"
                                                data-checkpoint-id="{{$checkpoint->id}}"
                                                data-student_point-id="{{$point ? $point->id : ''}}"

                                                class="edit points {{ (($point && ($checkpoint->deadline < $point->created_at or
                                                $checkpoint->deadline < $point->updated_at) && ($point->points == null)) or
                                                (!$point && ($checkpoint->deadline < now()))) ? 'red' : '' }}
                                                {{ (($point && ($checkpoint->deadline < $point->created_at or
                                                $checkpoint->deadline < $point->updated_at)) &&
                                                ($point->points)) ? 'yellow' : '' }}">{{ $point ? $point->points : '' }}</td>

                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <a class="genric-btn primary" href="/online_journals/show_group/{{ $journal->groupRelation->id }}">Вернуться к списку журналов</a>
                        </div>
                        <div class="col-lg-3">
                            <a class="genric-btn primary" href="/online_journals">Вернуться к списку групп</a>
                        </div>
                        <style>

                            .menu-down{
                                margin-bottom: 10px;
                            }
                        </style>

                    </div>

                </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h4 class="lnr lnr-bubble">Підказка</h4>


                        </div>
                        <div class="col-md-6">
                            <blockquote>
                                <q>
                                    Якщо оцінка підсвічується <b class="yellow ">жовтим</b> кольором - термін здачі був прострочений.
                                    <b class="red">Червоним</b> кольором - оцінка прострочена та відсутня.
                                </q>
                            </blockquote>
                        </div>

                    </div>
            </div>

        </section>

@endsection