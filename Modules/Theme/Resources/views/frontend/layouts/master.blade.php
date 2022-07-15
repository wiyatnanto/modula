<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TK Perintis</title>
    <meta name="description" content="TK Perintis Bekasi Utara, Pendidikan Anak Usia Dini Bekasi Utara">
    <meta name="keywords" content="Taman Kanak-kanak, Pendidikan Anak Usia Dini">
    <meta name="author" content="perintis.sch.id"> 
	
	<!-- ==============================================
	Favicons
	=============================================== -->
	<link rel="shortcut icon" href="{{ asset('modules/theme/frontend/images/favicon.png') }}">
	<link rel="apple-touch-icon" href="{{ asset('modules/theme/frontend/images/apple-touch-icon.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('modules/theme/frontend/images/apple-touch-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('modules/theme/frontend/images/apple-touch-icon-114x114.png') }}">
	<!-- ==============================================
	Fonts
	=============================================== -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
   	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=McLaren&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
   	<!-- ==============================================
	CSS VENDOR
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/theme/frontend/css/vendor/bootstrap.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/theme/frontend/fonts/css/all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/theme/frontend/css/vendor/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/theme/frontend/css/vendor/owl.theme.default.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/theme/frontend/css/vendor/magnific-popup.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/theme/frontend/css/vendor/animate.min.css') }}">
	
	<!-- ==============================================
	Custom Stylesheet
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="{{ asset('modules/theme/frontend/css/style.css') }}" />
	
    <script src="{{ asset('modules/theme/frontend/js/vendor/modernizr.min.js') }}"></script>

