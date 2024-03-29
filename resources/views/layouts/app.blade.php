<html lang="en">
<head>
    <meta property = "og:type" content = "website" /> <!-- For website -->
    <meta property = "og:title" content = "ONE RENT A CAR" />
    <meta property = "og:url" content = "https://onerentacar.mk/" />
    <meta property = "og:description" content = "Number one rental company in North Macedonia" />
    <meta property = "og:image" content = "{{ asset('images/metalogo.png') }}" />
    <meta property = "og:site_name" content = "ONE RENT A CAR" />
    <meta name="description" content="Cheapest rent a car service in North Macedonia, Skopje">
    <meta name="keywords" content="rentacar skopje, rentacar macedonia, rent a car macedonia, cheap rent a car in macedonia, best rent a car in macedonia">
    <meta name="google-site-verification" content="ALer7Iwb8HyKkaOsnsv-hCBa4R3t_zv9LsRCUGshVEU" />



    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('images/logoico.png')}}" type="image/png">
    <title>One Rent a Car Macedonia</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/icomoon-icon/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/themify-icon/themify-icons.css')}}">
    <!-- Extra Plugin CSS -->
    <link rel="stylesheet" href="{{asset('vendors/datetimepicker/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/nice-select/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/owl-carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/animate-css/animate.css')}}">
    <!-- main css -->
    {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('css/theme_style.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/custom_style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}"> --}}
    <!-- flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Livewire Styles -->
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    @include('layouts.partials.facebook_pixel')
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1287809329278416&ev=PageView&noscript=1"/></noscript>
</head>
<body data-scroll-animation="true">
    {{--<div class="preloader">--}}
    {{--    <div class="main-loader">--}}
    {{--        <img src="img/loader_5.gif" alt="">--}}
    {{--    </div>--}}
    {{--</div>--}}
    @include('layouts.partials.header')

    @yield('content')

    @include('layouts.partials.footer')
    @include('layouts.partials.sidemenu')


    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Extra Plugin js -->
    <script src="{{asset('vendors/datetimepicker/moment.js')}}"></script>
    <script src="{{asset('vendors/datetimepicker/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('vendors/popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('vendors/slick/slick.min.js')}}"></script>
    <script src="{{asset('vendors/animate-css/wow.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{-- <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}

    <script src="{{asset('js/theme-dist.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>

    @livewireScripts
    @yield('js')
    @if ($errors->any())
    <script>
        $('#client_details').modal('show')
    </script>
    <script type="text/javascript">
        window.livewire.on('bookCar', () => {
            $('#book_car').modal('hide');
        });
    </script>
    @endif
</body>
</html>
