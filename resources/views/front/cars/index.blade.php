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
                            @include('front.cars.free_cars')
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <form action="" id="set_dates">
                        <div class="form-group">
                            <label class="formlabel" for="from_name">From Date</label>
                            <input class="form-control" type="datetime-local" name="from_date" id="from_date">
                        </div>
                        <div class="form-group">
                            <label class="formlabel" for="to_date">To Date</label>
                            <input class="form-control" type="datetime-local" name="to_date" id="to_date">
                        </div>
                        <button class="submit_btn" type="submit">SHOW CARS</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="client_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('clients.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="from_cars" value="1">
                        <input type="hidden" name="from_date" value="{{ session('from_date') }}">
                        <input type="hidden" name="to_date" value="{{ session('to_date') }}">
                        <div>
                            <h4>Selected Dates</h4>
                            <p>from date: {{ \Carbon\Carbon::parse(session('from_date'))->format('m.d.Y') }}</p>
                            <p>to date: {{ \Carbon\Carbon::parse(session('to_date'))->format('m.d.Y')  }}</p>
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
                        <p id="summary" class="font-weight-bold">Total Cost:</p>
                    </div>

                    <input type="hidden" id="booking_id" name="booking_id">
                    <input type="hidden" id="car_id" name="car_id">
                    <div class="modal-body">
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

@endsection

@section('js')
    <script>
        $(document).on('submit', '#set_dates', function (e) {
            e.preventDefault()
            let from_date = $('#from_date').val()
            let to_date = $('#to_date').val()
            $.ajax({
                url: "{{ route('set_dates') }}",
                type: "POST",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    $('#render_cars').html(data)
                }
            })
        })

        $(document).on('click', '.book_car', function (e) {
            e.preventDefault()
            let booking_id = $(this).data('booking_id')
            let summary = $(this).data('ppd')
            let car_model = $(this).data('car')
            let car_id = $(this).data('car_id')
            {{--let days = "{{ $days }}"--}}
            $('#car_model').text('Selected Vehicle: ' + car_model)
            // $('#summary').text( 'Total Cost: ' + (parseInt(days) * parseInt(summary)) + '\u20AC')
            $('#booking_id').val(booking_id)
            $('#car_id').val(car_id)
            $('#client_details').modal('show')
        })

        $(document).ready(function() {
            $('.datetimepicker-input').attr('autocomplete','off');
        });
    </script>
@endsection
