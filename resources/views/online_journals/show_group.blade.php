<style>
    .myjournals{
        margin-top: 130px;
        margin-left: 100px;
    }
    li {
        margin: 10px;
    }
</style>

@extends('layouts.app')

@section('content')

    <div class="myjournals">
        <h3>Группа: {{ $group->name_group }}</h3>

        <ol>
            @foreach($online_journals as $online_journal)
                @if($online_journal->is_public === 1)
                    <li><a href="/online_journals/show_journal/{{ $online_journal->id }}">Журнал № {{ $online_journal->id }}, предмет: {{ $online_journal->item }}, преподаватель: {{ $online_journal->teacher }}, последние изменения: {{ $online_journal->updated_at }}</a></li>
                @endif
            @endforeach
        </ol>
        <br>
        <a href="/online_journals">Вернуться к списку групп</a>
        <br>
        <br>
    </div>
@endsection



