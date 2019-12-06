@extends('layouts.app')

@section('content')
    <meta name="http-equiv" content="Content-type: text/html; charset=UTF-8">
    <!-- start banner Area -->
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <h1>Розклад</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->
    <!-- Start contact-page Area -->
    <section class="contact-page-area section-gap">
        <div class="container-fluid">
            <div class="row mb-20">
                <div class="col-lg-2 d-flex flex-column address-wrap">
                    <div class="single-contact-address d-flex flex-row">
                        <select class="btn btn-secondary btn-sm dropdown-toggle"
                                onchange="window.location.href = '/schedule/' + this.value">
                            <option value="by-lecture-hall" selected>за аудиторією</option>
                            <option value="by-group">за групою</option>
                            <option value="by-teacher">за викладачем</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    {{--<button id="print" class="genric-btn primary"><i class="fa fa-download"></i> PDF</button>--}}
                    {{--<a href="/download" class="genric-btn primary"><i class="fa fa-download"></i> Excel</a>--}}
                </div>
            </div>
            <div class="col-md-12s">
                <table id="example1" class="table table-sm">
                    <thead class="">
                    <tr id="headTable">
                        <th>День тижня</th>
                        <th>Номер пари</th>
                        @foreach($lectureHalls as $hall)
                            <th>{{ $hall }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(config('core.dayOfWeek') as $keyDayOfWeek => $dayOfWeek)
                        <tr>
                            <td rowspan="5">{{$dayOfWeek}}</td>
                            <td>1</td>
                            @foreach($lectureHalls as $hall)
                                @php
                                    $scheduleItems = $schedule[$hall]->where('couple_number', 1)->where('day', $keyDayOfWeek);
                                @endphp
                                <td>
                                    @php
                                        $types = ['laboratory_work' => 'лабораторна работа', 'practical_lesson' => 'практичне заняття',  'lecture' => 'лекція'];
                                        $index = 0;
                                    @endphp
                                    @foreach($scheduleItems as $scheduleItem)
                                        @if($index)
                                            <hr>
                                        @endif
                                        @php
                                            $index++;
                                        @endphp
                                            {{ ($scheduleItem->parity_week ?  ($scheduleItem->parity_week === 'even' ? '(*) ' : '(|) ') : '')  }}{{ $scheduleItem->item ? $scheduleItem->item->abbreviation : '-'  }}
                                        , <br>
                                        ({{ $scheduleItem->teacher ? $scheduleItem->teacher->fio : '-'  }}), <br>
                                        {{ $scheduleItem->group ? $scheduleItem->group->name : '-'  }}, <br>
                                        ({{ array_key_exists($scheduleItem->type, $types) ? $types[$scheduleItem->type] : '-'  }})
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                        @for($number = 2; $number <= 5; $number++)
                            <tr>
                                <td>{{ $number }}</td>
                                @foreach($lectureHalls as $hall)
                                    @php
                                        $scheduleItems = $schedule[$hall]->where('couple_number', $number)->where('day', $keyDayOfWeek);
                                    @endphp
                                    <td>
                                        @php
                                            $types = ['laboratory_work' => 'лабораторна работа', 'practical_lesson' => 'практичне заняття',  'lecture' => 'лекція'];
                                            $index = 0;
                                        @endphp
                                        @foreach($scheduleItems as $scheduleItem)
                                            @if($index)
                                                <hr>
                                            @endif
                                            @php
                                                $index++;
                                            @endphp

                                                {{ ($scheduleItem->parity_week ?  ($scheduleItem->parity_week === 'even' ? '(*) ' : '(|) ') : '')  }}{{ $scheduleItem->item ? $scheduleItem->item->abbreviation : '-'  }}
                                            , <br>
                                            ({{ $scheduleItem->teacher ? $scheduleItem->teacher->fio : '-'  }}), <br>
                                            {{ $scheduleItem->group ? $scheduleItem->group->name : '-'  }}, <br>
                                            ({{ array_key_exists($scheduleItem->type, $types) ? $types[$scheduleItem->type] : '-'  }})
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- End contact-page Area -->

@endsection
