@foreach($cars as $car)
<div class="col-lg-4 col-md-4 col-sm-6 wow animated fadeInUp" data-wow-delay="0.2s">
    <div class="l_collection_item shop_product_item orange grid_four red {{ $car->always_booked ? 'disabled-booking' : ''  }}">
        <div class="car_img">
            <a href="#"><img class="img-fluid" src="{{ asset('storage/cars/' . $car->model->image) }}" alt=""></a>
            <div class="cart_option">
                <a href="#" class="book_car" data-car_id="{{ $car->id }}" data-car="{{ $car->brand_and_model() }}" data-ppd="{{ $car->ppd }}">Book</a>
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
                {{--                                        <li><img src="img/icon/p-cat-icon-4.png" class="mr-1 ml-2" alt="">03</li>--}}
            </ul>
        </div>
    </div>
</div>
@endforeach