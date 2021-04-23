@extends('web.layouts.app')

@section('content')

<title>Home</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/main_styles.css')}}">

	@if (!empty($sliders))
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

<!-- Info -->

	@if (!empty($pop_services))
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
                              @if ($pop_service->flag == 1)<img src="{{url('uploads/products/'.$pop_service->image()->first()->media_name)}}" alt="sample55"/>
							  @else
								<img src="{{url('uploads/solutions/'.$pop_service->image()->first()->media_name)}}" alt="sample55"/>
							  @endif
                              <figcaption>
                                <h2> {{$pop_service->title}}</h2>

                              </figcaption>
                              <a href="#"></a>
                            </figure>
						<div class="info_title">{{$pop_service->title}}</div>
						<div class="info_text">
							<p>{{$pop_service->description}}</p>
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>
	@endif

	<!-- feature product -->
	@if(!empty($ftr_services))
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
									@if($ftr_service->flag == 1)<div class="services_icon"><img class="svg" src="{{url('uploads/products/'.$ftr_service->image()->first()->media_name)}}" alt="main"></div>
									@else <div class="services_icon"><img class="svg" src="{{url('uploads/solutions/'.$ftr_service->image()->first()->media_name)}}" alt="main"></div>
									@endif
									<div class="services_title">{{$ftr_service->title}}</div>
									<p class="services_text">{{$ftr_service->description}}</p>
									<!--<div class="services_link"><a href="#">Read More</a></div>-->
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
				@if (!empty($testimons))
				<div class="col-lg-6 test_faq_col">
					<div class="testimonials">
						<div class="section_title_container">
							<div class="section_title">Why Choose SAT ?</div>
							<div class="section_subtitle">take a look at our</div>
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
												<div class="testimonial_name">SAT® International </div>
												<div class="testimonial_title">personal trader</div>
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
				@if (!empty($accordions))
				<div class="col-lg-6 test_faq_col">
					<div class="faq">
						<div class="section_title_container">
							<div class="section_title">SAT/years of experience</div>
							<div class="section_subtitle">take a look at our</div>
						</div>

						<!--system -->
						<div class="elements_accordions">

							@foreach ($accordions as $key => $accordion)
							<div class="accordion_container">
								<div class="accordion d-flex flex-row align-items-center {{ ($key == 0)? 'active':'' }}" id="panel"><div>{{$accordion->title}}</div></div>
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
				    <div class="intro_image text-lg-right text-center"><img src="{{url('uploads/'.$new->first()->image)}}"></div>
				</div>
				<div class="col-lg-5">
					<div class="intro_content">
						<div class="intro_title_container">

							<h2 class="intro_title" id="one">Latest News & Activites</h2>
							<div class="intro_subtitle">{{$new->first()->title}}</div>
						</div>
						<div class="intro_text wow fadeInRight">
							<p>{{$new->first()->content}}</p>
						</div>
            <!--		modaL				-->

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
               watch video
              </button>

			  <a href="{{url('news')}}" class="btn btn-warning" >
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

<script>
   $('a.stop_video').click(function(){
	$('.youtube_video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
});

</script>

@endsection
