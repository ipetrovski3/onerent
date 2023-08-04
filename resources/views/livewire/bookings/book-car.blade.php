<div>
        {{-- @extends('layouts.app') --}}

    @section('content')
        <!--================Breadcrumb Area =================-->
        <section class="breadcrumb_area" style="background: url({{ asset('images/carsall.jpeg') }})">
            <div class="container">
                <div class="breadcrumb_inner">
                    <h3>Available cars</h3>
                    <div class="link">
                        <p>Requested Date: {{  $booking->from_date . ' - ' . $booking->to_date }}</p>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Breadcrumb Area =================-->

        <!--================Product Area =================-->
        <section class="main_product_area p_100">
            <div class="container">
                <div class="row main_product_inner flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="product_grid_inner">
                            <div class="row">
                                @foreach($cars as $car)
                                    <div class="col-lg-4 col-md-4 col-sm-6 wow animated fadeInUp" data-wow-delay="0.2s">
                                        <div class="l_collection_item shop_product_item orange grid_four red">
                                            <div class="car_img">
                                                <a href="#"><img class="img-fluid" src="{{ asset('storage/cars/' . $car->model->image) }}" alt=""></a>
                                                <div class="cart_option">
                                                    {{-- <a type="button" data-toggle="modal" data-target="#book_car" data-car_id="{{ $car->id }}" data-ppd="{{ $car->ppd }}">Book</a> --}}
                                                    <a type="button" data-toggle="modal" data-target="#book_car">Book</a>
                                                </div>
                                            </div>
                                            <div class="text_body">
                                                {{-- <a href="#"><h4>{{ $car->brand_and_model() }}</h4></a> --}}
                                                <div class="price">
                                                    <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&euro;</span>{{ number_format($car->ppd, 2) }}</span> per day</ins>
                                                </div>
                                                <ul class="nav">
                                                    <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $car->engines[$car->engine_type] }}</li>
                                                    <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $car->transmissions[$car->transmission_type] }}</li>
                                                    <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li>
                                                {{-- <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li> --}}
                                                </ul>
                                                <ul class="nav">
                                                    <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $car->engines[$car->engine_type] }}</li>
                                                    <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $car->transmissions[$car->transmission_type] }}</li>
                                                    <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li>
                                                    {{--                                        <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li>--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="shop_product_sidebar">

                        {{-- <aside class="r_widget news_widget"> --}}
                            {{-- <div class="r_title"> --}}
                                {{-- <h3>Info</h3> --}}
                            {{-- </div> --}}
                            {{-- <div class="news_inner"> --}}
                                {{-- <p> --}}
                                    {{-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. --}}
                                    {{-- Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, --}}
                                    {{-- when an unknown printer took a galley of type and scrambled it to make a type specimen book. --}}
                                    {{-- It has survived not only five centuries, but also the leap into electronic typesetting, --}}
                                    {{-- remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset --}}
                                    {{-- sheets containing Lorem Ipsum passages, and more recently with desktop publishin --}}
                                {{-- </p> --}}
                            {{-- </div> --}}
                        {{-- </aside> --}}


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Product Area =================-->


        {{-- <div>
            <!-- Button to open the modal -->
            <button type="button" wire:click="openModal({{ $car->id }})" data-toggle="modal" data-target="#book_car">Book</button>
        
            <!-- Modal -->
            <div class="modal fade" id="book_car" tabindex="-1" role="dialog" aria-labelledby="book_car_label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="book_car_label">Book Car</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Display the car ID and price per day -->
                            <p>Car ID: </p>
                            <p>Price per day: </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Close</button>
                            <!-- Add any additional buttons or actions -->
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}



    @endsection

    <div wire:ignore.self class="modal fade" id="book_car" tabindex="-1" role="dialog" aria-labelledby="book_car" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h5 class="modal-title">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form wire:submit="bookCar"> --}}
                {{-- <form action="{{ route('clients.create') }}" id="submit_form" method="POST"> --}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="from" class="form-label">From Date</label>
                                <input disabled id="from" type="text" class="form-control" value="{{ $booking->from_date }}">
                            </div>
                            <div class="col-6">
                                <label for="to" class="form-label">To Date</label>
                                <input disabled id="to"type="text" class="form-control" value=" {{ $booking->to_date }}">
                            </div>
                        </div>
                        <hr>
                        @if (isset($car))
                            <p class="font-weight-bold" style="margin-bottom: 3px">{{ $car->model->brand['name'] }} {{ $car->model['name'] }}</p>
                            <p id="summary" class="font-weight-bold">Total Cost: {{ $car->ppd }}</p>
                        @endif
                    </div>
                    {{-- @csrf --}}
                    {{-- <p type="hidden" name="car_id">{{ $car_id = $car->id }}</p> --}}
                    {{-- <input type="hidden" id="booking_id" name="booking_id" value="{{ $booking ?? ''->id }}">
                    <input type="hidden" name="pick_up" value="{{ $booking ?? ''->pick_up_id }}">
                    <input type="hidden" name="drop_off" value="{{ $booking ?? ''->drop_off_id }}">
                    <input type="hidden" name="from_date" value="{{ $booking ?? ''->from_date }}">
                    <input type="hidden" name="to_date" value="{{ $booking ?? ''->to_date }}"> --}}
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col">
                                <input wire:model.defer="first_name" type="text" class="form-control" name="first_name" placeholder="First name">
                            </div>
                            <div class="col">
                                <input wire:model.defer="last_name" type="text" class="form-control" placeholder="Last name" name="last_name">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <input wire:model.defer="email" type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col">
                                <input wire:model.defer="phone" type="number" name="phone" class="form-control" placeholder="Telephone Number">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <input wire:model.defer="personal_id" type="text" name="personal_id" class="form-control" placeholder="Passport Number">
                            </div>
                            <div class="col">
                                <input wire:model.defer="address" type="text" name="address" class="form-control" placeholder="Address">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <select wire:model.defer="country" class="form-control" name="country_id">
                                    <option value="" selected disabled>Select your country...</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <input id="terms" type="checkbox" checked>
                                <label for="terms">By checking this you are agreeing to our terms and conditions</label>
                            </div>
                        </div>
                    </div>

                    @if (isset($car))
                        <div class="modal-footer">
                            <button wire:click.prevent="bookCar({{ $booking->id }}, {{ $car->id }})" type="submit" id="confirm_reservation" class="submit_btn">Make Reservation</button>
                            <button type="button" class="btn booking_btn" data-dismiss="modal">Cancel</button>
                        </div>
                    @endif
                {{-- </form> --}}
            </div>
        </div>
    </div>
    
</div>
