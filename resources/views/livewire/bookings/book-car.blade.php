<div>
    <!--================Breadcrumb Area =================-->
    {{-- <section class="breadcrumb_area" style="background: url({{ asset('images/carsall.jpeg') }})"> --}}
    <section>
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
                                                <a type="button" data-toggle="modal" data-target="#book_car" wire:click="carInfo({{ $car->id }})">Book</a>
                                            </div>
                                        </div>
                                        <div class="text_body">
                                            <a href="#"><h4>{{ $car->brand_and_model() }}</h4></a>
                                            <div class="price">
                                                <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&euro;</span>{{ number_format($car->ppd, 2) }}</span> per day</ins>
                                            </div>
                                            <ul class="nav">
                                                <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $engines[$car->engine_type] }}</li>
                                                <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $transmissions[$car->transmission_type] }}</li>
                                                <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li>
                                            {{-- <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li> --}}
                                            </ul>
                                            <ul class="nav">
                                                <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $engines[$car->engine_type] }}</li>
                                                <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $transmissions[$car->transmission_type] }}</li>
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
            </div>
        </div>
    </section>
    <!--================End Product Area =================-->

    @include('livewire.bookings.book-car-modal')

</div>
