@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <style>
            .genric-btn{
                line-height: 30px;
            }
            .banner-area{
                background: url(../img/baner2.jpg) right;
            }
        </style>
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Розклад</h1>
                    <p class="text-white link-nav"><a href="/">Головна</a> </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->


    <!-- Start contact-page Area -->
    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 d-flex flex-column address-wrap">
                    <div class="single-contact-address d-flex flex-row">
                        <select class="btn btn-secondary btn-sm dropdown-toggle" id="list">
                            <option value="1" >По группе</option>
                            <option value="2" >По преподователю</option>
                            <option value="3" selected>По аудитории</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <button id="print" class="genric-btn primary"><i class="fa fa-download"></i> PDF</button>
                    <a href="/download" class="genric-btn primary"><i class="fa fa-download"></i> Excel</a>
                </div>
            </div>
            <div class="col-md-12s">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>

                    <tr id="headTable">
                        <th>День недели</th>
                        <th>Номер пары</th>
                        @foreach($lectures as $key => $lecture)
                            <th id="{{'lecture'.$key}}">{{$lecture}}</th>
                        @endforeach

                    </tr>
                    </thead>
                    <tbody>
                    <tr id="m1">
                        <td rowspan="5" width="10%" id="mon" >Понедельник</td>
                        <td id="mn1">1</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="m2">
                        <td id="mn2">2</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="m3">
                        <td id="mn3">3</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="m4">
                        <td id="mn4">4</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="m5">
                        <td id="mn5">5</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>

                    <tr id="t1">
                        <td rowspan="5" width="10%" id="tue">Вторник</td>
                        <td id="ts1">1</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="t2">
                        <td id="ts2">2</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="t3">
                        <td id="ts3">3</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="t4">
                        <td id="ts4">4</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="t5">
                        <td id="ts5">5</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>


                    <tr id="w1">
                        <td rowspan="5" width="10%" id="wed">Среда</td>
                        <td id="we1">1</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="w2">
                        <td id="we2">2</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="w3">
                        <td id="we3">3</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="w4">
                        <td id="we4">4</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="w5">
                        <td id="we5">5</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>

                    <tr id="th1">
                        <td rowspan="5" width="10%" id="thur">Четверг</td>
                        <td id="thu1">1</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="th2">
                        <td id="thu2">2</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="th3">
                        <td id="thu3">3</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="th4">
                        <td id="thu4">4</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="th5">
                        <td id="thu5">5</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>

                    <tr id="fr1">
                        <td rowspan="5" width="10%" id="fri">Пятница</td>
                        <td id="f1">1</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="fr2">
                        <td id="f2">2</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="fr3">
                        <td id="f3">3</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="fr4">
                        <td id="f4">4</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="fr5">
                        <td id="f5">5</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>

                    <tr id="sa1">
                        <td rowspan="5" width="10%" id="sat">Суббота</td>
                        <td id="s1">1</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="sa2">
                        <td id="s2">2</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="sa3">
                        <td id="s3">3</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="sa4">
                        <td id="s4">4</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>
                    <tr id="sa5">
                        <td id="s5">5</td>
                        @foreach($lectures as $key => $lecture)
                            <td class="{{ 'td'.$key }}"></td>
                        @endforeach
                    </tr>

                    </tbody>
                </table>
            </div>
    </section>
    <!-- End contact-page Area -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>




    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/schedule.js') }}"></script>
    <script>

        var lectures = {!! json_encode($lectures) !!};
        var shedules = {!! json_encode($shedules->toArray()) !!};


        $(function(){
            dayFromLecture();
            $("#list").on('change', function () {
                switch ($("#list option:selected").val()) {
                    case '1':
                        window.location.replace("/schedule");
                        break;
                    case '2':
                        document.location.href = '/teacher'
                        break;
                    case '3':
                        document.location.href = '/lecture'
                        break;
                    case '4':
                        document.location.href = '/item'
                        break;
                    default:
                        alert( 'Я таких значений не знаю' );
                }
            })

        });

        function dayFromLecture()
        {
            $.each(shedules, function (id, value) {
                if ($("#mon").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(lectures, function (index, item) {
                        if ($('#headTable #lecture' + index).text() == value.lecture_hall) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#mn' + i).text() == value.couple_number) {
                                    $('#m' + i + ' .td' + index).text(value.group);
                                }
                            }
                            ;
                        }
                    });
                }
            })

            $.each(shedules, function (id, value) {
                if ($("#tue").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(lectures, function (index, item) {
                        if ($('#headTable #lecture' + index).text() == value.lecture_hall) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#ts' + i).text() == value.couple_number) {
                                    $('#t' + i + ' .td' + index).text(value.group);
                                }
                            }
                            ;
                        }
                    });
                }
            })

            $.each(shedules, function (id, value) {
                if ($("#wed").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(lectures, function (index, item) {
                        if ($('#headTable #lecture' + index).text() == value.lecture_hall) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#we' + i).text() == value.couple_number) {
                                    $('#w' + i + ' .td' + index).text(value.group);
                                }
                            }
                            ;
                        }
                    });
                }
            })

            $.each(shedules, function (id, value) {
                if ($("#thur").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(lectures, function (index, item) {
                        if ($('#headTable #lecture' + index).text() == value.lecture_hall) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#thu' + i).text() == value.couple_number) {
                                    $('#th' + i + ' .td' + index).text(value.group);
                                }
                            }
                            ;
                        }
                    });
                }
            })

            $.each(shedules, function (id, value) {
                if ($("#fri").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(lectures, function (index, item) {
                        if ($('#headTable #lecture' + index).text() == value.lecture_hall) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#f' + i).text() == value.couple_number) {
                                    $('#fr' + i + ' .td' + index).text(value.group);
                                }
                            }
                            ;
                        }
                    });
                }
            })

            $.each(shedules, function (id, value) {
                if ($("#sat").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(lectures, function (index, item) {
                        if ($('#headTable #lecture' + index).text() == value.lecture_hall) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#s' + i).text() == value.couple_number) {
                                    $('#sa' + i + ' .td' + index).text(value.group);
                                }
                            }
                            ;
                        }
                    });
                }
            })
        }
    </script>
@endsection