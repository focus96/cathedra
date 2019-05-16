@extends('layouts.app')

@section('content')


    @php
        function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    @endphp

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
                                <option value="3">По аудитории</option>
                                <option value="4" selected>От предмета по группе</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <a href="edit.html" class="genric-btn primary"><i class="fa fa-download"></i> PDF</a>
                        <a href="edit.html" class="genric-btn primary"><i class="fa fa-download"></i> Excel</a>
                        <a href="edit.html" class="genric-btn primary"><i class="fa fa-download"></i> Png</a>
                    </div>
                </div>
                <div class="col-md-12s">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>

                        <tr id="headTable">
                            <th>День недели</th>
                            <th>Номер пары</th>
                            @foreach($groups as $key => $group)
                                <th id="{{'group'.$key}}">{{$group}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $trIds = [];
                            $tdIds = [];
                        @endphp
                    @foreach($items as $key => $item)
                        @for ($i = 1; $i <= 5; $i++)
                            <tr id="{{$trIds[] = generateRandomString(5)}}">
                                @if($i == 1)<td rowspan="5" width="10%" id="{{'item'.$key}}">{{$item}}</td>@endif
                                <td id="{{$tdIds[] = generateRandomString(5)}}">{{$i}}</td>
                                @foreach($groups as $k => $group)
                                    <td class="{{ 'td'.$k }}"></td>
                                @endforeach
                            </tr>
                        @endfor
                    @endforeach

                    </tbody>
                </table>

            </div>
    </section>
    <!-- End contact-page Area -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var shedules = {!! json_encode($shedules->toArray()) !!};
        var groups = {!! json_encode($groups) !!};
        var items = {!! json_encode($items) !!};
        let trIds = {!! json_encode($trIds) !!};
        let tdIds = {!! json_encode($tdIds) !!};


        $(function(){
            console.log(tdIds);
            console.log(trIds);
            itemFromGroup();
            $("#list").on('change', function () {
                switch ($("#list option:selected").val()) {
                    case '1':
                        document.location.href = '/schedule'
                        break;

                    case '2':
                        window.location.replace("/teacher");
                        break;

                    case '3':
                        window.location.replace("/lecture");
                        break;
                    case '4':
                        window.location.replace("/item");
                        break;
                    default:
                        alert( 'Я таких значений не знаю' );
                }
            })

        });

        function itemFromGroup()
        {
            console.log(shedules)

            let j = 0;
            let par = '';
            $.each(shedules, function (id, value) {
                $.each(items, function (key, name){

                    // if ($("#item"+key).text() == value.item) {
                    //     $.each(groups, function (index, item) {
                    //         if ($('#headTable #group' + index).text() == value.group) {
                    //             if ($("#item"+key+"+td").text() == value.couple_number) {
                    //                  par = $("#item"+key+"+td").parent();
                    //                  console.log(par[0].id + ' .td' + index)
                    //                  $('#' + par[0].id + ' .td' + index).text(value.day + ', '+ value.teacher);
                    //             }
                    //         }
                    //     });
                    // }

                    $.each(groups, function (index, item) {
                        if ($('#headTable #group' + index).text() == value.group) {
                            $("table>tbody>tr").each(function(){
                                $("td",this).each(function(){
                                    if ($("#item"+key+"+td").text() == value.couple_number) {
                                        if ($("#item"+key).text() == value.item) {
                                            par = $("#item"+key+"+td").parent();
                                            $('#' + par[0].id + ' .td' + index).text(value.day + ', '+ value.teacher);
                                        }
                                    }
                                });
                            });
                        }
                    });
                });
            });
        }
    </script>
@endsection