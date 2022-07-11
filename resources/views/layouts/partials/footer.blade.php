<!--================Footer Area =================-->
<footer class="footer_area">
    <div class="footer_widgets">
        <div class="container">
            <div class="row f_widgets_inner">
                <div class="col-lg-3 col-sm-6">
                    <aside class="f_widget about_widget wow animated fadeInUp" data-wow-delay="0.2s">
                        <a class="f_logo" href="{{ route('home') }}"><img src="{{ asset('images/logo-white.png') }}" srcset="{{ asset('images/logo-white.png') }} 5x" alt="ONE RENT A CAR"></a>
                        <p><i class="icon-map_marker_2" aria-hidden="true"></i> Skopje, Macedonia</p>
                        <a href="mailto:info@onerentacar.mk"><i class="icon-envelop_2" aria-hidden="true"></i> info@onerentacar.mk</a>
                        <a href="tel:0951856558"><i class="icon-phone_2" aria-hidden="true"></i> +389 78 230 230</a>
                    </aside>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <aside class="f_widget link_widget wow animated fadeInUp" data-wow-delay="0.4s">
                        <div class="f_title">
                            <h3>Our info</h3>
                        </div>
                        <ul class="nav flex-column">
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <aside class="f_widget link_widget wow animated fadeInUp" data-wow-delay="0.6s">
                        <div class="f_title">
                            <h3>Quick Link</h3>
                        </div>
                        <ul class="nav flex-column">
                            <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                            <li><a href="#">Private Policy</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <aside class="f_widget subscribe_widget wow animated fadeInUp" data-wow-delay="0.8s">
                        <div class="f_title">
                            Follow us on social platforms
                        </div>
                        <ul class="nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/__onerentacar__/" target="_blank"><i class="fa fa-instagram"></i></a></li>
{{--                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>--}}
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_card wow animated fadeIn" data-wow-delay="0.3s">

    </div>
    <div class="footer_copyright">
        <div class="container">
            <div class="copyright_inner d-flex justify-content-between">
                <div class="left">
                    <p>{{ date('Y') }} &copy; Copyright ONE RENT A CAR | powered by
                        <a href="https://www.linkedin.com/in/igor-petrovski-6ba7b91b3/" target="_blank">ipetrovski</a>
                    </p>
                </div>
                <div class="right">
                    <ul class="nav">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
