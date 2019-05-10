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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#basicModal').modal('show');
        });

        $(document).ready(function(){
            @if (count($errors) > 0)
            $('#basicModal').modal('show');
            @endif
        });
    </script>
</head>
<body>

<div class="row mb-4">
    <div class="col text-center" style="margin-top: 150px;">
        <a href="#" id="btnAddCol" class="btn btn-primary" data-toggle="modal" data-target="#basicModal"
           style="margin-left: 15px;">Редактировать
            контрольную точку</a>
    </div>
</div>

<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Редактирование контрольной точки</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

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

            </div>

            <div class="modal-body">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ route('checkpoints_update', $checkpoint->id) }}" method="post">
                                        @csrf

                                        <label for="name">Наименование контрольной точки</label>
                                        <input type="text" name="name" value="{{$checkpoint->name}}"
                                               id="name" placeholder="Введите наименование контрольной точки"
                                               class="
                                                   form-control {{ ($errors->has('name') ? 'is-invalid': '') }}">

                                        @if($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                        <br>
                                        <input type="hidden" name="journal_id" value="{{ $checkpoint->journal_id }}">
                                        <input type="hidden" name="$checkpoint->id" value="{{ $checkpoint->id }}">
                                        <label for="max_point">Максимальная оценка</label>
                                        <input type="number" name="max_point" value="{{$checkpoint->max_point}}"
                                               placeholder="Введите максимальную оценку" class="
                                                   form-control {{ ($errors->has('max_point') ? 'is-invalid': '') }}">

                                        @if($errors->has('max_point'))
                                            {{ $errors->first('max_point') }}
                                        @endif
                                        <br>
                                        <label for="date">Дата проведения</label>
                                        <input type="date" name="date" value="{{$checkpoint->date}}" class="
                                                   form-control {{ ($errors->has('date') ? 'is-invalid': '') }}">

                                        @if($errors->has('date'))
                                            {{ $errors->first('date') }}
                                        @endif
                                        <br>
                                        <label for="deadline">Дата последней сдачи контрольной точки</label>
                                        <input type="date" name="deadline" value="{{$checkpoint->deadline}}" class="
                                                   form-control {{ ($errors->has('deadline') ? 'is-invalid': '') }}">

                                        @if($errors->has('deadline'))
                                            {{ $errors->first('deadline') }}
                                        @endif
                                        <br>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Закрыть
                                            </button>
                                            <button type="submit" class="btn btn-primary">Редактировать</button>
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