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
    <div class="main_contact_inner trade_container zoom-anim-dialog mfp-hide" id="tradePopup">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="vehicle-tab" data-toggle="tab" href="#vehicle" role="tab" aria-controls="vehicle" aria-selected="true">Vehicle Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Detials</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
                <form class="row contact_form form_trade" action="#" method="post">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="model2" name="model2" placeholder="Model">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="year" name="year" placeholder="Build Year">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Transmission">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Mileage">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="number" class="form-control" id="pin" name="pin" placeholder="PIN">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="color" name="color" placeholder="Exterior color">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="color2" name="color2" placeholder="Interior color">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="owner" name="owner" placeholder="Owner">
                    </div>
                    <div class="form-group col-md-12">
                        <div class='file-input'>
                            <p>Upload Vehicle Pictures Here :</p>
                            <input type='file'>
                            <span class='button'>Choose File</span>
                            <span class='label' data-js-label>No File chosen</span>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" value="submit" class="btn submit_btn red form-control">Continue</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <form class="row contact_form form_trade" action="#" method="post">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="name3" name="name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="phone4" name="phone4" placeholder="Phone">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="number" class="form-control" id="email4" name="email4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control" name="messages" id="messages" rows="1" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" value="submit" class="btn submit_btn red form-control">Submit Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
    <!--================End Product Details Area =================-->

