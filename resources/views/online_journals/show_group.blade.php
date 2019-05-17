
@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">

        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Розклад</h1>
                    <p class="text-white link-nav"><a href="/">Журнал</a> </p>
                    <p class="text-white link-nav"><a href="/online_journals">Група: {{ $group->name_group }}</a> </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->
    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-6s">
                    <table class="table table-bordered table-striped">
                    <tr>
                        <tr>
                            <th>Группа</th>
                            <th>Журнал</th>
                        </tr>
                        <td>
                            {{ $group->name_group }}
                        </td>
                        <td>
                            @foreach($online_journals as $online_journal)
                                @if($online_journal->is_public === 1)
                                    <a href="/online_journals/show_journal/{{ $online_journal->id }}">Журнал № {{ $online_journal->id }}, предмет: {{ $online_journal->item }}, преподаватель: {{ $online_journal->teacher }}, последние изменения: {{ $online_journal->updated_at }}</a>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    </table>
                </div>
                <style>

                    .menu-down{
                        margin-bottom: 10px;
                    }
                    a{
                        color: #77777f;
                    }
                    a:hover{
                        color: #f05d22;
                    }
                </style>
                <a class="genric-btn primary" href="/online_journals">Повернутися до списку груп</a>
            </div>
        </div>
    </section>

@endsection



