@extends('layouts.app')

@section('content')
    <!-- Button trigger modal -->

<!--================Breadcrumb Area =================-->
<section class="breadcrumb_area" style="background: url(img/breadcrumb/breadcrumb-bg-6.jpg)">
    <div class="container">
        <div class="breadcrumb_inner">
            <h3>Available cars</h3>
            <div class="link">
                <p>Requested Date: {{ $booking->from_date->format('d.m.Y') . ' - ' . $booking->to_date->format('d.m.Y') }}</p>
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
                                        <a href="#" class="book_car" data-car_id="{{ $car->id }}" data-car="{{ $car->brand_and_model() }}" data-ppd="{{ $car->ppd }}" data-booking_id="{{ $booking->id }}">Book</a>
                                    </div>
                                </div>
                                <div class="text_body">
                                    <a href="#"><h4>{{ $car->brand_and_model() }}</h4></a>
                                    <div class="price">
                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&euro;</span>{{ number_format($car->ppd, 2) }}</span> per day</ins>
                                    </div>
                                    <ul class="nav">
                                        <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $car->engines[$car->engine_type] }}</li>
                                        <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $car->transmissions[$car->transmission_type] }}</li>
                                        <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li>
{{--                                        <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li>--}}
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

                    <aside class="r_widget news_widget">
                        <div class="r_title">
                            <h3>Info</h3>
                        </div>
                        <div class="news_inner">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishin
                            </p>
                        </div>
                    </aside>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Area =================-->

    <!-- Modal -->
    <div class="modal fade" id="client_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="car_model" style="margin-bottom: 3px"></p>
                    <p style="margin-bottom: 3px">From: {{ $booking->from_date->format('d m Y') }}</p>
                    <p style="margin-bottom: 3px">To: {{ $booking->to_date->format('d m Y') }}</p>
                    <p id="summary">Total Cost:</p>
                </div>
                <form action="{{ route('clients.create') }}" method="POST">
                    @csrf
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
                        <button type="submit" class="main_btn">Confirm Reservation</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).on('click', '.book_car', function (e) {
            e.preventDefault()
            let booking_id = $(this).data('booking_id')
            let summary = $(this).data('ppd')
            let car_model = $(this).data('car')
            let car_id = $(this).data('car_id')
            let days = "{{ $days }}"
            $('#car_model').text('Selected Vehicle: ' + car_model)
            $('#summary').text( 'Total Cost: ' + (parseInt(days) * parseInt(summary)) + '\u20AC')
            $('#booking_id').val(booking_id)
            $('#car_id').val(car_id)
            $('#client_details').modal('show')
        })
    </script>
@endsection
