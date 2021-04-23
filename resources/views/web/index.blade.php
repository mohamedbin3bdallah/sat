<!DOCTYPE html>
<html lang="en">
<head>
<!--====== TITLE TAG ======-->
<title>SAT</title>
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

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/responsive.css')}}">

</head>

<body>

<!--      start container                       -->

<div class="super_container">
	<div class="home">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/main_styles.css')}}">
		@if (isset($sliders[0]))
		<div class="home_slider_container">

			<!-- Home Slider -->

			<div class="owl-carousel owl-theme home_slider">

				<!-- Slider Item -->
				@foreach ($sliders as $slider)
				<div class="owl-item">
					<div class="slider_background" style="background-image:url('{{url('uploads/'.$slider->image)}}')"></div>
					<div class="container fill_height">
						<div class="row fill_height">
							<div class="col fill_height">
								<div class="home_slider_content">
									<h1>{{$slider->content}}</h1>
									<div class="home_slider_text"> {{$slider->title}}</div>
									<!--<div class="link_button home_slider_button"><a href="#">read more</a></div>-->
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>

			<div class="home_slider_nav home_slider_prev d-flex flex-column align-items-center justify-content-center"><img src="{{url('resources/assets/images/arrow_l.png')}}" alt=""></div>
			<div class="home_slider_nav home_slider_next d-flex flex-column align-items-center justify-content-center"><img src="{{url('resources/assets/images/arrow_r.png')}}" alt=""></div>

		</div>
		@endif
      <!--Header -->

<head>
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/header.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/responsive.css')}}">
</head>

		<!-- Header -->
 
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

 

</div>

<!-- Info -->

	@if (isset($pop_services[0]))
	<div class="info">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class=" section_subtitle">take a look at our</div>
						<div class=" section_title" id="two">Popular Products</div>

					</div>
				</div>
			</div>
			<div class="row info_row">

				<!-- Info Item -->
				@foreach ($pop_services as $pop_service)
				<div class="col-md-4 info_col">
					<div class="info_item text-center">
						 <figure class="snip1302">
                              @if ($pop_service->flag == 1)<img src="{{url('uploads/services/'.$pop_service->image()->first()->media_name)}}" alt="sample55"/>
							  @else
								<img src="{{url('uploads/services/'.$pop_service->image()->first()->media_name)}}" alt="sample55"/>
							  @endif
                              <figcaption>
                                <h2>{{(strlen($pop_service->title) > 10)? substr($pop_service->title,0,strpos($pop_service->title,' ',7)):$pop_service->title}}</h2>

                              </figcaption>
								@if ($pop_service->flag == 1) <a href="{{url('product_details/'.$pop_service->id)}}"></a>
								@else <a href="{{url('solution_details/'.$pop_service->id)}}"></a>
								@endif
                            </figure>
						<div class="info_title">{{(strlen($pop_service->title) > 10)? substr($pop_service->title,0,strpos($pop_service->title,' ',7)):$pop_service->title}}</div>
						<div class="info_text">
							<p>{{(strlen(strip_tags($pop_service->brief)) > 75)? substr(strip_tags($pop_service->brief),0,strpos(strip_tags($pop_service->brief),' ',70)):strip_tags($pop_service->brief)}}</p>
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>
	@endif

	<!-- feature product -->

	@if (isset($ftr_services[0]))
	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- news Slider -->
                    <div class="intro_title_container">

	<!-- Home slider -->

                        <h2 class="intro_title  wow fadeInLeft" id="hero">Featured Products<hr></h2>
                    </div>
					<div class="services_slider_container">
						<div class="owl-carousel owl-theme services_slider">

							<!-- slider Item -->
							@foreach ($ftr_services as $ftr_service)
							<div class="owl-item">
								<div class="services_item d-flex flex-column align-items-center justify-content-center">
									<div class="services_item_bg"></div>
									@if($ftr_service->flag == 1)<div class="services_icon"><img class="svg" src="{{url('uploads/services/'.$ftr_service->image()->first()->media_name)}}" alt="main"></div>
									@else <div class="services_icon"><img class="svg" src="{{url('uploads/services/'.$ftr_service->image()->first()->media_name)}}" alt="main"></div>
									@endif
									<div class="services_title">{{(strlen($ftr_service->title) > 10)? substr($ftr_service->title,0,strpos($ftr_service->title,' ',7)):$ftr_service->title}}</div>
									<p class="services_text" style="height: 77px;">
										{{(strlen(strip_tags($ftr_service->brief)) > 75)? substr(strip_tags($ftr_service->brief),0,strpos(strip_tags($ftr_service->brief),' ',70)):strip_tags($ftr_service->brief)}}
									</p>
									<div class="services_link">
										@if ($ftr_service->flag == 1) <a href="{{url('product_details/'.$ftr_service->id)}}">Read More</a>
										@else <a href="{{url('solution_details/'.$ftr_service->id)}}">Read More</a>
										@endif
									</div>
								</div>
							</div>
							@endforeach
                <!-- Services Item -->

						</div>

						<div class="services_nav services_prev d-flex flex-column align-items-center justify-content-center"><img src="{{url('resources/assets/images/arrow_l.png')}}" alt=""></div>
						<div class="services_nav services_next d-flex flex-column align-items-center justify-content-center"><img src="{{url('resources/assets/images/arrow_r.png')}}" alt=""></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
