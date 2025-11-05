<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../">
	<title>Sistem Baragud</title>
	<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
	<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
	<meta property="og:url" content="https://keenthemes.com/metronic" />
	<meta property="og:site_name" content="Keenthemes | Metronic" />
	<link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/media/logos/favicon.ico" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:lighter,normal,bold&display=swap">
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="<?php echo base_url(); ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<style>
		body,
		html {
			font-family: "Roboto", "Helvetica Neue", Arial, sans-serif !important;
		}

		.container-fluid.lp {
			max-width: 160rem;
		}

		.container-fluid {
			width: 100%;
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;
		}

		.container-fluid {
			width: 100%;
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;
		}

		header .container-fluid {
            background-color: transparent;
            border-bottom: 1px solid transparent;
        }

		.carousel-fade .carousel-item {
            /*height: 681px;*/
            height: 570px;
            z-index: 1 !important;
        }

        @media (max-width: 2560px) {
            .carousel-fade .carousel-item {
                min-height: 990px !important;
            }
        }

        @media (max-width: 1440px) {
            .carousel-fade .carousel-item {
                min-height: 667px !important;
            }
        }

        @media (max-width: 1366px) {

            .carousel-fade .carousel-item {
                min-height: 667px !important;
            }
        }

        @media (max-width: 1280px) {
            .carousel-fade .carousel-item {
                min-height: 400px !important;
            }
        }

		.carousel-indicators {
            z-index: 9998 !important;
        }

        .carousel-fade .carousel-item.active {
            z-index: 9997 !important;
        }

		.carousel-indicators .active {
			opacity: 1;
		}

        .carousel-indicators li {
            box-sizing: content-box;
            width: 15px;
            height: 15px;
            border-radius: 8px;
            border: 1px solid transparent;
            margin: 0 15px;
			text-indent: -999px;
			cursor: pointer;
			background-color: #fff;
			background-clip: padding-box;
        }

        .carousel.carousel-fade .carousel-item {
            display: block;
            opacity: 0;
            transition: opacity ease-out 0.7s;
            left: 0;
            top: 0;
            position: absolute;
        }

        .carousel.carousel-fade .carousel-item.active {
            opacity: 1 !important;
        }

        .carousel.carousel-fade .carousel-item:first-child {
            top: auto;
            position: relative;
            transition: opacity ease-out 0.7s;
        }
	</style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Signup Welcome Message -->
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="position: absolute;
				z-index: 9999;
				background-color: rgba(255,255,255,.75);
				top:0;
				bottom: 0;
				left: 0;
				right: 0;
				width: 500px;
				height: 450px;
				box-shadow: 0px 0px 5px 5px rgb(0 0 0 / 35%);
				border-radius: 10px;
				margin-top:10%;
				margin-bottom:10%;
				margin-left: auto;
				margin-right: auto;">
			<!--begin::Content-->
			<div class="d-flex flex-column flex-column-fluid text-center p-5 py-lg-10">
				<!--begin::Logo-->
				<a href="<?php echo site_url('welcome'); ?>" class="mb-5 pt-lg-10">
					<img alt="Logo" src="<?php echo base_url(); ?>assets/media/logos/Socfindo-Logo.svg" class="h-100px mb-5" />
				</a>
				<!--end::Logo-->
				<!--begin::Wrapper-->
				<div class="pt-lg-5">
					<!--begin::Logo-->
					<h1 class="fw-bolder fs-2qx text-gray-800 mb-5">Selamat Datang</h1>
					<!--end::Logo-->
					<!--begin::Message-->
					<div class="fw-bold fs-3 text-muted mb-5">Proses Pengadaan Barang yang Cepat, Akurat, & Terbuka</div>
					<!--end::Message-->
					<!--begin::Action-->
					<div class="text-center">
						<a href="<?php echo site_url('login') ?>" class="btn btn-lg btn-success fw-bolder">Masuk</a>
					</div>
					<!--end::Action-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Content-->
			<!--begin::Footer-->
			<div class="d-flex flex-center flex-column-auto p-5">
				<!--begin::Links-->
				<!-- <div class="d-flex align-items-center fw-bold fs-6">
						<a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
						<a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
						<a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
					</div> -->
				<!--end::Links-->
			</div>
			<!--end::Footer-->
		</div>
		<!--end::Authentication - Signup Welcome Message-->
		<div class="d-flex flex-column flex-column-fluid">
			<div class="d-flex flex-column flex-column-fluid"
				style="height: 4.25rem; z-index: 9998 !important; position:absolute; width:100%; background-image: linear-gradient(to top, rgba(255,255,255,0), rgba(255,255,255,1));">
			</div>
			<div id="carouselExampleIndicators" class="d-flex flex-column flex-column-fluid slide carousel carousel-fade" data-ride="carousel">
				<ol class="carousel-indicators my-5">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="carousel-item d-flex align-items-center active"
						style="background: url('<?php echo base_url(); ?>/assets/media/slideshow/01-Report.jpg') bottom center no-repeat; background-size: cover">
						<!-- <div class="container">
							<div class="row">
								<h1 class="col-12">Socfindo<br>Sustainability Report 2020</h1>
								<p class="col-12 my-4">
									This report marks a significant step in our sustainability journey and<br>
									provides a transparent window on how we manage sustainability.
								</p>
								<p class="col-12">
									<a href="/sustainability#a2" class="btn">Find out more</a>
									<a target="_blank" href="/documents/eng/Socfindo-Sustainability-Report-2020.pdf" class="btn ml-3">Download Report</a>
								</p>
							</div>
						</div> -->
					</div>
					<div class="carousel-item d-flex align-items-center"
						style="background: url('<?php echo base_url(); ?>/assets/media/slideshow/02-Products.jpg') bottom center no-repeat; background-size: cover">
						<!-- <div class="container">
							<h1>Products</h1>
							<p class="my-4">
								Seeds, oil palm & rubber seedlings
							</p>
							<a href="/products" class="btn">Find out more</a>
						</div> -->
					</div>
					<div class="carousel-item d-flex align-items-center"
						style="background: url('<?php echo base_url(); ?>/assets/media/slideshow/03-Services.jpg') bottom center no-repeat; background-size: cover">
						<!-- <div class="container">
							<h1>Services</h1>
							<p class="my-4">
								Analytical laboratory and consultancy
							</p>
							<a href="/services" class="btn">Find out more</a>
						</div> -->
					</div>
					<div class="carousel-item d-flex align-items-center"
						style="background: url(<?php echo base_url(); ?>/assets/media/slideshow/04-Sustainability.jpg) bottom center no-repeat; background-size: cover">
						<!-- <div class="container" style="color: #fff !important; text-shadow: 0px 0px 10px #333">
							<h1>Sustainability</h1>
							<p class="my-4 font-weight-normal">
								An insight to our approach
							</p>
							<a href="/sustainability" class="btn" style="text-shadow: none !important;">Find out more</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end::Main-->
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="<?php echo base_url(); ?>assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/scripts.bundle.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>