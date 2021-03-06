<!--================Header Area =================-->
<header class="header_area">
    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo-white.png') }}" srcset="{{ asset('images/logo-white.png') }} 5x" alt="ONE RENT A CAR"></a>
                <a class="navbar-brand" href="{{ route('home') }}"><img src="images/logo.png" srcset="images/logo.png 5x" alt="ONE RENT A CAR"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="dropdown mega_menu active">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('home') }}" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                        </li>
                        <li class="dropdown submenu">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('cars.front.index') }}" role="button" aria-haspopup="true" aria-expanded="false">Cars</a>
                        </li>
                        <li class="dropdown submenu">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('about') }}" role="button" aria-haspopup="true" aria-expanded="false">About Us</a>
                        </li>
                        <li class="dropdown submenu">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('terms') }}" role="button" aria-haspopup="true" aria-expanded="false">Terms</a>
                        </li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>

                </div>
            </nav>
        </div>
    </div>
</header>