<!--END	-->

	<!-- WHY SAT -->
	<div class="test_faq">
		<div class="container">
			<div class="row">

				<!-- why our -->
				@if (isset($testimons[0]))
				<div class="col-lg-6 test_faq_col">
					<div class="testimonials">
						<div class="section_title_container">
							<div class="section_title">SAT Partners</div>
							<div class="section_subtitle">Here our Amazing Partners</div>
						</div>

						<div class="test_slider_container">
							<div class="owl-carousel owl-theme test_slider">

								<!-- why our -->
								@foreach ($testimons as $testimon)
								<div class="owl-item">
									<div class="testimonial">
										<div class="testimonial_text">{{$testimon->content}}</div>
										<div class="testimonial_author">
											<div class="testimonial_image"><img src="{{url('uploads/'.$testimon->image)}}" alt=""></div>
											<div class="testimonial_content">
												<div class="testimonial_name">{{$testimon->title}}</div>
												<!--<div class="testimonial_title">personal trader</div>-->
											</div>
										</div>
									</div>
								</div>
								@endforeach

							</div>
						</div>
					</div>
				</div>
				@endif

				<!--experience -->
				@if (isset($accordions[0]))
				<div class="col-lg-6 test_faq_col">
					<div class="faq">
						<div class="section_title_container">
							<div class="section_title">SAT/Years Of Experience</div>
							<div class="section_subtitle">take a look at our</div>
						</div>

						<!--system -->
						<div class="elements_accordions">

							@foreach ($accordions as $key => $accordion)
							<div class="accordion_container">
								<div class="accordion d-flex flex-row align-items-center {{ ($key==1)? 'active':'' }}" id="{{ ($key%2==0)? 'panel':'' }}"><div>{{$accordion->title}}</div></div>
								<div class="accordion_panel">
									<p>{{$accordion->content}}</p>
								</div>
							</div>
							@endforeach

						</div>
					</div>
				</div>
				@endif

			</div>
		</div>
	</div>
<!-- end why our -->

<!--  Latest News & Activites-->
	<div class="intro">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
				    @if($new->first()->image)<div class="intro_image text-lg-right text-center"><img src="{{url('uploads/news/'.$new->first()->image)}}"></div>@endif
				</div>
				<div class="col-lg-5">
					<div class="intro_content">
						<div class="intro_title_container">

							<h2 class="intro_title" id="one">Latest News & Activites</h2>
							<div class="intro_subtitle">{{$new->first()->title}}</div>
						</div>
						<div class="intro_text wow fadeInRight">
							<p>{{(strlen(strip_tags($new->first()->description)) > 250)? substr(strip_tags($new->first()->description),0,strpos(strip_tags($new->first()->description),' ',240)):strip_tags($new->first()->description)}}</p>
						</div>
            <!--		modaL				-->
<br><br>
			<a href="{{$video->first()->content}}" class="btn btn-primary" target="_blank">Youtube Channel</a>
            <!--<button type="button" class="btn btn-primary" /*data-toggle="modal" data-target="#myModal">
               watch video
              </button>-->

			  <a href="{{url('news/'.$new->first()->id)}}" class="btn btn-warning" >
               More News...
              </a>

  <!-- The Modal -->
  
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal body -->
        <div class="modal-body" ><div>
        <a href="#" class="stop_video" class="close" data-dismiss="modal" ><button type="button" class="btn btn-danger">&times;</button></a>
       <iframe  class="youtube_video"  width="460" height="315" src="{{$video->first()->content}}" frameborder="0" allowfullscreen></iframe>
        </div>
        </div>

          </div>
        </div>
        </div>
    </div>
    </div>
        </div>
    </div>
        </div>
<!--end news	-->

<!-- Footer -->
	<head>
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/footer.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/responsive.css')}}">
</head>

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

									<div class="logo"><img src="{{asset('resources/assets/images/logo_sat_white.png')}}" width="70px" alt="" id="sat"></div>
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
						<form action="#" class="footer_newsletter_form">
							<input type="email" class="footer_newsletter_input" placeholder="Your E-mail" required="required">
							<button class="footer_newsletter_button" type="submit">subscribe</button>
						</form>
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


<!--end footer-->

    </div>

<!--end container-->

<!--  script      -->
<script src="{{asset('resources/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('resources/assets/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('resources/assets/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/easing/easing.js')}}"></script>
<script src="{{asset('resources/assets/lib/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('resources/assets/js/wow.min.js')}}"></script>
<script src="{{asset('resources/assets/js/main.js')}}"></script>
<script src="{{asset('resources/assets/js/about_custom.js')}}"></script>
<script src="{{asset('resources/assets/js/custom.js')}}"></script>

<script>
   $('a.stop_video').click(function(){
	$('.youtube_video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
});

    </script>

</body>
</html>
