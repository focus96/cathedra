<!doctype html>

<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <title>Розклад</title>
</head>
<body>


<style>


    *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

    *[contenteditable] { cursor: pointer; }

    *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

    span[contenteditable] { display: inline-block; }

    /* heading */

    h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

    /* table */

    table { font-size: 75%; table-layout: fixed; width: 100%; }
    table { border-collapse: separate; border-spacing: 2px; }
    th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
    th, td { border-radius: 0.25em; border-style: solid; }
    th { background: #EEE; border-color: #BBB; }
    td { border-color: #DDD; }




    table.balance th, table.balance td { width: 50%; }
    table.balance td { text-align: right; }

    /* aside */

    aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
    aside h1 { border-color: #999; border-bottom-style: solid; }

    /* javascript */


    </style>



<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
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
                <tr id="m1">
                    <td rowspan="5" width="10%" id="mon" ><span>Понедельник</span></td>
                    <td id="mn1">1</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="m2">
                    <td id="mn2">2</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="m3">
                    <td id="mn3">3</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="m4">
                    <td id="mn4">4</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="m5">
                    <td id="mn5">5</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>

                <tr id="t1">
                    <td rowspan="5" width="10%" id="tue">Вторник</td>
                    <td id="ts1">1</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="t2">
                    <td id="ts2">2</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="t3">
                    <td id="ts3">3</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="t4">
                    <td id="ts4">4</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="t5">
                    <td id="ts5">5</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>


                <tr id="w1">
                    <td rowspan="5" width="10%" id="wed">Среда</td>
                    <td id="we1">1</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="w2">
                    <td id="we2">2</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="w3">
                    <td id="we3">3</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="w4">
                    <td id="we4">4</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="w5">
                    <td id="we5">5</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>

                <tr id="th1">
                    <td rowspan="5" width="10%" id="thur">Четверг</td>
                    <td id="thu1">1</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="th2">
                    <td id="thu2">2</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="th3">
                    <td id="thu3">3</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="th4">
                    <td id="thu4">4</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="th5">
                    <td id="thu5">5</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>

                <tr id="fr1">
                    <td rowspan="5" width="10%" id="fri">Пятница</td>
                    <td id="f1">1</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="fr2">
                    <td id="f2">2</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="fr3">
                    <td id="f3">3</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="fr4">
                    <td id="f4">4</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="fr5">
                    <td id="f5">5</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>

                <tr id="sa1">
                    <td rowspan="5" width="10%" id="sat">Суббота</td>
                    <td id="s1">1</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="sa2">
                    <td id="s2">2</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="sa3">
                    <td id="s3">3</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="sa4">
                    <td id="s4">4</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>
                <tr id="sa5">
                    <td id="s5">5</td>
                    @foreach($groups as $key => $group)
                        <td class="{{ 'td'.$key }}"></td>
                    @endforeach
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- End contact-page Area -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var shedules = {!! json_encode($shedules->toArray()) !!};
    var groups = {!! json_encode($groups) !!};
    var teachers = {!! json_encode($teachers) !!};



    $(function(){
        dayFromGroup();
        function dayFromGroup()
        {
            $.each(shedules, function (id, value) {
                if ($("#mon").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(groups, function (index, item) {
                        if ($('#headTable #group' + index).text() == value.group) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#mn' + i).text() == value.couple_number) {
                                    $('#m' + i + ' .td' + index).text(value.item + ', '+ value.teacher);
                                }
                            }
                            ;
                        }
                    });
                }

                if ($("#tue").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(groups, function (index, item) {
                        if ($('#headTable #group' + index).text() == value.group) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#ts' + i).text() == value.couple_number) {
                                    $('#t' + i + ' .td' + index).text(value.item + ', '+ value.teacher);
                                }
                            }
                            ;
                        }
                    });
                }

                if ($("#wed").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(groups, function (index, item) {
                        if ($('#headTable #group' + index).text() == value.group) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#we' + i).text() == value.couple_number) {
                                    $('#w' + i + ' .td' + index).text(value.item + ', '+ value.teacher);
                                }
                            }
                            ;
                        }
                    });
                }

                if ($("#thur").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(groups, function (index, item) {
                        if ($('#headTable #group' + index).text() == value.group) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#thu' + i).text() == value.couple_number) {
                                    $('#th' + i + ' .td' + index).text(value.item + ', '+ value.teacher);
                                }
                            }
                            ;
                        }
                    });
                }

                if ($("#fri").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(groups, function (index, item) {
                        if ($('#headTable #group' + index).text() == value.group) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#f' + i).text() == value.couple_number) {
                                    $('#fr' + i + ' .td' + index).text(value.item + ', '+ value.teacher);
                                }
                            }
                            ;
                        }
                    });
                }

                if ($("#sat").text().toUpperCase() == value.day.toUpperCase()) {
                    $.each(groups, function (index, item) {
                        if ($('#headTable #group' + index).text() == value.group) {
                            for (var i = 1; i < 6; i++) {
                                if ($('#s' + i).text() == value.couple_number) {
                                    $('#sa' + i + ' .td' + index).text(value.item + ', '+ value.teacher);
                                }
                            }
                            ;
                        }
                    });                }
            });
        }

    });


</script>

</body>
</html>