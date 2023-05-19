@extends('layouts.app')

@section('content')
    <!-- Button trigger modal -->

    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area" style="background: url({{ asset('images/carsall.jpeg') }})">
        <div class="container">
            <div class="breadcrumb_inner">
                <h3>Our cars</h3>
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
                        <div id="render_cars" class="row">
                            @foreach($cars as $car)
                            <div class="col-lg-4 col-md-4 col-sm-6 wow animated fadeInUp" data-wow-delay="0.2s">
                                <div class="l_collection_item shop_product_item orange grid_four red {{ $car->always_booked ? 'disabled-booking' : ''  }}">
                                    <div class="car_img">
                                        <a href="#"><img class="img-fluid" src="{{ asset('storage/cars/' . $car->model->image) }}" alt=""></a>
                                        <div class="cart_option">
                                            <a href="#" id="reservation_modal" class="book_car" data-car_id="{{ $car->id }}" data-car="{{ $car->brand_and_model() }}" data-ppd="{{ $car->ppd }}">Book</a>
                                        </div>
                                    </div>
                                    <div class="text_body">
                                        <a href="#"><h4>{{ $car->brand_and_model() }} {{$car->always_booked ? 'BOOKED' : ''}}</h4></a>
                                        <div class="price">
                                            <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&euro;</span>{{ number_format($car->ppd, 2) }}</span> per day</ins>
                                        </div>
                                        <ul class="nav">
                                            <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $car->engines[$car->engine_type] }}</li>
                                            <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $car->transmissions[$car->transmission_type] }}</li>
                                            <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li>
                                                                                   <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">

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
                {{-- <form action="{{ route('clients.create') }}" method="POST"> --}}
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="from_cars" value="1">
                        <div>
                            <h4>Select Dates</h4>
                            <label for="from_date" class="form-label dates">From Date:</label>
                            <input id="from_date" name="from_date" class="form-control" type="text" autocomplete="off">
                            <label for="to_date" class="form-label dates">To Date:</label>
                            <input id="to_date" name="to_date" class="form-control" type="text" autocomplete="off">

                        </div>
                        <div class="row mt-3">
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
                        <p class="font-weight-bold">Total Cost: <span id="summary"></span>  &euro;</p>


                        <input type="hidden" id="booking_id" name="booking_id">
                        <input type="hidden" id="car_id" name="car_id">
                        <input type="hidden" id="ppd">
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
                                <input id="terms" type="checkbox" checked>
                                <label for="terms">By checking this you are agreeing to our terms and conditions</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="submit_btn">Make Reservation</button>
                        <button type="button" class="btn booking_btn" data-dismiss="modal">Cancel</button>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
      </div>

@endsection

@section('js')
<script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>
    <script>
        $(document).on('click', '.book_car', function (e) {
            e.preventDefault()
            let car_id = $(this).data('car_id')
            let summary = $(this).data('ppd')
            let car_model = $(this).data('car')
            let ppd = $(this).data('ppd')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('car_booked_days') }}",
                type: "POST",
                data: { car_id },
                success: function (data) {
                    let disabled_days = data
                    $('#from_date').datetimepicker({
                        disabledDates: disabled_days,
                        formatDate: 'Y-m-d'
                    });
                    $('#to_date').datetimepicker({
                        disabledDates: disabled_days,
                        formatDate: 'Y-m-d'
                    });

                    $('#car_model').text('Selected Vehicle: ' + car_model)
                    $('#summary').text(ppd)
                    $('#ppd').val(ppd)
                    $('#booking_id').val(booking_id)
                    $('#car_id').val(car_id)
                    $('#client_details').modal('show')
                }
            })
        })

        $(document).bind("change paste keyup", '.dates', function() {
            let from_date = new Date($('#from_date').val())
            let to_date = new Date($('#to_date').val())
            let ppd = $('#ppd').val()
            let days = (to_date.getTime() - from_date.getTime()) / (1000 * 3600 * 24)
            $('#summary').text( (parseInt(days) * parseInt(ppd)))
        })
    </script>
@endsection
