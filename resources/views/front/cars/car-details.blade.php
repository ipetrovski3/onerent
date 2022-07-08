@extends('layouts.app')
@section('content')
    <section class="breadcrumb_area" style="background: url(img/breadcrumb/breadcrumb-bg-3.jpg)">
        <div class="container">
            <div class="breadcrumb_inner">
                <div class="link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="#">Car</a>
                </div>
            </div>
        </div>
    </section>
    <!--================End Breadcrumb Area =================-->

    <!--================Product Details Area =================-->
    <section class="product_details_area p_100">
        <div class="container">
            <div class="row product_details_inner">
                <div class="col-lg-8">
                    <div class="product_details_left">
                        <div class="price_title d-flex justify-content-between">
                            <div class="left">
                                <h3>{{ $car->brand_and_model() }}</h3>
                            </div>
                            <div class="right">
                                <h4> &euro; {{ $car->ppd }} daily</h4>
                            </div>
                        </div>

                        <div class="product_d_slider">
                            <div class="product_main_slider">
                                <div class="item">
                                    <img src="{{ asset('storage/cars/' . $car->model->image) }}" style="max-width: 100%" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product_list_right">

                        <a class="main_btn red popup-with-zoom-anim" href="#tradePopup">Book This Car</a>
                        <ul class="nav flex-column">
                            <li><a href="#"><i class="icon-gear1"></i>Transmission <span>{{ $car->transmissions[$car->transmission_type] }}</span></a></li>
                            <li><a href="#"><i class="icon-engine"></i>Engine Type <span>{{ $car->engines[$car->engine_type] }}</span></a></li>
                            <li><a href="#"><i class="icon-seat"></i>Seat <span>{{ $car->max_passengers }}</span></a></li>
                            <li><a href="#"><i class="icon-snowflake-o"></i>AC
                                <span class="text-{{ $car->ac ? 'success' : 'danger'}}">
                                    <i class="{{ $car->ac ? 'icon-check' : 'icon-times' }}"></i>|
                                </span>
                            </a></li>
                            <li><a href="#"><i class="icon-map_marker"></i>Navi
                                <span class="text-{{ $car->navigation ? 'success' : 'danger'}}">
                                    <i class="{{ $car->navigation ? 'icon-check' : 'icon-times' }}"></i>|
                                </span>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="product_overview_text">
                <h4>Overview</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do them and eiusmod tempor incididunt labore dolorie magna aliqua. Ut enim adoren minim venim quis nostrud exercitation. Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat</p>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="nav flex-column">
                            <li><img src="img/icon/green.png" alt="">Strong engine options, including a plug-in hybrid</li>
                            <li><img src="img/icon/green.png" alt="">Standard adaptive air suspension delivers a comfortable</li>
                            <li><img src="img/icon/green.png" alt="">Exceptional rear passenger space</li>
                            <li><img src="img/icon/green.png" alt="">Abundant standard equipment, including safety tech</li>
                            <li><img src="img/icon/green.png" alt="">No standard-length wheelbase model available</li>
                            <li><img src="img/icon/green.png" alt="">Not the driver-focused benchmark it once was</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav flex-column">
                            <li><img src="img/icon/green.png" alt="">Strong engine options, including a plug-in hybrid</li>
                            <li><img src="img/icon/green.png" alt="">Standard adaptive air suspension delivers a comfortable</li>
                            <li><img src="img/icon/green.png" alt="">Exceptional rear passenger space</li>
                            <li><img src="img/icon/green.png" alt="">Abundant standard equipment, including safety tech</li>
                            <li><img src="img/icon/green.png" alt="">No standard-length wheelbase model available</li>
                            <li><img src="img/icon/green.png" alt="">Not the driver-focused benchmark it once was</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
    <!--================End Product Details Area =================-->

