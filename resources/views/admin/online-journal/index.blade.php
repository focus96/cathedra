<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.7/dist/sweetalert2.all.min.js"></script>
    <style type="text/css">

        i {
            font-family: fontawesome !important;
            font: normal normal normal 14px/1 FontAwesome !important;
            margin-left: 5px;
        }

        .yellowquote {
            background: #FFD700;
            color: #ff0000;
        }

        .redquote {
            background: #FF6347;
            color: #ffffff;
        }

        .yellow {
            background: #FFD700;
        }

        .red {
            background: #FF6347;
        }

        blockquote {
            border-left: .25em solid #dfe2e5;
            color: #6a737d;
            padding: 0 1em;
        }

        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell,
            "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .is-invalid {
            border-color: #e3342f;
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            @if (count($errors) > 0)
            $('#basicModal').modal('show');
            @endif
        });
    </script>
</head>
<body>
<div>
    @if((int)$journal->is_close === 0)
        <div class="row mb-4">
            <div class="col text-left">
                <a href="#" id="btnAddCol" class="btn btn-primary" data-toggle="modal" data-target="#basicModal"
                   style="margin-left: 15px;">Добавить
                    контрольную точку</a>
            </div>
        </div>
    @else
    @endif
    <table id="student_points">
        @if((int)$journal->is_close === 0)
            <caption>Журнал № {{ $journal->id }} Статус: Открыт</caption>
        @else
            <caption>Журнал № {{ $journal->id }} Статус: Закрыт</caption>
        @endif
        <tr>
            <th>{{ $journal->groupRelation->name_group }}</th>
            @foreach($journal->checkpoints as $checkpoint)
                <th>
                    {{ $checkpoint->name }}
                    @if((int)$journal->is_close === 0)
                        <a href="/admin/checkpoints/{{ $checkpoint->id }}/edit"><i class="far fa-edit" title="Редактировать"></i></a>
                        <a href="#" title="Удалить" class="delete"><i class="fa fa-trash"></i></a>
                    @else
                    @endif
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

                    <form id="delete" method="POST" action="{{ route('checkpoint_delete', $checkpoint->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                    </form>

                @endforeach
            </tr>
        @endforeach
    </table>
    <br>
    <div class="alert alert-danger" style="display:none"></div>
</div>

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
                                                Отмена
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

@if((int)$journal->is_close === 0)
    <script type="text/javascript">

        var deleteLinks = document.querySelectorAll('.delete');

        for (var i = 0; i < deleteLinks.length; i++) {
            deleteLinks[i].addEventListener('click', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Удалить контрольную точку?',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Отмена!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!'
                }).then((result) => {
                    if (result.value) {
                        $('form#delete').submit();
                        Swal.fire(
                            'Удалено!',
                            'Контрольная точка была удалена.',
                            'success',
                        )
                    }
                });
            });
        }

        //при нажатии на ячейку таблицы с классом edit
        $('td.edit').dblclick(function () {
            //находим input внутри элемента с классом ajax и вставляем вместо input его значение
            $('.ajax').html($('.ajax input').val());
            //удаляем все классы ajax
            $('.ajax').removeClass('ajax');
            //Нажатой ячейке присваиваем класс ajax
            $(this).addClass('ajax');
            //внутри ячейки создаём input и вставляем текст из ячейки в него
            $(this).html('<input id="editbox" size="' + $(this).text().length + '" type="text" value="' + $(this).text() + '" />');
            //устанавливаем фокус на созданном элементе
            $('#editbox').focus();
        });

        //определяем нажатие кнопки на клавиатуре
        $('td.edit').keydown(function (event) {
            //проверяем какая была нажата клавиша и если была нажата клавиша Enter (код 13)
            if (event.which == 13) {
                $('.ajax').html($('.ajax input').val());
                $('.ajax').removeClass('ajax');
            }
        });

        //сохранение при нажатии вне поля
        $(document).on('blur', '#editbox', function () {
            saveData($(this).closest('td'));
            $('.ajax').html($('.ajax input').val());
            $('.ajax').removeClass('ajax');
        });

        function saveData(el) {
            //получаем значение класса и разбиваем на массив
            //получаем такой массив - arr[0] = edit, arr[1] = наименование столбца (points)
            let arr = el.attr('class').split(" ");
            //назначаем атрибуты для ячейки
            let studentId = el.attr('data-student-id');
            let journalId = el.attr('data-journal-id');
            let checkpointId = el.attr('data-checkpoint-id');
            let student_pointlId = el.attr('data-student_point-id');

            var d = new Date();
            var curr_date = (d.getDate() < 10 ? '0' : '') + d.getDate();
            var curr_month = ((d.getMonth() + 1) < 10 ? '0' : '') + (d.getMonth() + 1);
            var curr_year = d.getFullYear();

            let points_date = (curr_year + "-" + curr_month + "-" + curr_date);


            //получаем наименование таблицы, в которую будем вносить изменения
            var table = $('table').attr('id');
            //подготавливаем данные для отправки: points = введенное значение, field = название столбца, table = название таблицы
            var data = {
                points: $('.ajax input').val(),
                student_point_id: student_pointlId,
                field: arr[1],
                checkpoint_id: checkpointId,
                student_id: studentId,
                journal_id: journalId,
                table: table,
                points_date: points_date,
            };

            //выполняем ajax запрос методом POST
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/student_points',
                type: 'POST',
                data: data,
                //при удачном выполнении скрипта, производим действия
                success: function (data) {
                    //находим input внутри элемента с классом ajax и вставляем вместо input его значение
                    $('.ajax').html($('.ajax input').val());
                    //удаялем класс ajax
                    $('.ajax').removeClass('ajax');
                    if (data.errors) {
                        $.each(data.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    } else {
                        $('.alert-danger').html($('.alert-danger').val());
                        $('.alert-danger').removeClass('alert-danger');
                        Swal.fire({
                            position: 'top',
                            type: 'success',
                            title: 'Изменения сохранены',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        }

    </script>
@endif
    <br>
    <blockquote>
        <h4><i class="fas fa-exclamation-triangle"></i></h4>
        Если оценка подсвечивается <b class="yellowquote ">желтым</b> цветом - срок сдачи был просрочен.
        <b class="redquote">Красным</b> цветом - оценка просрочена и отсутствует.
    </blockquote>

</body>
</html>