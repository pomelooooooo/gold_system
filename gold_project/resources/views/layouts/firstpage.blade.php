<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- title -->
    <title>Welcome To Goldsystem</title>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="{{url('/home')}}">
                                <img src="{{url('assets/img/logo1.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- hero area -->
    <div class="hero-area hero-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-2 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <p class="subhomepage">ระบบจัดการร้านทอง</p>
                            <h1 class="subtitle">Gold <span class="white-text">System</span></h1>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero area -->
</body>

</html>