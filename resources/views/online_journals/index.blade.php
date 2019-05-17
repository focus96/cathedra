<style>
    .mygroup{
        margin-top: 130px;
        margin-left: 100px;
    }
    li {
        margin: 10px;
    }
</style>

@extends('layouts.app')

@section('content')

    <div class="mygroup">
        <h3>Список групп:</h3>
        <ol>
            @foreach($groups as $group)
                <li><a href="/online_journals/show_group/{{ $group->id }}">{{ $group->name_group }}</a></li>
            @endforeach
        </ol>
    </div>
@endsection