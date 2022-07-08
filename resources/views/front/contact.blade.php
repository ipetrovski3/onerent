@extends('layouts.app')
@section('content')
        <section class="breadcrumb_area" style="background: url(img/breadcrumb/breadcrumb-bg-5.jpg)">
        	<div class="container">
        		<div class="breadcrumb_inner">
        			<h3>Contact us</h3>
        			<div class="link">
        				<a href="{{ route('home') }}">Home</a>
        				<a href="#">Contact</a>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Breadcrumb Area =================-->

        <!--================End Breadcrumb Area =================-->
        <section class="contact_information p_100">
        	<div class="container">
        		<div class="flag_center_title wow animated fadeInUp" data-wow-delay="0.2s">
        			<h2><img src="img/icon/flag-2.png" alt=""> Contact Information</h2>
        		</div>
        		<div class="row contact_info_inner justify-content-center">
        			<div class="col-lg-4 col-sm-6 wow animated fadeIn" data-wow-delay="0.2s">
        				<div class="contact_info_item">
        					<i class="icon-map_marker"></i>
        					<h4>Location</h4>
        					<p>1000 Skopje,<br /> North Macedonia</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-sm-6 wow animated fadeIn" data-wow-delay="0.4s">
        				<div class="contact_info_item">
        					<i class="icon-phone1"></i>
        					<h4>Contact Number</h4>
        					<h5><a href="tel:+38978230230">+389 78 230 230</a></h5>
        				</div>
        			</div>
        			<div class="col-lg-4 col-sm-6 wow animated fadeIn" data-wow-delay="0.6s">
        				<div class="contact_info_item">
        					<i class="icon-envelop"></i>
        					<h4>Mail Address</h4>
        					<h5><a href="mailto:info@onerentacar.mk">info@onerentacar.mk</a></h5>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Breadcrumb Area =================-->

{{--        <!--================End Banner Area =================-->--}}
{{--        <section class="map_area">--}}
{{--			<div id="mapBox" class="mapBox row m0"--}}
{{--				data-lat="40.701083"--}}
{{--				data-lon="-74.1522848"--}}
{{--				data-zoom="12"--}}
{{--				data-marker="img/icon/marker.png"--}}
{{--				data-info="54B, Tailstoi Town 5238 La city, IA 522364"--}}
{{--				data-mlat="40.701083"--}}
{{--				data-mlon="-74.1522848">--}}
{{--			</div>--}}
{{--        </section>--}}
{{--        <!--================End Banner Area =================-->--}}

        <!--================Main contact Area =================-->
        <section class="main_contact_area p_100">
        	<div class="container">
        		<div class="flag_center_title wow animated fadeInUp" data-wow-delay="0.2s">
        			<h2><img src="img/icon/flag-2.png" alt="">Contact us</h2>
        		</div>
        		<div class="main_contact_inner">
        			<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
						<div class="form-group col-md-4">
							<input type="text" class="form-control" id="name" name="name" placeholder="Name">
						</div>
						<div class="form-group col-md-4">
							<input type="text" class="form-control" id="number" name="number" placeholder="Phone">
						</div>
						<div class="form-group col-md-4">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email">
						</div>
						<div class="form-group col-md-12">
							<textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
						</div>
						<div class="form-group col-md-12">
							<button type="submit" value="submit" class="btn submit_btn red form-control">Send now</button>
						</div>
					</form>
                    <div id="success">Your message succesfully sent!</div>
                    <div id="error">Opps! There is something wrong. Please try again</div>
        		</div>
        	</div>
        </section>
        <!--================End Main contact Area =================-->
@endsection
