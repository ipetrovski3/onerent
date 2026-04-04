@extends('layouts.app')
@section('content')
    <style>
        .no-bullets {
            list-style-type: none;
            /* Removes bullet points */
            padding-left: 0;
            /* Removes default left padding */
            text-align: center;
            /* Center-align the text */
        }

        .no-bullets li {
            font-size: 24px;
            /* Adjust the font size as needed */
            margin-bottom: 20px;
            /* Adds space between list items */
        }
    </style>
    <!--================Find Car Banner Area =================-->
    @livewire('cars.search')
    <!--================End Find Car Banner Area =================-->

    <!--================Choose Area =================-->
    <section class="choose_area p_10">
        <div class="container">
            <div class="single_title text-center wow animated fadeInUp" data-wow-delay="0.2s">
                <h2>Why Choose <span>One Rent a Car</span></h2>
            </div>
            <div class="row choose_inner2 justify-content-center">
                <div class="col-lg-10 col-sm-6" style="bottom: 50px;">
                    <div class="wow animated fadeIn" data-wow-delay="0.2s">
                        <ul class="no-bullets">
                            <li><i class="fa fa-check text-success"></i> No deposit for some cars</li>
                            <li><i class="fa fa-check text-success"></i> Free delivery to your home address or hotel</li>
                            <li><i class="fa fa-check text-success"></i> Time-saving and fast service</li>
                            <li><i class="fa fa-check text-success"></i> 24/7 professional customer support</li>
                            <li><i class="fa fa-check text-success"></i> No hidden fees</li>
                            <li><i class="fa fa-check text-success"></i> New vehicles with the highest standard of
                                maintenance</li>
                            <li><i class="fa fa-check text-success"></i> Unlimited mileage</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Choose Area =================-->

    <!--================Car Drive Area =================-->
    @livewire('cars.available-cars')
    <!--================End Car Drive Area =================-->

    {{--    <!--================Download App Area =================--> --}}
    {{--    <section class="download_app_area"> --}}
    {{--        <div class="container"> --}}
    {{--            <div class="row"> --}}
    {{--                <div class="col-lg-5"> --}}
    {{--                    <div class="mobile_img"> --}}
    {{--                        <img class="wow animated fadeInUp" data-wow-delay="0.4s" src="img/mobile-1.jpg" alt=""> --}}
    {{--                        <img class="wow animated fadeInUp" data-wow-delay="0.8s" src="img/mobile-2.jpg" alt=""> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col-lg-7"> --}}
    {{--                    <div class="download_text"> --}}
    {{--                        <h3>Download Our App Now</h3> --}}
    {{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do them eiusmod tempor incididunt labore</p> --}}
    {{--                        <a class="google wow animated fadeInLeft" data-wow-delay="0.4s" href="#"><img src="img/google-play.png" alt=""></a> --}}
    {{--                        <a class="os wow animated fadeInLeft" data-wow-delay="0.6s" href="#"><img src="img/os.png" alt=""></a> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}
    <!--================End Download App Area =================-->

    <div class="container my-5">
        <div class="text-center mb-4">
            <h5 class="fw-semibold">⭐ 5.0 from 100+ Google reviews</h5>
        </div>

        <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">

                @foreach ($googleReviews->chunk(3) as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row g-3">

                            @foreach ($chunk as $review)
                                <div class="col-12 col-md-4">
                                    <div class="card border shadow-sm h-100 p-3 d-flex flex-column">

                                        <div class="text-warning mb-2" style="font-size: 0.95rem;">
                                            @for ($i = 1; $i <= 5; $i++)
                                                {{ $i <= $review->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>

                                        <p class="small text-secondary mb-3"
                                            style="white-space: pre-line; min-height: 90px; flex-grow: 1;">
                                            {{ \Illuminate\Support\Str::limit($review->text, 120) }}
                                        </p>

                                        <div class="d-flex align-items-center mt-auto">
                                            @if ($review->profile_photo_url)
                                                <img src="/avatar?url={{ urlencode($review->profile_photo_url) }}"
                                                    class="rounded-circle mr-2" width="36" height="36"
                                                    style="object-fit: cover;"
                                                    onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';">
                                                <div class="rounded-circle bg-dark text-white d-none align-items-center justify-content-center mr-2"
                                                    style="width:36px;height:36px;font-size:14px;">
                                                    {{ strtoupper(substr($review->author_name, 0, 1)) }}
                                                </div>
                                            @else
                                                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center mr-2"
                                                    style="width:36px;height:36px;font-size:14px;">
                                                    {{ strtoupper(substr($review->author_name, 0, 1)) }}
                                                </div>
                                            @endif

                                            <small class="fw-semibold text-dark mb-0">
                                                {{ $review->author_name }}
                                            </small>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="text-center mt-4">

            <a href="https://share.google/lp1MTkEkYrkWUIXNN" target="_blank" rel="noopener"
                class="fw-semibold text-decoration-none me-3">
                ⭐ View on Google
            </a>

            <a href="https://search.google.com/local/writereview?placeid=ChIJWzDRPSQ5VBMRJXYzrySMPtg" target="_blank"
                rel="noopener" class="fw-semibold text-decoration-none">
                ✍️ Leave a review
            </a>

        </div>
    </div>

    <!--================Question Area =================-->
    <section class="top_question_area p_100">
        <div class="container">
            <div class="single_title text-center wow animated fadeInUp" data-wow-delay="0.2s">
                <h2>Top <span>Questions</span></h2>
            </div>
            <div class="top_ques_inner">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                When do I get charged for a ride?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                The payment will be at the moment you receive the vehicle.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Can I pay for an rental with cash?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                Yes, the rental can be paid with cash with Euro, or with national Macedonian currency
                                (Denar)
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Can I pay for an rental with credit card or online?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                We accept payments with credit cards. At the moment we cannot accept online payments ( very
                                soon it will be available for your service)
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingfour">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                Can I get a ride from an airport?
                                <i class="icon-plus"></i>
                                <i class="icon-minus"></i>
                            </button>
                        </div>
                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                The Car can be picked up at the Airports location.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Question Area =================-->
@endsection