</head>
<body>

	<!-- LOAD PAGE -->
	<div class="loader"></div>
	
	<!-- BACK TO TOP SECTION -->
	<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

	@include('theme::frontend.layouts.parts.header')

	<!-- BANNER -->
    <div id="oc-fullslider" class="banner">
    	<div class="owl-carousel owl-theme full-screen">
	    	<div class="item">
	        	<img src="{{ asset('modules/theme/frontend/images/slides/slide-1.jpg') }}" alt="Slider">
	        	<div class="overlay-bg"></div>
	        	<div class="container d-flex align-items-center">
	            	<div class="wrap-caption">
	            		<h5 class="caption-supheading">Regsitrasi</h5>
		                <h1 class="caption-heading">Pembukaan Registrasi Tahun 2022/2023</h1>
		                <a href="#" class="btn btn-secondary">Selengkapnya</a>
		            </div>  
	            </div>
	    	</div>
	    	<div class="item">
	            <img src="{{ asset('modules/theme/frontend/images/slides/slide-2.jpg') }}" alt="Slider">
	            <div class="overlay-bg"></div>
	            <div class="container d-flex align-items-center">
	            	<div class="wrap-caption">
		                <h5 class="caption-supheading">Selamat Datang</h5>
		                <h1 class="caption-heading">Taman Kanak-kanak Perintis</h1>
		                <a href="#" class="btn btn-secondary">Selengkapnya</a>
		            </div>  
	            </div>
	        </div>  
	    	<div class="item">
	            <img src="{{ asset('modules/theme/frontend/images/slides/slide-3.jpg') }}" alt="Slider"> 
	            <div class="overlay-bg"></div>
	            <div class="container d-flex align-items-center">
	            	<div class="wrap-caption">
		                <h5 class="caption-supheading">Selamat Datang</h5>
		                <h1 class="caption-heading">Taman Kanak-kanak Perintis</h1>
		                <a href="#" class="btn btn-secondary">Selengkapnya</a>
		            </div>  
	            </div>
	        </div>  
    	</div>
	    <div class="custom-nav owl-nav"></div>
    </div>	
	<div>
    <!-- SHORTCUT -->
	<div class="section services">
		<div class="content-wrap">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="row col-0 overlap">
							<div class="col-sm-12 col-md-4 col-lg-4">
								<!-- BOX 1 -->
								<div class="rs-feature-box-1 bg-primary">
									<i class="fal fa-backpack"></i>
									<div class="body">
										<h4>KBM Ceria Merdeka</h4>
										<p>Sedut perspiciatis unde omnis iste natus error sit voluptatem accusantium.</p>
										<div class="spacer-10"></div>
										<a href="#" class="btn">Selengkapnya</a>
									</div>
					            </div>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4">
								<!-- BOX 2 -->
								<div class="rs-feature-box-1 bg-secondary">
									<i class="fal fa-school"></i>
									<div class="body">
										<h4>Cinta Sekolah</h4>
										<p>Sedut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium</p>
										<div class="spacer-10"></div>
										<a href="#" class="btn">Selengkapnya</a>
									</div>
					            </div>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4">
								<!-- BOX 3 -->
								<div class="rs-feature-box-1 bg-tertiary">
									<i class="fal fa-home-heart"></i>
									<div class="body">
										<h4>Hari Keluarga</h4>
										<p>Sedut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium</p>
										<div class="spacer-10"></div>
										<a href="#" class="btn">Selengkapnya</a>
									</div>
					            </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

	<!-- WELCOME TO KIDS -->
	<div class="section">
		<div class="content-wrap">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-6">
						<img src="{{ asset('modules/theme/frontend/images/dummy-img-900x600.jpg') }}" alt="" class="img-fluid img-border img-rounded">
					</div>
					<div class="col-sm-12 col-md-12 col-lg-6">
						<h2 class="section-heading">
							Pendidikan Anak Usia Dini
						</h2>
						<p>Pendidikan Anak Usia Dini sangat penting, karena saat itu dimulainya pembentukan mental dan karakter sebelum masuk pada sekolah tingkat dasar. Inilah masa-masa emas (Golden Age) pada si anak.</p>
						<p>Pendidikan Anak Usia Dini selain mempersiapkan anak dalam perkembangan mental, anak juga dipersiapkan secara matang untuk bersaing, mempunyai ketrampilan tersendiri, menjadi seorang pemimpin yang handal dan berani tampil di tengah-tengah masyarakat.</p>
						<div class="spacer-10"></div>
						<a href="#" class="btn btn-secondary">Selengkapnya</a>
						<div class="spacer-30"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<!-- FUNFACT -->
	<div class="section bgi-overlay bgi-repeat" data-background="{{ asset('modules/theme/frontend/images/school1.jpg') }}">
		<div class="content-wrap">
			<div class="container">
				<div class="row">
					<!-- Item 1 -->
					<div class="col-sm-6 col-md-3 col-6">
						<div class="rs-funfact bg-primary animate__animated animate__pulse">
							<div class="box-fun"><h2>852</h2></div>
							<div class="title">Students</div>	
						</div>
					</div>
					<!-- Item 2 -->
					<div class="col-sm-6 col-md-3 col-6">
						<div class="rs-funfact bg-secondary">
							<div class="box-fun"><h2>125</h2></div>
							<div class="title">Teachers</div>	
						</div>
					</div>
					<!-- Item 3 -->
					<div class="col-sm-6 col-md-3 col-6">
						<div class="rs-funfact bg-tertiary">
							<div class="box-fun"><h2>32</h2></div>
							<div class="title">Class Rooms</div>	
						</div>
					</div>
					<!-- Item 4 -->
					<div class="col-sm-6 col-md-3 col-6">
						<div class="rs-funfact bg-quaternary">
							<div class="box-fun"><h2>15</h2></div>
							<div class="title">Bus Schools</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- OUR ARTICLES -->
	<div class="">
		<div class="content-wrap">
			<div class="container">

				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="supheading text-center">Our Programs</p>
						<h2 class="section-heading text-center mb-5">
							Popular Classes
						</h2>
					</div>
				</div>

				<div class="row mt-4">
					
					<!-- Item 1 -->
					<div class="col-sm-12 col-md-12 col-lg-4">
						<div class="rs-class-box mb-5">
							<div class="media-box">
								<img src="{{ asset('modules/theme/frontend/images/galleries/photo-1.jpg') }}" alt="" class="img-fluid">
							</div>
							<div class="body-box">
								<div class="class-name">
									<div class="title">Drawing Classes</div>
									<div class="price">$20</div>
								</div>
								<div class="open-class">Open Class : <span>08:00 am - 10:00 am</span></div>
								<p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
								<div class="detail">
									<div class="age col">Age 2-5 years</div>
									<div class="size col">Class Size 20</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Item 2 -->
					<div class="col-sm-12 col-md-12 col-lg-4">
						<div class="rs-class-box mb-5">
							<div class="media-box">
								<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x400.jpg') }}" alt="" class="img-fluid">
							</div>
							<div class="body-box">
								<div class="class-name">
									<div class="title">Gaming Classes</div>
									<div class="price">$20</div>
								</div>
								<div class="open-class">Open Class : <span>08:00 am - 10:00 am</span></div>
								<p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
								<div class="detail">
									<div class="age col">Age 2-5 years</div>
									<div class="size col">Class Size 20</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Item 3 -->
					<div class="col-sm-12 col-md-12 col-lg-4">
						<div class="rs-class-box mb-5">
							<div class="media-box">
								<img src="{{ asset('modules/theme/frontend/images/galleries/photo-2.jpg') }}" alt="" class="img-fluid">
							</div>
							<div class="body-box">
								<div class="class-name">
									<div class="title">Learning Classes</div>
									<div class="price">$20</div>
								</div>
								<div class="open-class">Open Class : <span>08:00 am - 10:00 am</span></div>
								<p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
								<div class="detail">
									<div class="age col">Age 2-5 years</div>
									<div class="size col">Class Size 20</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="text-center">
							<a href="#" class="btn btn-primary">SEE MORE CLASSES</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- WHY CHOOSE US -->
	<div class="section bgi-overlay bgi-repeat" data-background="{{ asset('modules/theme/frontend/images/school1.jpg') }}">
		<div class="content-wrap pb-0">
			<div class="container">
				<div class="row align-items-end">
					<div class="col-sm-12 col-md-12 col-lg-7">
						<p class="supheading">Why Choose Us</p>
						<h2 class="section-heading">
							Best Kindergarten
						</h2>
						<p class="text-white">Dolor sit amet, dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod. Dolor sit amet consectetuer adipiscing elit, sed diam nonummy nibh euismod. Praesent interdum est gravida vehicula est node maecenas loareet morbi a dosis luctus novum est praesent. Praesent interdum est gravida vehicula est node maecenas loareet morbi a dosis luctus novum est praesent.</p>
						<p class="p-check text-white">100% education, for your kids, consectetuer adipiscing elit, sed diam nonummy nibh euismod. Dolor sit amet, dolor gravida placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.</p>
						<p class="p-check text-white">More programs activities, sed diam nonummy nibh euismod. Lorem ipsum dolor sit amet.</p>
						<p class="p-check text-white">More benefit nonummy nibh euismod. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
						<div class="spacer-90"></div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-5">
						<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x700.png') }}" alt="" class="img-fluid img-rounded">
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<!-- OUR GALLERY -->
	<div class="">
		<div class="content-wrap">
			<div class="container">

				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="supheading text-center">Our Gallery</p>
						<h2 class="section-heading text-center mb-5">
							Moment from kids
						</h2>
					</div>
				</div>
				
				<div class="row popup-gallery gutter-5">
					<!-- Item 1 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="images/dummy-img-600x400.jpg') }}" title="Gallery #1">
								<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x400.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fal fa-search-plus"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 1 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="images/dummy-img-600x400.jpg') }}" title="Gallery #2">
								<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x400.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fal fa-search-plus"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 1 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="images/dummy-img-600x400.jpg') }}" title="Gallery #3">
								<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x400.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fal fa-search-plus"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 2 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="images/dummy-img-600x400.jpg') }}" title="Gallery #4">
								<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x400.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fal fa-search-plus"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 3 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="images/dummy-img-600x400.jpg') }}" title="Gallery #5">
								<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x400.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fal fa-search-plus"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 4 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="images/dummy-img-600x400.jpg') }}" title="Gallery #6">
								<img src="{{ asset('modules/theme/frontend/images/dummy-img-600x400.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fal fa-search-plus"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>

	<!-- OUR EVENTS -->
	<div class="section bgi-cover-center" data-background="images/dummy-img-1920x900-2.jpg') }}">
		<div class="content-wrap">
			<div class="container">

				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="supheading text-center">Our Events</p>
						<h2 class="section-heading text-center mb-5">
							Don't miss our event
						</h2>
					</div>
				</div>

				<div class="row mt-4">
					
					<!-- Item 1 -->
					<div class="col-sm-12 col-md-12 col-lg-4 mb-5">
						<div class="rs-news-1">
							<div class="media-box">
								<img src="{{ asset('modules/theme/frontend/images/events/event-1.jpg') }}" alt="" class="img-fluid">
							</div>
							<div class="body-box">
								<div class="title">English Day on Carfree day</div>
								<div class="meta-date">March 19, 2016 / 08:00 am - 10:00 am</div>
								<p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
								<div class="text-center">
									<a href="page-events-single.html" class="btn btn-primary">JOIN NOW</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Item 2 -->
					<div class="col-sm-12 col-md-12 col-lg-4 mb-5">
						<div class="rs-news-1">
							<div class="media-box">
								<img src="{{ asset('modules/theme/frontend/images/events/event-2.jpg') }}" alt="" class="img-fluid">
							</div>
							<div class="body-box">
								<div class="title">Play & Study with Mrs. Smith</div>
								<div class="meta-date">March 19, 2016 / 08:00 am - 10:00 am</div>
								<p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
								<div class="text-center">
									<a href="page-events-single.html" class="btn btn-primary">JOIN NOW</a>
								</div>
							</div>
						</div>
					</div>

					<!-- Item 3 -->
					<div class="col-sm-12 col-md-12 col-lg-4 mb-5">
						<div class="rs-news-1">
							<div class="media-box">
								<img src="{{ asset('modules/theme/frontend/images/events/event-3.jpg') }}" alt="" class="img-fluid">
							</div>
							<div class="body-box">
								<div class="title">Drawing at City Park</div>
								<div class="meta-date">March 19, 2016 / 08:00 am - 10:00 am</div>
								<p>We provide high quality design at vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores...</p>
								<div class="text-center">
									<a href="page-events-single.html" class="btn btn-primary">JOIN NOW</a>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

	<!-- OUR TESTIMONIALS -->
	<div class="section">
		<div class="content-wrap">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="supheading text-center">Our Testimonials</p>
						<h2 class="section-heading text-center mb-5">
							What parents say
						</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-10 offset-md-1">
						<div class="text-center text-secondary mb-3"><i class="fa fa-quote-right fa-3x"></i></div>
						<div id="testimonial" class="owl-carousel owl-theme">
							<div class="item">
								<div class="rs-box-testimony">
									<div class="quote-box">
										<blockquote>
										 Teritatis et quasi architecto. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam
										</blockquote>
										<div class="media">
											<img src="{{ asset('modules/theme/frontend/images/dummy-img-400x400.jpg') }}" alt="" class="rounded-circle">
										</div>
										<p class="quote-name">
											Johnathan Doel <span>Businessman</span>
										</p>                        
									</div>
								</div>
							</div>
							<div class="item">
								<div class="rs-box-testimony">
									<div class="quote-box">
										<blockquote>
										 Teritatis et quasi architecto. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolore mque laudantium, totam rem aperiam
										</blockquote>
										<div class="media">
											<img src="{{ asset('modules/theme/frontend/images/dummy-img-400x400.jpg') }}" alt="" class="rounded-circle">
										</div>
										<p class="quote-name">
											Johnathan Doel <span>CEO Buka Kreasi</span>
										</p>                        
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- CTA -->
	<div class="section bg-tertiary">
		<div class="content-wrap py-5">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-12 col-md-12">
						<div class="cta-1">
			              	<div class="body-text mb-3">
			                	<h3 class="my-1 text-secondary">Let's join the best kindergarten now!</h3>
			                	<p class="uk18 mb-0 text-white">We provide high standar clean website for your business solutions</p>
			              	</div>
			              	<div class="body-action">
			                	<a href="contact.html" class="btn btn-primary mt-3">CONTACT US</a>
			              	</div>
			            </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- FOOTER SECTION -->
	<div class="footer" data-background="{{ asset('modules/theme/frontend/images/dummy-img-1920x900-3.jpg') }}">
		<div class="content-wrap">
			<div class="container">
				
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="footer-item">
							<img src="{{ asset('modules/theme/frontend/images/logo.png') }}" alt="logo bottom" class="logo-bottom">
							<div class="spacer-30"></div>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy.</p>
							<a href="#"><i class="far fa-chevron-right"></i> Read More</a>
						</div>
					</div>					

					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="footer-item">
							<div class="footer-title">
								Contact Info
							</div>
							<ul class="list-info">
								<li>
									<div class="info-icon">
										<span class="fa fa-map-marker"></span>
									</div>
									<div class="info-text">99 S.t Jomblo Park Pekanbaru 28292. Indonesia</div> </li>
								<li>
									<div class="info-icon">
										<span class="fa fa-phone"></span>
									</div>
									<div class="info-text">(0761) 654-123987</div>
								</li>
								<li>
									<div class="info-icon">
										<span class="fa fa-envelope"></span>
									</div>
									<div class="info-text">info@yoursite.com</div>
								</li>
								<li>
									<div class="info-icon">
										<span class="fa fa-clock-o"></span>
									</div>
									<div class="info-text">Mon - Sat 09:00 - 17:00</div>
								</li>
							</ul>

						</div>
					</div>

					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="footer-item">
							<div class="footer-title">
								Useful Links
							</div>
							
							<ul class="list">
								<li><a href="about.html" title="About us">About us</a></li>
								<li><a href="teachers.html" title="Our Teacher">Our Teacher</a></li>
								<li><a href="classes.html" title="Our Classes">Our Classes</a></li>
								<li><a href="page-events.html" title="Our Events">Our Events</a></li>
								<li><a href="contact.html" title="Contact Us">Contact Us</a></li>
							</ul>
								
						</div>
					</div>
					
					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="footer-item">
							<div class="footer-title">
								Get in Touch
							</div>
							<p>Lit sed The Best in dolor sit amet consectetur adipisicing elit sedconsectetur adipisicing</p>
							<div class="sosmed-icon d-inline-flex">
								<a href="#" class="fb"><i class="fa-brands fa-facebook"></i></a> 
								<a href="#" class="tw"><i class="fa-brands fa-twitter"></i></a> 
								<a href="#" class="ig"><i class="fa-brands fa-instagram"></i></a> 
								<a href="#" class="in"><i class="fa-brands fa-linkedin"></i></a> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="ftex">Copyright 2019 &copy; <span class="color-primary">Kids HTML Template</span>. Designed by <span class="color-primary">Rometheme.</span></p> 
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<!-- JS VENDOR -->
	<script src="{{ asset('modules/theme/frontend/js/vendor/jquery.min.js') }}"></script>
	<script src="{{ asset('modules/theme/frontend/js/vendor/bootstrap.min.js') }}"></script>
	<script src="{{ asset('modules/theme/frontend/js/vendor/owl.carousel.js') }}"></script>
	<script src="{{ asset('modules/theme/frontend/js/vendor/jquery.magnific-popup.min.js') }}"></script>

	<!-- SENDMAIL -->
	<script src="{{ asset('modules/theme/frontend/js/vendor/validator.min.js') }}"></script>
	<script src="{{ asset('modules/theme/frontend/js/vendor/form-scripts.js') }}"></script>

	<script src="{{ asset('modules/theme/frontend/js/script.js') }}"></script>

</body>
</html>