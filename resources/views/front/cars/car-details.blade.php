@extends('layouts.app')
@section('content')
    <section class="breadcrumb_area" style="background: url({{ asset('images/cardetails.jpg') }})">
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
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
                        <a class="main_btn red popup-with-zoom-anim" data-car_id="{{ $car->id }}" data-car="{{ $car->brand_and_model() }}" data-ppd="{{ $car->ppd }}" id="book" href="#">Book This Car</a>
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
        </div>
    </section>
    <div class="modal fade" id="client_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('clients.create') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="from_cars" value="1">
                        <div>
                            <h4>Selected Dates</h4>
                            <label for="from_date" class="form-label">From Date:</label>
                            <input id="from_date" name="from_date" class="form-control" type="text" autocomplete="off">
                            <label for="to_date" class="form-label">To Date:</label>
                            <input id="to_date" name="to_date" class="form-control" type="text" autocomplete="off">
                        </div>
                        <div class="row mt-3">
                            @php
                                $locations = \App\Models\Location::all();
                            @endphp
                            <div class="col-6">
                                <label for="pick_up" class="form-label">Pick up location</label>
                                <select class="form-control" name="pick_up" id="pick_up">
                                    @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="drop_off" class="form-label">Drop off location</label>
                                <select class="form-control" name="drop_off" id="drop_off">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <p id="car_model" class="font-weight-bold" style="margin-bottom: 3px"></p>
                        <p id="summary" class="font-weight-bold">Total Cost:</p>
                        

                        {{-- <input type="hidden" id="booking_id" name="booking_id"> --}}
                        <input type="hidden" id="car_id" name="car_id" value="{{ $car->id }}">
                        <div class="row mb-4">
                            <div class="col">
                                <input type="text" class="form-control" name="first_name" placeholder="First name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Last name" name="last_name">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col">
                                <input type="number" name="phone" class="form-control" placeholder="Telephone Number">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <input type="text" name="personal_id" class="form-control" placeholder="Passport Number">
                            </div>
                            <div class="col">
                                <input type="text" name="address" class="form-control" placeholder="Address">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <select class="form-control" name="country_id" id="">
                                    @php
                                        $countries = \App\Models\Country::all();
                                    @endphp
                                    <option value="" selected disabled>Select your country...</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <input type="checkbox" checked class="form-control">
                                <label for="">By checking this you are agreeing to our terms and conditions</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="submit_btn">Make Reservation</button>
                        <button type="button" class="btn booking_btn" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

@section('js')
    <script>
        $(document).on('click', '#book', function (e) {
            e.preventDefault()
            let booking_id = $(this).data('booking_id')
            let summary = $(this).data('ppd')
            let car_model = $(this).data('car')
            let car_id = $(this).data('car_id')
            $('#car_model').text('Selected Vehicle: ' + car_model)
            // $('#summary').text( 'Total Cost: ' + (parseInt(days) * parseInt(summary)) + '\u20AC')
            $('#booking_id').val(booking_id)
            $('#car_id').val(car_id)
            $('#client_details').modal('show')
        })
    </script>
    <script>
        let disabled_days = @json($booked_days);
        $('#from_date').datetimepicker({
            disabledDates: disabled_days,
            formatDate: 'Y-m-d'
        });
        $('#to_date').datetimepicker({
            disabledDates: disabled_days,
            formatDate: 'Y-m-d'
        });
    </script>
@endsection

