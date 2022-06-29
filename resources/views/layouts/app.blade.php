<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon-green.png" type="image/png">
    <title>One Rent a Car</title>
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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
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

<script src="{{asset('js/theme-dist.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
@yield('js')
</body>
</html>
