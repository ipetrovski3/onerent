<!--================Header Area =================-->
<header class="header_area">
    <div class="main_menu">
        <div class="container">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo.png') }}" style="max-height: 60px" alt="ONE RENT A CAR"></a>
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo.png') }}" style="max-height: 60px" alt="ONE RENT A CAR"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="dropdown mega_menu @if(Route::is('home')) active @endif">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('home') }}" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                        </li>
                        <li class="dropdown submenu @if(Route::is('cars.index')) active @endif">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('cars.index') }}" role="button" aria-haspopup="true" aria-expanded="false">Cars</a>
                        </li>
                        <li class="dropdown submenu @if(Route::is('about')) active @endif">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('about') }}" role="button" aria-haspopup="true" aria-expanded="false">About Us</a>
                        </li>
                        <li class="dropdown submenu @if(Route::is('terms')) active @endif">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('terms') }}" role="button" aria-haspopup="true" aria-expanded="false">Terms</a>
                        </li>
                        <li class="dropdown submenu @if(Route::is('contact')) active @endif">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('contact') }}" role="button" aria-haspopup="true" aria-expanded="false">Contact us</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--================End Header Area =================-->
