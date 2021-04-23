
@extends('web.layouts.app')

@section('content')

<title>News</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/news.css')}}">

@if (!empty($alldata))
<div class="test_faq">
		<div class="container-fluid">
			<div class="row">
              <div class="col-lg-3 test_faq_col">
               <h2></h2>
               <div class="ex3">
              <div id="sidebar">

		@foreach ($alldata as $data)
              <center>
  <a href="{{url('news/'.$data->id)}}"><h2>{{$data->title}}</h2></a>
  @if($data->image)<img src="{{url('uploads/news/'.$data->image)}}" width="100%">@endif
  <!--<p>{{$data->description}}.</p>-->  </center>
      <br>
		@endforeach
</div>

               </div>
                </div>


                  <!--     descrip img              -->
              <!-- News Post -->
			  @if (!empty($new))
				<div class="col-lg-9 news_col">
					<div class="news_post">
						@if($new->image)<div class="news_image"><img src="{{url('uploads/news/'.$new->image)}}" alt=""></div>@else <br><br><br> @endif
						<div class="news_date d-flex flex-column align-items-center justify-content-center">
							<div class="news_month">{{date('M', strtotime($new->created_at))}}</div>
							<div class="news_day">{{date('d', strtotime($new->created_at))}}</div>
						</div>
						<div class="news_content">
							<div class="news_title">{{$new->title}}</div>
							<div class="news_text">
								<p><?php echo htmlspecialchars_decode(stripslashes($new->description)); ?>.</p>


							</div>
							
							<br><br><br>
							@if ($new->pdf)
				<a href="#" data-toggle="modal" data-target="#show-{{$new->id}}">PDF File</a>
					<div id="show-{{$new->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											{{$new->pdf}}
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<div class="embed-responsive embed-responsive-4by3">
												<iframe src="{{url('uploads/news/'.$new->pdf)}}" class="embed-responsive-item" frameborder="0"></iframe>
											</div>
										</center>
										</div>
									</div>
								</div>
							</div>
				@endif
				
						</div>
					</div>
				</div>
				
				@endif
       </div>
     </div>

      </div>
@endif

@endsection
