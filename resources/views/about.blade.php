@extends('layouts.app')

@section('content')
    <style>
        .banner-area{
            background: url(../img/baner2.jpg) right;
        }
    </style>
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Про нас
                    </h1>
                    <p class="text-white link-nav"><a href="/">Головна </a> <span
                                class="lnr lnr-arrow-right"></span> <a href="javasript:;">Кафедра</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start feature Area -->
    <section class="feature-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Навчання</h4>
                        </div>
                        <div class="desc-wrap">
                            <a href="http://www.dgma.donetsk.ua/abiturientu.html">Подивитися</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Склад кафедри</h4>
                        </div>
                        <div class="desc-wrap">
                            <a href="http://www.dgma.donetsk.ua/sklad-kafedri-kit.html">
                                Подивитися</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Життя кафедри</h4>
                        </div>
                        <div class="desc-wrap">
                            <a href="http://www.dgma.donetsk.ua/novini-kafedri-kit.html">Подивитися</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-feature">
                        <div class="title">
                            <h4>Історія кафедри</h4>
                        </div>
                        <div class="desc-wrap">
                            <a href="http://www.dgma.donetsk.ua/istoriya-kafedryi-kit.html">Подивитися</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End feature Area -->

    <!-- Start info Area -->
    <section class="info-area pb-120">
        @if(session('status'))
            <div class="alert alert-info">
                {{session('status')}}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 justify-content-center align-items-center d-flex relative">
                    <iframe width="470" height="315" src="https://www.youtube.com/embed/jI7RKKtozW4" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
                <div class="col-lg-6 info-area-right">
                    <h2>КАФЕДРА КОМП'ЮТЕРНИХ ІНФОРМАЦІЙНИХ ТЕХНОЛОГІЙ</h2>
                    <p>Здійснюємо підготовку бакалаврів з терміном навчання 4 роки та магістрів з терміном навчання 1,4 або 1,9 років

                        з галузі знань 12 «Інформаціні технології», за спеціальністю 122 «Комп'ютерні науки».
                    </p>
                    <p>

                        </p>
                    <br>
                    <p>Освітньо-професійни програми:
                    <ul>
                        <li>«Комп'ютерні науки в техниці та бізнесі»;</li>
                        <li>«Комп'ютерні науки в WEB-орієнтованих системах»;</li>
                        <li>«Комп'ютерні науки в медиціні».</li>
                    </ul></p>
                    <br>
                    <p>Специалист по автоматизированному управлению может работать на предприятиях в организациях и
                        фирмах по применению компьютерных и микропроцессорных систем для автоматизированного управления,
                        а также для сбора и обработки информации, быть научным сотрудником или преподавателем ВУЗа.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End info Area -->

    <!-- Start course-mission Area -->
    <section class="course-mission-area pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h2 class="mb-10">
                            Випускник кафедри КІТ може займати посади:
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 accordion-left">

                    <!-- accordion 2 start-->
                    <dl class="accordion">
                        <dt>
                            <a href="">В компаніях розробниками програмного забезпечення</a>
                        </dt>
                        <dd>
                            Процес, спрямований на створення та підтримку працездатності, якості та надійності програмного забезпечення, використовуючи технології, методологію та практики з інформатики, керування проектами, математики, інженерії та інших областей знання.
                        </dd>
                        <dt>
                            <a href="">Аналітиками ІТ-бізнесу / інженерами комп'ютерних систем</a>
                        </dt>
                        <dd>
                            Бізнес-аналітик в ІТ – це спеціаліст, який вміє перетворити невизначеність, ідею чи абстракцію на перелік однозначних, зрозумілих та задокументованих задач, які допоможуть бізнесу досягти поставлених цілей.
                        </dd>
                        <dt>
                            <a href="">Інженерами-програмістами</a>
                        </dt>
                        <dd>
                            Інженер що застосовує принципи програмної інженерії до проектування, розробки, тестування та оцінки програмного забезпечення та комп'ютерних систем.
                        </dd>
                        <dt>
                            <a href="">Cистемними адміністраторами</a>
                        </dt>
                        <dd>
                            Працівник, посадові обов'язки якого передбачають забезпечення роботи комп'ютерної техніки, комп'ютерної мережі і програмного забезпечення в організації. Інша назва — сисадмін, sysadmin (прийшла з комп'ютерного сленгу). Системний адміністратор може бути, в залежності від розміру організації, або працівником підрозділу інформаційних технологій, або окремою штатною одиницею.
                        </dd>
                        <dt>
                            <a href="">Інженерами з тестування</a>
                        </dt>
                        <dd>
                            Це фахівець із забезпечення якості, діяльність якого спрямована на поліпшення процесу розробки ПЗ, запобігання дефектам і виявлення помилок в роботі продукту.
                            Основне завдання QA – забезпечення якості. QA-інженер фокусує увагу на процесах розробки ПЗ, покращує їх, запобігає появі дефектів і проблем.
                        </dd>
                        <dt>
                            <a href="">Спеціаліст з інформаційної безпеки</a>
                        </dt>
                        <dd>
                            Підключення до Інтернету, організація телекомунікаційних систем, локальні мережі та мобільний зв'язок допомагають у бізнесі. Однак відразу виникає ризик витоку інформації. А значить, з'являється потреба у фахівцях з інформаційної безпеки

                        </dd>
                    </dl>
                    <!-- accordion 2 end-->
                </div>
                <div class="col-md-6 justify-content-center align-items-center d-flex relative">
                    <img class="img-fluid" src="img/kit.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End course-mission Area -->

    <!-- Start info Area -->
    <section class="info-area pb-120">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 info-area-right">
                    <h2>КАФЕДРА АВТОМАТИЗАЦІЇ ВИРОБНИЧІХ ПРОЦЕСІВ</h2>
                    <p>
                        Діяльність фахівця з автоматичного управління цікава і багатогранна, проте вимагає великої ерудиції і професійних знань в областях математики, фізики, механіки, інформатики та обчислювальної техніки, систем програмування.
                    </p>
                    <br>
                    <p>
                        Знання, отримані за фахом, дозволяють поглянути на світ іншими очима, а також набути впевненості, що ти людина майбутнього з цікавою, творчої і затребуваною часом професією.

                        ЯКУ РОБОТУ МОЖЕ ВИКОНУВАТИ СПЕЦІАЛІСТ?
                    </p>
                    <br>
                    <p>

                        Виробничі функції, що виконуються фахівцями з автоматизованого управління досить великі - від розробки систем автоматизації та створення програмного забезпечення до моделювання та дослідження процесів управління і розробки принципово нових систем управління
                    </p>
                </div>
                <div class="col-md-6 justify-content-center align-items-center d-flex relative">
                    <iframe width="470" height="315" src="https://www.youtube.com/embed/6Xjoj_mgXz4" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- End info Area -->
    <!-- Start course-mission Area -->
    <section class="course-mission-area pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h2 class="mb-10">
                            Випускник АВП може займати посади:
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 accordion-left">

                    <!-- accordion 2 start-->
                    <dl class="accordion">
                        <dt>
                            <a href="">Інженер з експлуатації та ремонту систем автоматичного управління</a>
                        </dt>
                        <dd>
                            Виконання поточних, капітальних та аварійних ремонтів, систем ТВС, вентиляції та кондиціонування адміністративно-побутових і виробничих об'єктів.
                            Розробка і ведення експлуатаційної тех. документації (технічні паспорти, експлуатаційні журнали.
                        </dd>
                        <dt>
                            <a href="">Інженер-конструктор систем автоматичного управління</a>
                        </dt>
                        <dd>
                            Контроль працездатності серверів і допоміжного обладнання.
                            Консультування нових клієнтів по послугах, що надаються.
                        </dd>
                        <dt>
                            <a href="">Інженер-дослідник автоматизованих систем управління (АСУ)</a>
                        </dt>
                        <dd>
                            Пошук і усунення проблем технічного і не технічного характеру, що виникають у клієнтів компанії в роботі з послугами
                            Інформування відповідальних співробітників про неполадки (в разі неможливості самостійного вирішення проблеми).
                        </dd>
                        <dt>
                            <a href="">Інженер-програміст з розробки прикладного програмного забезпечення</a>
                        </dt>
                        <dd>
                            Розробка нових прикладних рішень,підтримка існуючих інформаційних систем замовників.
                            Проектування доробок і написання програмного коду за технічними завданнями.
                            Створення технічної документації по розробленим функціональним блокам
                        </dd>
                    </dl>
                    <!-- accordion 2 end-->
                </div>
                <div class="col-md-6 justify-content-center align-items-center d-flex relative">
                    <iframe width="470" height="315" src="https://www.youtube.com/embed/6Xjoj_mgXz4" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- End course-mission Area -->


    <section class="cta-two-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 cta-left">
                    <h1>Цікаво дізнатися ще більше?</h1>
                </div>
                <div class="col-lg-4 cta-right">
                    <a class="primary-btn wh" href="/news">Подивитися</a>
                </div>
            </div>
        </div>
    </section>
@endsection