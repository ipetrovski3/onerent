@extends('layouts.app')
@section('content')

    <div class="preloader">
        <div class="main-loader">
            <span class="loader1"></span>
            <span class="loader2"></span>
            <span class="loader3"></span>
        </div>
    </div>

    <!--================Breadcrumb Area =================-->
    {{-- <section class="breadcrumb_area" style="background: url({{ asset('images/carsall.jpeg') }})"> --}}
    <section>
        <div class="container">
            <div class="breadcrumb_inner">
                <h3>About us</h3>
                {{-- <div class="link">
                    <a href="#">Home</a>
                    <a href="#">About</a>
                </div> --}}
            </div>
        </div>
    </section>
    <!--================End Breadcrumb Area =================-->

    <!--================Market Area =================-->
    <section class="auto_market_area p_100">
        <div class="container">
            <div class="row market_inner">
                <div class="col-lg-6">
                    <div class="market_text">
                        <h3><img src="img/icon/flag-2.png" alt="">About Us</h3>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Our Mission</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Offer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Extras</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <p> Thank you for your interest for choosing One Rent a Car. </p>
                                <p>Here is a simple but powerful rule - we always give our costumer more than what he expect to get. We're a new car rental company in Macedonia. Our goal is to position on the market as a low cost rent a car company. We choose to care about our clients and to follow the world trends and standards. </p>
                                <p>
                                    Basis of our service is maximum quality at affordable prices.
                                    Many drivers choose a long-term rental over other methods of transportation such as buses, and taxi cabs because of the added convenience of having their own personal car.
                                    In addition to this, it can become quite costly relying solely on public transportation.
                                    With the great selection of cheap rental cars from One Rent a Car, you can choose a car similar to your own or try out something completely new. We can also offer you the extraordinary benefit to change the car model from our fleet proposal 2-3 times during your long time rental period. Get to know the area you are in by traveling at your own pace on your own time.
                                </p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <div class="d-flex">
                                                <i class="icon-car_2"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4>Best value for your money</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <div class="d-flex">
                                                <i class="icon-pricing"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4>Best Pricing</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <p> On your service we can offer you number of vehicles of differerent classes: The newest Audi A5, VW Passat, Skoda Octavia, VW Golf7, Opel Astra, VW Polo,Citroen C3, Ford Fiesta, VW UP and the commercial vehicle Opel Vivaro 8+1.</p>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <p> On your demand, we can also offer you a choffered passenger transfer. All you need is just to tell us your location. At One Rent a car we like to make things as easy as possible for our customers. Our home delivery service does just that by allowing you to have a car delivered and collected from your home address. Simply book online and enter your delivery and collection addresses then sit back and relax whilst we deliver to your door! Delivery and collection is available in Skopje.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="market_image">
                        <img class="img-fluid" src="{{asset('images/aboutcontent.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Market Area =================-->
    <!--================End Budget Feature Area =================-->
@endsection
