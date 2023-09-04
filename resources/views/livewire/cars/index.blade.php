<div>
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }
    
        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.9);
            color: red;
            padding: 10px;
            font-size: 30px;
            font-weight: bold;
            border-radius: 5px;
        }
    </style>

    <!--================Breadcrumb Area =================-->
    {{-- <section class="breadcrumb_area" style="background: url({{ asset('images/carsall.jpeg') }})"> --}}
    <section>
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
                        <div class="row">
                            @foreach($cars as $car)
                                <div class="col-md-4 col-sm-6 wow animated fadeInUp" data-wow-delay="0.2s">
                                    @if(!$car->always_booked)
                                    <div class="l_collection_item shop_product_item orange grid_four red">
                                    @else
                                    {{-- fade this item --}}
                                    <div disabled style="opacity: 0.5">
                                    @endif

                                        <div class="image-container">
                                            <div class="car_img">
                                                <a href="#"><img class="img-fluid" src="{{ asset('storage/cars/' . $car->model->image) }}" alt=""></a>
                                                <div class="cart_option">
                                                    <a type="button" data-toggle="modal" data-target="#book_car" wire:click="carInfo({{ $car->id }})">Book</a>
                                                </div>
                                            </div>
                                            <div class="overlay-text">Booked</div>
                                        </div>
                                        {{-- <div class="car_img">
                                            <a href="#"><img class="img-fluid" src="{{ asset('storage/cars/' . $car->model->image) }}" alt=""></a>
                                            <div class="cart_option"> --}}
                                                {{-- <a type="button" data-toggle="modal" data-target="#book_car" data-car_id="{{ $car->id }}" data-ppd="{{ $car->ppd }}">Book</a> --}}
                                                {{-- <a type="button" data-toggle="modal" data-target="#book_car">Book</a>
                                            </div>
                                        </div> --}}
                                        <div class="text_body">
                                            {{-- <a href="#"><h4>{{ $car->brand_and_model() }}</h4></a> --}}
                                            <div class="price">
                                                <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&euro;</span>{{ number_format($car->ppd, 2) }}</span> per day</ins>
                                            </div>
                                            <ul class="nav">
                                                <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $engines[$car->engine_type] }}</li>
                                                <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $transmissions[$car->transmission_type] }}</li>
                                                <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li>
                                            {{-- <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li> --}}
                                            </ul>
                                            {{-- <ul class="nav">
                                                <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $engines[$car->engine_type] }}</li>
                                                <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $transmissions[$car->transmission_type] }}</li>
                                                <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li> --}}
                                                {{--                                        <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li>--}}
                                            {{-- </ul> --}}
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

    @include('livewire.cars.show-car-modal')

    <!-- Include the Livewire component -->
    {{-- @livewire('bookings.confirm-form') --}}
</div>
