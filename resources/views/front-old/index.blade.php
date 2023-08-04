@extends('layouts.app')
@section('content')
    <!--================Find Car Banner Area =================-->
    @livewire('front.index')
    <!--================End Find Car Banner Area =================-->

    <!--================Choose Area =================-->
    <section class="choose_area p_100">
        <div class="container">
            <div class="single_title text-center wow animated fadeInUp" data-wow-delay="0.2s">
                <h2>Why Choose <span>One Rent a Car</span></h2>
            </div>
            <div class="row choose_inner2 justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="choose_item wow animated fadeIn" data-wow-delay="0.2s">
                        <div class="icon">
                            <i class="icon-rent"></i>
                        </div>
                        <h4>Premium Rental Experience</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="choose_item wow animated fadeIn" data-wow-delay="0.4s">
                        <div class="icon">
                            <i class="icon-web"></i>
                        </div>
                        <h4>Manage Booking Online</h4>

                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="choose_item wow animated fadeIn" data-wow-delay="0.6s">
                        <div class="icon">
                            <i class="icon-rating"></i>
                        </div>
                        <h4>Rated by many users</h4>
                       {{-- <p>Working with over 900 companies in 160 countries, we can find </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Choose Area =================-->

    <!--================Car Drive Area =================-->
    @livewire('cars.available-cars')
    <!--================End Car Drive Area =================-->

{{--    <!--================Download App Area =================-->--}}
{{--    <section class="download_app_area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-5">--}}
{{--                    <div class="mobile_img">--}}
{{--                        <img class="wow animated fadeInUp" data-wow-delay="0.4s" src="img/mobile-1.jpg" alt="">--}}
{{--                        <img class="wow animated fadeInUp" data-wow-delay="0.8s" src="img/mobile-2.jpg" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-7">--}}
{{--                    <div class="download_text">--}}
{{--                        <h3>Download Our App Now</h3>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do them eiusmod tempor incididunt labore</p>--}}
{{--                        <a class="google wow animated fadeInLeft" data-wow-delay="0.4s" href="#"><img src="img/google-play.png" alt=""></a>--}}
{{--                        <a class="os wow animated fadeInLeft" data-wow-delay="0.6s" href="#"><img src="img/os.png" alt=""></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!--================End Download App Area =================-->

    <!--================Question Area =================-->
    <section class="top_question_area p_100">
        <div class="container">
            <div class="single_title text-center wow animated fadeInUp" data-wow-delay="0.2s">
                <h2>Top <span>Questions</span></h2>
            </div>
            <div class="top_ques_inner">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                When do I get charged for a ride?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                The payment will be at the moment you receive the vehicle.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Can I pay for an rental with cash?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                Yes, the rental can be paid with cash with Euro, or with national Macedonian currency (Denar)
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Can I pay for an rental with credit card or online?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                We accept payments with credit cards. At the moment we cannot accept online payments ( very soon it will be available for your service)
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingfour">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                Can I get a ride from an airport?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample">
                            <div class="card-body">
                                The Car can be picked up at the Airports location.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Question Area =================-->
@endsection


{{-- @section('js')
    @if(Session::has('success'))
        <script>
            Swal.fire(
                'Your Reservation is completed',
                'Please check your email with information about your booking',
                'Ok'
            )
        </script>
    @endif --}}
    {{-- <script>
        $(document).ready(function() {
            $('.datetimepicker-input').attr('autocomplete','off');
            $(document).ready(function() {
                $('#from_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                    minDate: moment(),
                    locale: 'en',
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    }
                });
            })
        });
    </script> --}}
{{-- @endsection --}}
