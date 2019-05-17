<style type="text/css">

    i {
        font-family: fontawesome !important;
        font: normal normal normal 14px/1 FontAwesome !important;
        margin-left: 5px;
    }

    .yellow {
        background: yellow;
    }

    .red {
        background: red;
    }

    body {
        font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell,
        "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    table {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
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

    .mytable{
        margin: 150px 100px;
    }
</style>

@extends('layouts.app')

@section('content')

    <div class="mytable">

<table id="student_points">
    @if($journal->is_close === 0)
        <caption>Журнал № {{ $journal->id }} Статус: Открыт</caption>
    @else
        <caption>Журнал № {{ $journal->id }} Статус: Закрыт</caption>
    @endif
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
<br><div class="yellow" style="width: 150px; height: 40px; text-align: center; padding-top: 10px; color: white; font-size: small;"><b>Оценка просрочена</b></div><br>
<div class="red" style="width: 150px; height: 40px; text-align: center; color: white; font-size: small;"><b>Оценка просрочена и отсутствует</b></div>
<br>
<a href="/online_journals/show_group/{{ $journal->groupRelation->id }}">Вернуться к списку журналов</a>
<br>
<br>
<a href="/online_journals">Вернуться к списку групп</a>
    </div>
@endsection