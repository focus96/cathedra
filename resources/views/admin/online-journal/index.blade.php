<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        .is-invalid {
            border-color: #e3342f;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        @if (count($errors) > 0)
            $('#basicModal').modal('show');
        @endif
        });
    </script>
</head>
<body>
<div>
    <form action="">
        <table border>
            @if($journal->is_close === 0)
                <caption>Журнал № {{ $journal->id }} Статус: Открыт</caption>
            @else
                <caption>Журнал № {{ $journal->id }} Статус: Закрыт</caption>
            @endif

            <div class="row mb-4">
                <div class="col text-left">
                    <a href="#" id="btnAddCol" class="btn btn-primary" data-toggle="modal" data-target="#basicModal"
                       style="margin-left: 15px;">Добавить
                        контрольную точку</a>
                </div>
            </div>

            <thead>
            <tr>
                <th>{{ $group->name_group }}</th>
                    @foreach($checkpoints as $checkpoint)
                        <td>
                            {{ $checkpoint->name }}
                            <a href="/admin/checkpoints/{{ $checkpoint->id }}/edit">Ред</a>
                            <span>\</span>
                            <a class="delete" data-confirm="Удалить контрольную точку?" href="/admin/checkpoints/delete/{{ $checkpoint->id }}">Удалить</a>
                        </td>
                    @endforeach
            </tr>
            </thead>
            <tfoot>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->surname }}</td>
                    @foreach($student_points as $student_point)
                        @if($student_point->student_id === $student->id)
                            <td>{{ $student_point->points }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tfoot>
            <tbody>

            </tbody>
        </table>
    </form>
</div>
{{--{{ dump($errors) }}--}}

<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Добавление контрольной точки</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Ошибка!</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="modal-body">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ route('checkpoints') }}" method="post">
                                        @csrf

                                        <label for="name">Наименование контрольной точки</label>
                                        <input type="text" name="name" value="{{old('name')}}"
                                               id="name" placeholder="Введите наименование контрольной точки"
                                               class="
                                                   form-control {{ ($errors->has('name') ? 'is-invalid': '') }}">

                                        @if($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                        <br>
                                        <input type="hidden" name="journal_id" value="{{ $journal->id }}"><br>
                                        <label for="max_point">Максимальная оценка</label>
                                        <input type="number" name="max_point" value="{{old('max_point')}}"
                                               placeholder="Введите максимальную оценку" class="
                                                   form-control {{ ($errors->has('max_point') ? 'is-invalid': '') }}">

                                        @if($errors->has('max_point'))
                                            {{ $errors->first('max_point') }}
                                        @endif
                                        <br>
                                        <label for="date">Дата проведения</label>
                                        <input type="date" name="date" value="{{old('date')}}" class="
                                                   form-control {{ ($errors->has('date') ? 'is-invalid': '') }}">

                                        @if($errors->has('date'))
                                            {{ $errors->first('date') }}
                                        @endif
                                        <br>
                                        <label for="deadline">Дата последней сдачи контрольной точки</label>
                                        <input type="date" name="deadline" value="{{old('deadline')}}" class="
                                                   form-control {{ ($errors->has('deadline') ? 'is-invalid': '') }}"><br>

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

<script>
    $('#btnAddCol').click(function () {
        $("tr").append("<td>New Column</td>");
    });

    var deleteLinks = document.querySelectorAll('.delete');

    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                window.location.href = this.getAttribute('href');
            }
        });
    };


</script>

</body>
</html>