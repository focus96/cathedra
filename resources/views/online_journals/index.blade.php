<style>
    .push li{
        font-family: "Trebuchet MS", "Lucida Sans";
        padding: 7px 20px;
        margin-bottom: 10px;
        border-radius: 5px;
        border-left: 10px solid #f05d22;
        box-shadow: 2px -2px 5px 0 rgba(0,0,0,.1);
        font-size: 20px;
        transition: 0.4s all linear;
    }
    .push li:hover {
        border-left: 10px solid transparent;
    }
    .push li:hover {
        border-right: 10px solid #f05d22;
    }
    .push li a{
        color: #04091e;
    }
    .genric-btn{
        line-height: 30px;
    }
    .banner-area{
        background: url(../img/baner2.jpg) right;
    }

</style>

@extends('layouts.app')

@section('content')
    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <style>
            .genric-btn{
                line-height: 30px;
            }
            .banner-area{
                background: url(../img/baner2.jpg) right;
            }
        </style>
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Онлайн-журнали</h1>
                    <p class="text-white link-nav"><a href="/">Головна</a> </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 -flex flex-column address-wrap">
                    <h3>Список групп:</h3>
                </div>
            </div>
            <div class="col-md-3">
                <ul class="push">
                    @foreach($groups as $group)
                        <li ><a  href="/online_journals/show_group/{{ $group->id }}">{{ $group->name_group }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection