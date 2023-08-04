<section class="car_drive_area" >
    <div class="container">
        <div class="single_title text-center wow animated fadeInUp" data-wow-delay="0.2s">
            <h2>Cars you <span>Can Drive</span></h2>
        </div>
        <div class="drive_item d-flex justify-content-between">
            <div class="right">
                <div class="hourly_toggle">

                </div>
            </div>
        </div>
        <div class="drive_product_view">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="car_drive_slider owl-carousel">
                        @foreach($cars as $car)
                        <div class="item">
                            <div class="car_product_item">
                                <div class="car_img">
                                    <a href="{{ route('show.car', $car->id) }}"><img src="{{ asset('storage/cars/' . $car->model->image) }}" alt=""></a>
                                </div>
                                <div class="product_content">
                                    <div class="title d-flex justify-content-between">
                                        <a href="{{ route('show.car', $car->id) }}"><h3>{{ $car->brand->name . ' ' . $car->model->name }}</h3></a>
                                        <h4> &euro; {{ $car->ppd }}/day</h4>
                                    </div>
                                    <ul class="nav">
                                        {{-- <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt="">{{ $car->engines[$car->engine_type] }}</li>
                                        <li title="Transmission"><img src="img/icon/p-cat-icon-3.png" class="mr-1 ml-2" alt="">{{ $car->transmissions[$car->transmission_type] }}</li>
                                        <li title="Max Passenger"><img src="img/icon/p-cat-icon-2.png" class="mr-1 ml-2" alt="">{{ $car->max_passengers }}</li> --}}
                                        
                                        <li><i class="icon-gear1"></i> <span>{{ $car->transmissions[$car->transmission_type] }}</span></li>
                                        <li title="Fuel Type"><img src="img/icon/p-cat-icon-1.png" class="mr-1 ml-2" alt=""><span>{{ $car->engines[$car->engine_type] }}</span></li>
                                        {{-- <li><i class="icon-engine"></i><span>{{ $car->engines[$car->engine_type] }}</span></li> --}}
                                        <li><i class="icon-seat"></i> <span> {{ $car->max_passengers }}</span></li>
                                        <li><i class="icon-snowflake-o"></i>
                                                <span class="text-{{ $car->ac ? 'success' : 'danger'}}">
                                                    <i class="{{ $car->ac ? 'icon-check' : 'icon-times' }}"></i>
                                                </span>
                                            </li>
                                        <li><i class="icon-map_marker"></i>
                                                <span class="text-{{ $car->navigation ? 'success' : 'danger'}}">
                                                    <i class="{{ $car->navigation ? 'icon-check' : 'icon-times' }}"></i>
                                                    </span>
                                        </li>
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
