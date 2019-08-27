<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Beranda | {{ $setting->name }}</title> 
	<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png') }}">

	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/animate.css') }}">
    <!-- theme css --> 
    <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/hover.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/effect.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.fancybox.css') }}" >

    <!-- Rev slider css -->
    <link href="{{ URL::asset('assets/css/settings.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/layers.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/navigation.css') }}" rel="stylesheet">
	<script src="{{ URL::asset('assets/js/jquery-2.2.4.js') }}"></script>

    <!-- endinject -->

</head>
<body>

        <!--================Header Area =================-->
        <header class="main_header_area menu_color">
            <div class="header_top" style="background-color:#000;">
                <div class="container">
                    <div class="header_top_inner" >
                        <div class="pull-left">
                            <a href="#"><i class="fa fa-phone"></i>{{ $setting->hp }}</a>
                            <a href="#"><i class="fa fa-envelope-o"></i>{{ $setting->email }}</a>
                            
                        </div>
                        <div class="pull-right">
                            <ul class="header_social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_menu" style="background-color:#92D8DE;">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ url ('/') }}"><img src="{{ URL::asset('images') }}/{{ $setting->logo }}" alt=""></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
							<li><a href="{{ url('/') }}" role="button" aria-haspopup="true" aria-expanded="false">Home</a></li>
							@foreach($data as $hal )
						    @if ($hal->status_aktif == 1)
							<li >
                               <a href="{{ url('hal') }}/{{ $hal->id }}" role="button" aria-haspopup="true" aria-expanded="false">{{ $hal->title }} </a>
							</li>
							@elseif ($hal->status_aktif == 2)
							<li class="dropdown submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $hal->title }} <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
										@foreach(\App\SubPage::where('page_id', '=', $hal->id)->where('status_aktif', '1')->get() as $hala )
										<li style="background-color:black;"><a target="_blank" href="{{ url('subhal') }}/{{ $hala->id }}">{{ $hala->title }}</a></li>
										@endforeach
                                    </ul>
                            </li>
							@endif
							@endforeach
							
                               
                                
                                
                                
                                <!--
                                <li class="submenu dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
								
                                <li><a href="contact-us.html">Contact</a></li>
								-->
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="search_dropdown">
                                    <a href="#"><i class="icon icon-Search"></i></a>
                                    <ul class="search">
                                        <li>
                                            <form action="#" method="get" class="search-form">
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Search for">
                                                    <span class="input-group-addon">
                                                        <button type="submit"><i class="icon icon-Search"></i></button>
                                                    </span>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </header>
        <!--================Header Area =================-->
        
		<!--================Start Running Text =================-->
		 <div class="header_top" style="background-color:#000;">
                <div class="container">
                    <div class="header_top_inner" >
                        <marquee style="color:white;">{{ $setting->description }}</marquee>
                    </div>
                </div>
         </div>

	@yield('content')
               


        <!--warna ada di style.css cari ini > 
		.footer-top .right-text::before 
		footer-top .right-text::after
		-->
        <section class="footer-top" >
            <div class="thm-container" >
                <div class="clearfix">
                    <div class="col-md-4 hidden-sm hidden-xs pull-left img-box" >
                        <img src="{{ URL::asset('images/kapolresf.png') }}" alt="Images">
                    </div>
                    <div class="col-md-7 col-sm-12 right-text pull-right" >
                        <div class="box" >
                            <div class="text-box">
                                <h3>Anda membutuhkan Pengaduan</h3>
                                <p>Kami Siap Membantu Anda Segera Hubungi</p>
                                <p><span class="number">Call Us: {{ $setting->phone }}</span><p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
        </section>
        <!--================Footer Area =================-->
        <footer class="footer_area" style="background-color:black;">
            <div class="footer_widget" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <aside class="f_widget about_widget">
                                <img src="{{ URL::asset('images') }}/{{ $setting->logo }}" alt="">
                                <p>{{ $setting->description }}.</p>
                                <a class="f_r_link" href="#">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                <ul class="f_social">
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                                   
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <aside class="f_widget padd-l-60">
                                <div class="f_title">
                                    <h3>site map</h3>
                                </div>
                                <div class="link_widget">
                                    <ul>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Layanan</a></li>
                                        <li><a href="#">Inovasi</a></li>
                                        <li><a href="#">Privacy </a></li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <aside class="f_widget">
                                <div class="f_title">
                                    <h3>our services</h3>
                                </div>
                                <div class="link_widget">
                                <ul>
                                    <li><a href="#">SIM</a></li>
                                    <li><a href="#">STNK</a></li>
                                    <li><a href="#">SKCK</a></li>
                                </ul>
                            </div>
                            </aside>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <aside class="f_widget contact_widget">
                                <div class="f_title">
                                    <h3>get in touch</h3>
                                </div>
                                <div class="contact_inner">
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <!-- <h4>Consult plus</h4> -->
                                            <p>{{ $setting->address }}</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="#">{{ $setting->hp }}</a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="#">{{ $setting->email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_copyright">
                <div class="container-fluid">
                    <div class="footer_copyright_inner">
                        <div class="pull-left">
                            <p>Copyright © 2018 All rights reserved. </p>
                        </div>
                        <div class="pull-right">
                            <h4>Created by: <a href="#">Haris Saktiawan Kasman</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--================End Footer Area =================-->
       


<!-- Start js -->

<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/owl.carousel.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/revolution.extension.video.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/revolution.extension.navigation.min.js') }}"></script>

<!-- Start slider js -->
<script src="{{ URL::asset('assets/js/nav.js') }}"></script>
<!-- theme js -->
<script src="{{ URL::asset('assets/js/theme.js') }}"></script>
<!-- Start wow js -->
<script src="{{ URL::asset('assets/js/wow.js') }}"></script>
<!-- Start gallery js -->
<script src="{{ URL::asset('assets/js/jquery.fancybox.pack.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.mixitup.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/isotope.js') }}"></script>
<script src="{{ URL::asset('assets/js/gallery.js') }}"></script>

<!-- end  -->
</body>
</html>

