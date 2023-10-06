{{-- <section class="car_drive_area" >
    <div class="container"> --}}
        <div>
            <div class="single_title text-center wow animated fadeInUp" data-wow-delay="0.2s">
                <h2>Cars you <span>Can Drive</span></h2>
            </div>
            <div class="drive_item d-flex justify-content-between">
                <div class="right">
                    <div class="hourly_toggle">

                    </div>
                </div>
            </div>
            <section class="main_product_area p_100">
                <div class="container">
                    <div class="row main_product_inner flex-row-reverse">
                        <div class="col-lg-12">
                            <div class="product_grid_inner">
                                <div class="row">
                                    @foreach($cars as $car)
                                        <div class="col-lg-4 col-sm-6 wow animated fadeInUp" data-wow-delay="0.2s">
                                            <div class="car_product_item">
                                                <div class="image-container">
                                                    <div class="car_img">
                                                        <a href="{{ route('show.car', $car->id) }}"><img class="img-fluid" src="{{ asset('storage/cars/' . $car->model->image) }}" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="product_content">
                                                    <div class="title d-flex justify-content-between">
                                                        <a href="{{ route('show.car', $car->id) }}"><h3>{{ $car->brand()->name . ' ' . $car->model->name }}</h3></a>
                                                        <h4> &euro; {{ $car->ppd }}/day</h4>
                                                    </div>
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
        </div>
        {{-- <div class="drive_product_view">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="car_drive_slider owl-carousel">
                        
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- </div>
</section> --}}
