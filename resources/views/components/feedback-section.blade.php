<section class="search-course-area relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-6 search-course-left">
                <h1 class="text-white">
                    Є питання? <br>
                    Надішліть його нам!
                </h1>
                <p>
                    Ми пілкуємся про наших абітурієнтів, та завжди раді відповісти на всі ваші запитання.
                    Надішліть нам форму зворотнього зв'язку, та ми обов'язково підготуємо відповідь для Вас!
                </p>
                {{--<div class="row details-content">--}}
                {{--<div class="col single-detials">--}}
                {{--<span class="lnr lnr-graduation-hat"></span>--}}
                {{--<a href="#"><h4>Expert Instructors</h4></a>--}}
                {{--<p>--}}
                {{--Usage of the Internet is becoming more common due to rapid advancement of technology and--}}
                {{--power.--}}
                {{--</p>--}}
                {{--</div>--}}
                {{--<div class="col single-detials">--}}
                {{--<span class="lnr lnr-license"></span>--}}
                {{--<a href="#"><h4>Certification</h4></a>--}}
                {{--<p>--}}
                {{--Usage of the Internet is becoming more common due to rapid advancement of technology and--}}
                {{--power.--}}
                {{--</p>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="col-lg-4 col-md-6 search-course-right section-gap">
                <form class="form-wrap" id="feedback" action="{{ route('feedback') }}" method="post">
                    @csrf
                    <h4 class="text-white pb-20 text-center mb-30">Форма зворотнього зв'язку</h4>
                    <input type="text" class="form-control" name="name" placeholder="Ім'я"
                           onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ім\'я'">
                    @if($errors->has('name'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <input type="text" class="form-control" name="contact" placeholder="Телефон або email"
                           onfocus="this.placeholder = ''" onblur="this.placeholder = 'Телефон або email'">
                    @if($errors->has('contact'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('contact') }}
                        </div>
                    @endif
                    <textarea name="message" class="form-control" placeholder="Питання" id="" rows="3"></textarea>
                    @if($errors->has('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                    <button class="primary-btn text-uppercase">Надіслати</button>
                    <br>
                    <br>
                    @if(session('messageFeedback'))
                        <div class="alert alert-success" role="alert">
                            {{ session('messageFeedback') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
