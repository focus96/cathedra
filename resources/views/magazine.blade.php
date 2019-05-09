@extends('layouts.app')

@section('content')

    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Журнал</h1>
                    <p class="text-white link-nav"><a href="/">Головна</a> </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->


    <!-- Start contact-page Area -->
    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="col-md-12s">

                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Предмет</th>
                            <th>Група</th>
                            <th>Викладач</th>
                            <th>Контрольна точка</th>
                            <th>Оцінка</th>
                            <th>Дата проведення</th>
                            <th>Дата останньої здачі</th>
                            <th>Завантажити</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>

                            <td>
                                <a href="edit.html" class="fa fa-download"> PDF</a>
                                <a href="edit.html" class="fa fa-download"> Excel</a>
                                <a href="edit.html" class="fa fa-download"> Png</a>
                            </td>
                        </tr>

                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
                {{--<div class="form-group">--}}
                    {{--<a href="create.html" class="genric-btn primary">Скачать PDF</a>--}}
                    {{--<a href="create.html" class="genric-btn primary" >Скачать Excel</a>--}}
                    {{--<a href="create.html" class="genric-btn primary" >Скачать Png</a>--}}
                {{--</div>--}}
            </div>
    </section>
    <!-- End contact-page Area -->

@endsection