@extends('layouts.app')

@section('content')

    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Розклад</h1>
                    <p class="text-white link-nav"><a href="/">Головна</a> <span
                                class="lnr lnr-arrow-right"></span> <a href="contact.html">Розклад</a></p>
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
                                <th>ID</th>
                                <th>Название</th>
                                <th>Категория</th>
                                <th>Теги</th>
                                <th>Картинка</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Как изучить Laravel на основе Блога?
                                </td>
                                <td>Обучение</td>
                                <td>Laravel, PHP</td>
                                <td>
                                    <img src="../assets/dist/img/boxed-bg.jpg" alt="" width="100">
                                </td>
                                <td><a href="edit.html" class="fa fa-pencil"></a> <a href="#" class="fa fa-remove"></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Работа на фрилансе
                                </td>
                                <td>Работа</td>
                                <td>Фриланс, Upwork</td>
                                <td>
                                    <img src="../assets/dist/img/photo1.png" alt="" width="100">
                                </td>
                                <td><a href="edit.html" class="fa fa-pencil"></a> <a href="#" class="fa fa-remove"></a></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                <!-- /.box-body -->
                <div class="form-group">
                    <a href="create.html" class="genric-btn primary">Скачать PDF</a>
                    <a href="create.html" class="genric-btn primary" >Скачать Excel</a>
                    <a href="create.html" class="genric-btn primary" >Скачать Png</a>
                </div>
            </div>
    </section>
    <!-- End contact-page Area -->
    <button class="genric-btn primary" style="float: right;">Send Message</button>

@endsection