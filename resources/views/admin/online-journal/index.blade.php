<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <table border>
        @if($journal->is_close === 0)
            <caption>Журнал № {{ $journal->id }} Статус: Открыт</caption>
        @else
            <caption>Журнал № {{ $journal->id }} Статус: Закрыт</caption>
        @endif
        <thead>
        <tr>
            <th>{{ $group->name_group }}</th>
        </tr>
        </thead>
        <tfoot>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->surname }}</td>
            </tr>
        @endforeach
        </tfoot>
        <tbody>

        </tbody>
    </table>
</div>

<div class="container">
{{--{{ dump($errors) }}--}}

    <div class="row mb-4">
        <div class="col text-center">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#basicModal">Добавить
                контрольную точку</a>
        </div>
    </div>
    <br>
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Добавление контрольной точки</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">

                                        <form action="{{ route('checkpoints') }}" method="post">
                                            @csrf

                                            <input type="text" name="name" value="{{old('name')}}"
                                                   id="name" placeholder="Введите наименование контрольной точки" class="
                                                   form-control {{ ($errors->has('name') ? 'is-invalid': '') }}"><br>
                                            <input type="hidden" name="journal_id" value="{{ $journal->id }}"><br>
                                            <input type="number" name="max_point" value="{{old('max_point')}}"
                                                   placeholder="Введите максимальную оценку"  class="
                                                   form-control {{ ($errors->has('max_point') ? 'is-invalid': '') }}"><br>
                                            <label for="date">Дата проведения</label>
                                            <input type="date" name="date" value="{{old('date')}}" class="
                                                   form-control {{ ($errors->has('date') ? 'is-invalid': '') }}"><br>
                                            <label for="deadline">Дата последней сдачи контрольной точки</label>
                                            <input type="date" name="deadline" value="{{old('deadline')}}" class="
                                                   form-control {{ ($errors->has('deadline') ? 'is-invalid': '') }}"><br>

                                            @if($errors->has('name'))
                                                {{ $errors->first('name') }}
                                            @endif

                                            @if($errors->has('max_point'))
                                                {{ $errors->first('max_point') }}
                                            @endif

                                            @if($errors->has('date'))
                                                {{ $errors->first('date') }}
                                            @endif

                                            @if($errors->has('deadline'))
                                                {{ $errors->first('deadline') }}
                                            @endif

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Закрыть
                                                </button>
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>
</html>