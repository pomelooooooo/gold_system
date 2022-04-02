<!DOCTYPE html>
<html lang="th">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">
	<meta http-equiv="Content-Language" content="th" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">


	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- title -->
	<title>@yield('title')</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{url('assets/img/favicon.png')}}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap" rel="stylesheet">

	<!-- fontawesome -->
	<link rel="stylesheet" href="{{url('assets/css/all.min.css')}}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{url('assets/css/owl.carousel.css')}}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{url('assets/css/magnific-popup.css')}}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{url('assets/css/animate.css')}}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{url('assets/css/meanmenu.min.css')}}">
	<!-- main style -->
	<link rel="stylesheet" href="{{url('assets/css/main.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{url('assets/css/responsive.css')}}">

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	@yield('style')

</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center" style="height: 50px;">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
						@if(\Auth::user()->row_id == '0')
							<div class="avatar">
								<a href="/manage_employee/{{\Auth::user()->id}}/edit">
									<img src="{{url('assets/img/employee/'.Auth::user()->picture)}}" class="avatar__image">
									<br>
									{{Auth::user()->name}}
								</a>
							</div>
						@else
							<div class="avatar">
								<a href="/manage_employee/{{\Auth::user()->id}}/edit">
									<img src="{{url('assets/img/employee/'.Auth::user()->picture)}}" class="avatar__image">
									<br>
									{{Auth::user()->name}}
								</a>
							</div>
						@endif
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								@if(\Auth::user()->row_id == '1')
									<li><a href="/median_price">ราคากลางทองประจำวัน</a></li>
								@endif
								@if(\Auth::user()->row_id == '0')
								<li class="current-list-item"><a>จัดการข้อมูลร้าน</a>
									<ul class="sub-menu">
										<li><a href="/stores">จัดการข้อมูลร้าน</a></li>
										<li><a href="/median_price">ราคากลางทองประจำวัน</a></li>
									</ul>
								</li>
								@endif
								<li><a>จัดการข้อมูลผู้ใช้งาน</a>
									<ul class="sub-menu">
									@if(\Auth::user()->row_id == '0')
										<li><a href="/manage_employee">จัดการข้อมูลพนักงาน</a></li>
									@endif
										<li><a href="/manage_customer">จัดการข้อมูลลูกค้า</a></li>
									</ul>
								</li>
								@if(\Auth::user()->row_id == '0')
								<li><a>คลังทอง</a>
									<ul class="sub-menu">
										<li><a href="/manufacturer">จัดการข้อมูลผู้ผลิต</a></li>
										<li><a href="/type_gold">จัดการประเภททอง</a></li>
										<li><a href="/striped">จัดการลายทอง</a></li>
										<li><a href="/product">จัดการล็อตทอง</a></li>
										<li><a href="/productdetail">จัดการข้อมูลทอง</a></li>
										<li><a href="/stock">เช็คสต๊อก</a></li>
										<li><a href="/stockold">ส่งโรงหลอม</a></li>
									</ul>
								</li>
								@endif
								<li><a>การซื้อขายทอง</a>
									<ul class="sub-menu">
										<li><a href="/buy">ซื้อทอง</a></li>
										<li><a href="/sell">ขายทอง</a></li>
									</ul>
								</li>
								<li><a href="/pledge">การจำนำทอง</a></li>
								@if(\Auth::user()->row_id == '0')
								<li><a>รายงานผลการดำเนินงาน</a>
									<ul class="sub-menu">
										<li><a href="/buy_report">ประวัติการซื้อย้อนหลัง</a></li>
										<li><a href="/sell_report">ประวัติการขายย้อนหลัง</a></li>
										<li><a href="/report_pledge">ประวัติการจำนำย้อนหลัง</a></li>
									</ul>
								</li>
								@endif
								<li>
									<div class="header-icons">
										<i class="fas fa-sign-out-alt white-text"></i>
										<a class="shopping-cart" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											{{ __('ออกจากระบบ') }}
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>

										<!-- <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a> -->
									</div>
								</li>
							</ul>
						</nav>
						<!-- <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div> -->
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<!-- <div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end search area -->

	@yield('content')

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">ข้อมูลร้านทอง</h2>
						<p>ห้างหุ้นส่วนจำกัด มาทอง เยาราช (สำนักงานใหญ่) เลขประจำตัวผู้เสียภาษี 0803564001495 <br>
                		เลขที่ 158 หมู่ที่ 1 ตำบลขนอม อำเภอขนอม </br>จังหวัดนครศรีธรรมราช</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">เวลาเปิด-ปิดทำการ</h2>
						<p>เวลา 8.00 - 18.00 น.</p>
						<!-- <form action="index.html">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form> -->
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">ข้อมูลการติดต่อ</h2>
						<ul>
							<!-- <li><i class="fa fa-envelope" aria-hidden="true"></i> support@fruitkha.com</li> -->
							<li><i class="fab fa-facebook-f"></i> ห้างทองมาทอง เยาวราช</li>
							<li><i class="fa fa-phone" aria-hidden="true"></i> 065 449 5858</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- jquery -->
	<script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>
	<!-- count down -->
	<script src="{{url('assets/js/jquery.countdown.js')}}"></script>
	<!-- isotope -->
	<script src="{{url('assets/js/jquery.isotope-3.0.6.min.js')}}"></script>
	<!-- waypoints -->
	<script src="{{url('assets/js/waypoints.js')}}"></script>
	<!-- owl carousel -->
	<script src="{{url('assets/js/owl.carousel.min.js')}}"></script>
	<!-- magnific popup -->
	<script src="{{url('assets/js/jquery.magnific-popup.min.js')}}"></script>
	<!-- mean menu -->
	<script src="{{url('assets/js/jquery.meanmenu.min.js')}}"></script>
	<!-- sticker js -->
	<script src="{{url('assets/js/sticker.js')}}"></script>
	<!-- main js -->
	<script src="{{url('assets/js/main.js')}}"></script>

</body>

</html>