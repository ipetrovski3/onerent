@extends('layouts.app')

@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area" style="background: url({{ asset('images/termspage.jpg') }})">
        <div class="container">
            <div class="breadcrumb_inner">
                <h3>Terms and Condtions</h3>
                {{-- <div class="link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="#">Terms and Conditions</a>
                </div> --}}
            </div>
        </div>
    </section>
    <!--================End Breadcrumb Area =================-->

    <!--================General Question Area =================-->
    <section class="general_ques_area p_100">
        <div class="container">
            <div class="flag_center_title wow animated fadeInUp" data-wow-delay="0.2s">
                <h2><img src="{{asset('img/icon/flag-2.png')}}" alt="">Our Terms</h2>
            </div>
            <div class="general_ques_inner">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Driving requirements
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                Customer must present valid driving licence and passport.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Age requirements
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                Minimum age to rent a car is 21 years and at least 2 year of driving practise and experience is required.
                                On some occasions we can make exclusion for drivers below age of 20 years, yet additional deposit and 15.00 EUR per day will be charged. Maximum rental age is 75 years.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Additional Driver
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                    The additional driver must meet all driving and age requirements.
                                </p>
                                <p>
                                    A daily charge for additional driver is 5 EUR.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingfour">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                Rental rates
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                    All rates are in EURO. Daily rates are for 24 hours from start of rental.
                                </p>
                                <p>
                                    If a daily period is exceeded by more than 1 up to 3 hours will be charged as per half day.
                                </p>
                                <p>
                                    More than 3 hours will be charged as per full day. Minimum rental period is 24 hours.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingsix">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapsefive">
                                Methods of payment
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapsefive" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    <li>Unlimited mileage for all cars.</li>
                                    <li>24 hours road assistance.</li>
                                    <li>18 % VAT ( Value Added Tax)</li>
                                    <li>Third party liability insurance higher level ( T.P.L.) according to the government regulations.</li>
                                    <li>Theft protection ( T.P.)</li>
                                    <li>Collision and damage waiver ( C.D.W.), covers renter’s responsibility for damages of the rented vehicle with the exemptions of: </li>
                                        Damages on the tires not caused by fire or accident.
                                        Driving under influence of alcohol or drugs.
                                </ul>
                                <h6>Written statement by police is not presented at the time of check-out</h6>
                                <ul>
                                    <li>If no police report is provided, the renter will be responsible for the total cost of the damages.</li>
                                    <li>We function with delivery system of the car at Skopje International Airport with Meet & Greet.</li>
                                    <li>All the same whether CDW was accepted or not, a charge of 500 euro will be applied, in the event of theft of the car.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingsix">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                Payment Methods
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    <li>We accept credit cards as follows VISA, Eurocard/MasterCard. Cash payment - any convertible currency or the equivalent in Macedonia denars.</li>
                                    <li>DEPOSIT and total cost of rental is required at the beginning of the rental.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingseven">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                                Returnable Deposit
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapseseven" class="collapse" aria-labelledby="headingseven" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    <li>We require a returnable deposit to be left in cash or guaranteed by credit card for each car and the amount is 500 euro for all our cars.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingeight">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
                                Delivery and collection
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapseeight" class="collapse" aria-labelledby="headingeight" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    <li>Skopje capital - free of charge</li>
                                    <li>Skopje airport - free of charge</li>
                                    <li>Any location in North Macedonia - after speaking with our staff.</li>
                                    <li>We charge extra fee depending on the distance of the location.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingnine">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">
                                Gasoline
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    <li>Gasoline consumption is payable by the renter.</li>
                                    <li>If the vehicle is returned with less fuel then rented, the customer is charged for refilling the tank. Fees for tank services also is applied, the cost is 10 EUR plus VAT.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingten">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseten" aria-expanded="false" aria-controls="collapseten">
                                Equipment
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapseten" class="collapse" aria-labelledby="headingnten" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    <li>During the winter season which is indicated by North Macedonian road laws starts from 15 November to 15 march each year and during this period winter tires and snow chains are free of charge
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingeleven">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseeleven" aria-expanded="false" aria-controls="collapseeleven">
                                Roadside assistance and technical problems
                                <i class="ti-plus"></i>
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <div id="collapseeleven" class="collapse" aria-labelledby="headingneleven" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    <li>Free of charge and is available 24/7 within the territory of Macedonia.</li>
                                    <li>This includes vehicle replacement within 24 hours and telephone service support.</li>
                                    <li>The Roadside Assistance telephone number is 0038978230230.</li>
                                    <li>In case of technical problem the renter firstly has to contact us from the above given telephone numbers and if the technical problem is minor and the car is moving in this case the client will be asked to take the car in the nearest mechanical garage and have fixed the problem and we refund all the expanses related with the problem where the renter should show us the official bill or invoice for repairmen of the car during the drop off the car.</li>
                                    <li>If there is a big technical problem in this case we send immediately to your collation another similar car in order to change the broken car.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================End General Question Area =================-->
    <div class="container">
        <div class="solid_br"></div>
    </div>

@endsection
