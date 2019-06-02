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
<div class="mytable">
    <div class="container">
        @if($journal->is_close === "0")
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
                                <td>{{ $point ? $point->points : '' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>