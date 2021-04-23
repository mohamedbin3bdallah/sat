@extends('web.layouts.app')

@section('content')

<title>About</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/aboutus.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/aboutus_responsive.css')}}">

    <div id="history" class="company-history">
       <div class="container">
          <div class="features_title">{{$alldata[0]->title}}<hr></div>
           <div class="row">
             <div class="col-md-6">
            <div class="about-history-content">
                <p>{{$alldata[0]->content}}.</p>
            </div>
        </div>
         <div class="col-md-6">
            <div class="about-history-content">
                <img src="{{url('uploads/'.$alldata[0]->image)}}" alt="">
            </div>
        </div>
   </div>

		@if (isset($timelines[0]))
            <div class="row">
                <div class="col-md-12">
                    <div class="about-history-content history-list">
                    @foreach($timelines as $timeline)
					<div class="single-history">
                        <div class="history-year">
                            <p class="one">{{substr($timeline->title, strpos($timeline->title,'Y4D')+3, 4)}}</p>
                        </div>
                        <h4>{{substr($timeline->title, 0, strpos($timeline->title,'Y4D'))}}</h4>
                        <p>{{$timeline->content}}.</p>
                    </div>
					@endforeach
					</div>
                </div>
            </div>
		@endif
        </div>

    </div>
    <!-- Services

	<!--  our mission  -->

   <div class="our mission" id="our">
    <div class="container">
     <div class="row">

                <div class="col-md-4">
                    <div class="about-history-content">
						<div class="features_title">{{$alldata[1]->title}}<hr></div>
                      <p class="one">{{$alldata[1]->content}}.

                         </p>


                        <!--<a href="#" class="read-more">Learn More</a>-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-history-content">
                        <img src="{{url('uploads/'.$alldata[1]->image)}}" width="100%" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-history-content">
						<div class="features_title">{{$alldata[2]->title}}<hr></div>
                         <p class="one">{{$alldata[2]->content}}. </p>
                        <!--<ul>
                            <li><i class="fa fa-check"></i> Lorem ipsum dolor sit amet, consectetur.</li>
                            <li><i class="fa fa-check"></i> Lorem ipsum dolor sit amet, consectetur.</li>
                            <li><i class="fa fa-check"></i> Lorem ipsum dolor sit amet, consectetur.</li>
                             <li><i class="fa fa-check"></i> Lorem ipsum dolor sit amet, consectetur.</li>
                        </ul>
                        <a href="#" class="read-more">Learn More</a>-->
                    </div>
                </div>
                </div>
                </div>
            </div>

@endsection
