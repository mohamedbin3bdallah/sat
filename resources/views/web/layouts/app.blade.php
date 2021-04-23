<!DOCTYPE html>
<html lang="en">
<head>
 <!--====== USEFULL META ======-->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sat project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="{{url('uploads/images/logo.png')}}">

  <!--====== STYLESHEETS ======-->
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('resources/assets/lib/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lib/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lib/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/lib/plugins/OwlCarousel2-2.2.1/animate.css')}}">
  <!--======  main STYLESHEETS ======-->
<style>
::selection {
  background: blue !important; /* WebKit/Blink Browsers */
  color: #fff !important;
}
::-moz-selection {
  background: blue !important; /* Gecko Browsers */
  color: #fff !important;
}
</style>
</head>

<body>

<div class="super_container">


	<!--<div class="home">-->

		<!-- Header -->
		
		<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/header.css')}}">
		
		<header class="header">

			<!-- Top Bar -->
			<div class="top_bar">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_container d-flex flex-row align-items-center justify-content-start">
								<div class="logo_container">
									<div class="logo">
										<a href="#">
											<div class="logo_line_1"><span></span></div>

										</a>
									</div>
								</div>
								<div class="top_bar_content ml-auto">

									<div class="register_login">
										<div class="main_menu_phone"><i class="fa fa-mobile" aria-hidden="true"></i>						<span>{{$web_phone->content}}</span></div>
										<div class="main_menu_email">
                      @if (Auth::check())
												<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-user"></i><span>SIGN OUT</span></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
											@else
												<a href="{{url('signin')}}"><i class="fa fa-user"></i><span>SIGN IN</span></a>
											@endif
										</div>
									</div>
									<div class="main_menu_social">
										<ul>
										    <li><a href="{{$smedia[0]->content}}" target="_blank"><i class="fa fa-{{$smedia[0]->title}}" aria-hidden="true"></i></a></li>

											<li><a href="{{$smedia[1]->content}}" target="_blank"><i class="fa fa-{{$smedia[1]->title}}" aria-hidden="true"></i></a></li>

											<li><a href="{{$smedia[2]->content}}" target="_blank"><i class="fa fa-{{$smedia[2]->title}}" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>


                            <!--   burger      -->
								<div class="burger">
									<i class="fa fa-bars" aria-hidden="true"></i>
									<div class=" ml-auto"><div class="logo_img"><img src="{{url('resources/assets/images/Sat_Logo_Final-1.png')}}" alt="sat"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            </div>
			<!-- Main Menu -->
			<div class="main_menu">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="main_menu_container d-flex flex-row align-items-center justify-content-start">
								<div class="main_menu_content">
									<ul class="main_menu_list">
										<li >
											<a href="{{url('/')}}"><div class="logo_img"><img src="{{url('resources/assets/images/Sat_Logo_Final-1.png')}}" alt="sat"></div></a>
										</li>
										<li><a href="{{url('about')}}">ABOUT
											<svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="9px" height="5px" viewBox="0 0 9 5" enable-background="new 0 0 9 5" xml:space="preserve">
												<g>
													<polyline class="arrow_d" fill="none" stroke="#FFFFFF" stroke-miterlimit="10" points="0.022,-0.178 4.5,4.331 9.091,-0.275 	"/>
												</g>
											</svg>
										</a></li>

										<li class="hassubs">
											<a href="{{url('product')}}">PRODUCTS</a>

										<li><a href="{{url('solution')}}">SOLUTIONS
											<svg version="1.1" id="Layer_15" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="9px" height="5px" viewBox="0 0 9 5" enable-background="new 0 0 9 5" xml:space="preserve">
												<g>
													<polyline class="arrow_d" fill="none" stroke="#FFFFFF" stroke-miterlimit="10" points="0.022,-0.178 4.5,4.331 9.091,-0.275 	"/>
												</g>
											</svg>
										</a></li>
										<li><a href="{{url('contact')}}">CONTACT</a></li>
										<li><a href="#"></a></li>
									</ul>
                                </div>
							<div class="search-container">
                              <div class="search-icon-btn">
																<input type="hidden" id="hidden_url" value="{{url('search')}}">
																<!--{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}-->
																<a href="" onclick="this.href=document.getElementById('hidden_url').value+'/'+document.getElementById('search').value" ><i class="fa fa-search"></i></a>
                              </div>
                              <div class="search-input">
                                <input type="search" id="search" value="" class="search-bar" placeholder="Search..">
																<!--<input type="search" name="q" class="search-bar" placeholder="Search..">-->
                              </div>
                            </div>
							</div>
						</div>
					</div>
				</div>
			</div>

	<!-- mobil -->
			<div class="menu">
				<div class="menu_register_login">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="menu_register_login_content d-flex flex-row align-items-center justify-content-end">
									@if (Auth::check())
											<div class="login"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-user"></i><span>SIGN OUT</span></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form></div>
									@else
										<div class="register"><a href="{{url('signin')}}">register</a></div>
										<div class="login"><a href="{{url('signin')}}">login</a></div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
    <!--	mobil menu_list			-->

				<ul class="menu_list">
					<li class="menu_item">
						<div class="container">
							<div class="row">
								<div class="col">
									<a href="{{url('/')}}">HOME</a>
								</div>
							</div>
						</div>
					</li>
					<li class="menu_item">
						<div class="container">
							<div class="row">
								<div class="col">
									<a href="{{url('about')}}">ABOUT</a>
								</div>
							</div>
						</div>
					</li>
					<li class="menu_item">
						<div class="container">
							<div class="row">
								<div class="col">
									<a href="{{url('product')}}">PRODUCTS</a>
								</div>
							</div>
						</div>
					</li>
					<li class="menu_item">
						<div class="container">
							<div class="row">
								<div class="col">
									<a href="{{url('solution')}}">SOLUTIONS</a>
								</div>
							</div>
						</div>
					</li>
					<li class="menu_item">
						<div class="container">
							<div class="row">
								<div class="col">
									<a href="{{url('contact')}}">CONTACT</a>
								</div>
							</div>
						</div>
					</li>
					<!--<li class="menu_item">
						<div class="container">
							<div class="row">
								<div class="col">
									<a href="{{url('signin')}}">SIGN IN</a>

								</div>
							</div>
						</div>
					</li>-->
				</ul>
			</div>
    </header>


 @yield('content')

	<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/footer.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/responsive.css')}}">
	
	<footer class="footer">
		<div class="container">
			<div class="row">

				<!-- Footer Column -->
                    <!-- scroll-->
				  <!--<button class="scroll-top btn btn-warning"><i class="fa fa-angle-up"></i></button>-->
				   <!--  end scroll-->
				<div class="col-md-3 footer_col">
					<div class="footer_about">
						<div class="logo_container footer_logo">
							<div class="logo">
								<a href="#">
									<div class="logo"><img src="{{url('resources/assets/images/logo_sat_white.png')}}" width="70px" alt="" id="sat"></div>
								</a>
							</div>
						</div>
						<p class="footer_about_text">{{$footer[0]->content}}.</p>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="col-md-3 footer_col">
					<div class="footer_links">
						<div class="footer_title">Systems & Technology</div>
						<ul>
							<li><a href="{{url('/')}}">Home</a></li>
							<li><a href="{{url('about')}}">About</a></li>
							<li><a href="{{url('news')}}">News</a></li>
							<li><a href="{{url('product')}}">Products</a></li>
							<li><a href="{{url('solution')}}">Solutions</a></li>
							<li><a href="{{url('contact')}}">Contact</a></li>
							<!--<li><a href="#">Insurance</a></li>
							<li><a href="#">Trades</a></li>
							<li><a href="#">Planning</a></li>-->

						</ul>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="col-md-6 footer_col">
					<div class="footer_newsletter">
						<div class="footer_title">Subscribe to our Newsletter</div>
						@if (session('message'))
							<p style="text-align:center;color:{{session('color')}}">{{session('message')}}</p>
						@endif
						
						@if ($errors->any())
							<ul class="ul-danger">
								@foreach ($errors->all() as $error)
									<li class="li-danger">
										{{$error}}
									</li>
								@endforeach
							</ul>
						@endif
						
						{!! Form::open(['url' => 'subscribe', 'class'=>'footer_newsletter_form']) !!}
							{!! Form::text('email', old('email'), ['class'=>'footer_newsletter_input', 'placeholder'=>'Your E-mail', 'required'=>'required']) !!}
							{!! Form::submit('subscribe', ['name'=>'submit', 'class'=>'footer_newsletter_button']) !!}
						{!! Form::close() !!}

						<div class="footer_newsletter_text">{{$footer[1]->content}}.</div>

						<div class="footer_social">
							<ul>
								<li><a href="{{$smedia[0]->content}}" target="_blank"><i class="fa fa-{{$smedia[0]->title}}" aria-hidden="true"></i></a></li>
    							<li><a href="{{$smedia[1]->content}}" target="_blank"><i class="fa fa-{{$smedia[1]->title}}" aria-hidden="true"></i></a></li>
								<li><a href="{{$smedia[2]->content}}" target="_blank"><i class="fa fa-{{$smedia[2]->title}}" aria-hidden="true"></i></a></li>

							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-4 order-md-1 order-2">

						</div>
					</div>
					<div class="col-md-8 order-md-2 order-1">
						<nav class="footer_nav d-flex flex-row align-items-center justify-content-md-end">
							Copyright © SAT - 2019 All rights reserved | SAT Corporate.
						</nav>
					</div>
				</div>
			</div>
	</footer>


	<!--</div>-->
</div>

	<!--  script      -->
<script src="{{asset('resources/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('resources/assets/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('resources/assets/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/easing/easing.js')}}"></script>
<script src="{{asset('resources/assets/js/wow.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('resources/assets/js/product.js')}}"></script>
<script src="{{asset('resources/assets/js/financial_custom.js')}}"></script>

<script src="{{asset('resources/assets/js/main.js')}}"></script>
<script src="{{asset('resources/assets/js/about_custom.js')}}"></script>
<script src="{{asset('resources/assets/js/contact_custom.js')}}"></script>
<script src="{{asset('resources/assets/js/custom.js')}}"></script>

</body>
</html>
