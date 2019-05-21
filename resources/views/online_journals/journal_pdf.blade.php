<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Журнал</title>
</head>
<body>
<style type="text/css">
    .yellow {
        background: #ffff00;
        color: #ff0000;
    }

    .red {
        background: #ff0000;
        color: #ffffff;
    }
    body {
        font-family: DejaVu Sans, sans-serif;
    }

    table {
        font-size: 12px;
        border-radius: 10px;
        border-spacing: 0;
        text-align: center;
    }

    th, td:first-child {
        background: #AFCDE7;
        color: white;
        text-shadow: 0 1px 1px #2D2020;
        padding: 10px 20px;
    }

    th, td {
        border-style: solid;
        border-width: 0 1px 1px 0;
        border-color: white;
    }

    th:first-child, td:first-child {
        text-align: left;
    }

    th:first-child {
        border-top-left-radius: 10px;
    }

    th:last-child {
        border-top-right-radius: 10px;
        border-right: none;
    }

    td {
        padding: 10px 20px;
        _background: #c7c78f;
        background: #D8E6F3;
    }

    tr:last-child td:first-child {
        border-radius: 0 0 0 10px;
    }

    tr:last-child td:last-child {
        border-radius: 0 0 10px 0;
    }

    tr td:last-child {
        border-right: none;
    }
</style>
<div class="mytable">
    <div class="container">
        @if($journal->is_close === 0)
            <h4>Журнал № {{ $journal->id }} Статус: Открыт</h4>
        @else
            <h4>Журнал № {{ $journal->id }} Статус: Закрыт</h4>
        @endif
        <div class="col-md-12s">
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
                                                (!$point && ($checkpoint->deadline < now()))) ? 'red' : '' }} {{ (($point &&
                                                ($checkpoint->deadline < $point->created_at or
                                                $checkpoint->deadline < $point->updated_at)) &&
                                                ($point->points)) ? 'yellow' : '' }}">{{ $point ? $point->points : '' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <h4 class="lnr lnr-bubble">Підказка</h4>
            </div>
            <div class="col-md-6">
                <blockquote>
                    <q>
                        Якщо оцінка підсвічується <b class="yellow">жовтим</b> кольором - термін здачі був
                        прострочений.
                        <b class="red">Червоним</b> кольором - оцінка прострочена та відсутня.
                    </q>
                </blockquote>
            </div>
        </div>
    </div>
</div>
</body>
</html>