<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
	
    {{-- Bootstrap 4 --}}
	<link href="{{ asset('public/home/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('public/home/js/bootstrap.min.js') }}"></script>
	{{-- Jquery --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{ asset('public/home/css/global.css') }}" rel="stylesheet">
	<link href="{{ asset('public/home/css/index.css') }}" rel="stylesheet">
	<link href="{{ asset('public/home/css/products.css') }}" rel="stylesheet">
	{{-- Font Style --}}
	<link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/home/css/font-awesome.min.css') }}" />

    <link href="{{ asset('public/home/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    {{-- <script src="{{ asset('public/home/js/jquery-2.1.1.min.js') }}"></script> --}}

	@yield('link_css')
	{{-- Font AweSome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
	{{-- Sweet Alert --}}
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<style>
		.header-area {
    		background: none repeat scroll 0 0 #f4f4f4;
		}
		.header-area a {
			color: #888;
		}
		.user-menu ul {
			list-style: outside none none;
			margin: 0;
			padding: 0;
		}
		.user-menu li {
			display: inline-block;
		}
		.user-menu li a {
			display: block;
			font-size: 13px;
			margin-right: 5px;
			padding: 10px;
		}
		.user-menu li a i.fa {
			margin-right: 5px;
		}
		.button{ 
			font-size: 18px;
			border: 1px solid #e60f0f;
			padding: 13px 38px 13px 38px;
			border-radius: 10px;
			color: rgb(255, 255, 255);
			background: rgb(220, 50, 32);
			letter-spacing: 1px;
		}
		.button:hover{ 
			color: #ffffff;
			background: #a00d0d;
			border-color: #a00d0d;
		}
		.navbar-nav1  {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			float: right;
		}
		
		.hvr-underline-from-center1 {
			float: left;
		}
	</style>
  </head>
<body>

        @include('layout.header_home')

<section id="header" class="cd-secondary-nav">
 <div class="container">
  <div class="row">
   	<nav class="navbar navbar-default">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		{{-- <button type="button" style="padding-bottom:5px; margin-bottom: 15px; padding-right:10px" class="navbar-toggle" data-toggle="collapse" data-target="#dropdown-thumbnail-preview">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button> --}}

			<ul class="nav navbar-nav" style="float: left; padding-top: 0px;">
				<li style="margin-left: 80px"></li>
				<li class="active"><a href="{{ url('/') }}" class="hvr-underline-from-center1">TRANG CHỦ</a></li>
				<li><a href="{{ url('page-category') }}" class="hvr-underline-from-center1">MENU</a></li>
				<li><a href="{{ url('page-table') }}" class="hvr-underline-from-center1">ĐẶT BÀN</a></li>
				<li><a href="#" class="hvr-underline-from-center1">TIN TỨC</a></li>
				<li><a href="{{ url('page-contact') }}" class="hvr-underline-from-center1">LIÊN HỆ</a></li>
				
			</ul>
		</div>
		</nav>
  	</div>
  </div>
</section>

@yield('content')

<section id="footer" class="clearfix" >
  <div class="col-sm-12 space_all"style="display: flex;">
  <div class="col-sm-3">
    <div class="footer_1">
	 <h4>SEMPER</h4>
	<p>Lorem ipsum dolor sit amet, consectetur
	adipiscing elit. Integer nec odionec odio Sed cursus ante
	Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis
	nostra, per inceptos . Curabitursodales ligula in libero
	Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum</p>
	</div>
	</div>
	<div class="col-sm-2">
	  <div class="footer_2">
	 <h4>DIGNISSIM</h4>
	<ul>
	   <li><a href="#">Nostra</a></li>
	   <li><a href="#">Lacinia Nunc</a></li>
	   <li><a href="#">Duis Sagittis</a></li>
	   <li><a href="#">Nulla Quis</a></li>
	   <li><a href="#">Nec</a></li>
	   <li><a href="#">Ante</a></li>
	</ul>
	</div>
	</div>
	<div class="col-sm-3">
	 <div class="footer_3">
	 <h4>ELEMENTUM </h4>
	<p>Torquent per conubia nostra, per ligula in libero.Sed.</p>
	<input type="text" class="form-control" placeholder="Enter your email address"><br>
	 <a href="#" class="button">Submit</a>
	</div>
	</div>
	<div class="col-sm-4">
	 <div class="footer_4">
	 <h4>SED NISI</h4>
	  <ul>
	     <li><i class="fa fa-map-marker"></i>Address: Integer Nec Odionec</li>
         <li><i class="fa fa-phone"></i>Phones: <a href="#">123-2345-6789</a></li>
         <li><i class="fa fa-user"></i>Fusce Nec Tellus Sed Augue Semper.</li>
         <li><i class="fa fa-envelope"></i>E-mail:<a href="#"> info@gmail.com</a></li> 
     </ul>
	</div>
	</div>
  </div>
</section>
<section id="footer_main" class="clearfix">
	 <div class="col-sm-12 space_all">
	  <div class="footer_main_1">
	    <p>© 2013 Your Website Name. All Rights Reserved. Design by<a href="http://www.TemplateOnWeb.com"> Template On Web</a> </p>
	  </div>
	 </div>
</section>

<script>
	$(document).ready(function(){
		/*****Fixed Menu******/
		var secondaryNav = $('.cd-secondary-nav'),
		secondaryNavTopPosition = secondaryNav.offset().top;
			$(window).on('scroll', function(){
				if($(window).scrollTop() > secondaryNavTopPosition ) {
					secondaryNav.addClass('is-fixed');	
				} else {
					secondaryNav.removeClass('is-fixed');
				}
			});	
			
	});
</script>

<script>
		$(document).ready(function() {
		$('#Carousel').carousel({
			interval: 5000
		})
	});
</script>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>

<script>
	function nonlogin(msg){
		if(window.confirm(msg)){
			return true;
		}
		return false;
	}
</script>
</body>

</html>