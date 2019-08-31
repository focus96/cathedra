@extends('layouts.app')

@section('content')
    <section class="v-title text-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12 mb-100 mt-100">
                    @if($confirm)
                        <h1>Спасибо! Подписка оформлена</h1>
                    @else
                        <h1>Токен не соответсвует. Подписка не оформлена</h1>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection