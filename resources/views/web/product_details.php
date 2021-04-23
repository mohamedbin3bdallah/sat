@extends('web.layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product-details.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product-details-responsive.css')}}">
        
       <!-- Info -->

	<div class="intro">
		<div class="container-fluid">
			<div class="row">
			
@if (!empty($alldata))
				<div class="col-lg-3"> <div id="accordion" role="tablist">
						  <h2>Series pump</h2>
  
  @foreach ($alldata as $key => $data)
  <div class="card">
   
    <div class="card-header" role="tab" id="heading{{$key}}">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapse{{$key}}" aria-expanded="{{ ($key == 0)? 'true':'false' }}" aria-controls="collapse{{$key}}">
          {{$data->title}}
        </a>
      </h5>
    </div>

	@if (!empty($data->children))
    <div id="collapse{{$key}}" class="collapse {{ ($key == 0)? 'show':'' }}" role="tabpanel" aria-labelledby="heading{{$key}}" data-parent="#accordion">
      <div class="card-body">
	  @foreach ($data->children as $child)
			<a href="{{url('product/'.$child->id)}}">{{$child->title}}</a>
            <br>
            <!--<em class="mdn-tagline">Painter (1881–1973)</em> 
            <br>-->
		@endforeach
      </div>
    </div>
	@endif
  </div>
  @endforeach
  
            </div>
            </div>
@endif

@if (!empty($service))
				<div class="col-lg-6">
				<!--Carousel Wrapper-->
@if (!empty($service->image()))
<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
	@foreach ($service->image as $img_key => $image)
        <div class="carousel-item {{ ($img_key == 0)? 'active':'' }}">
            <img class="d-block w-100 {{$img_key}}">
        </div>
	@endforeach
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
    <ol class="carousel-indicators">
	@foreach ($service->image as $img_key => $image)
        <li data-target="#carousel-thumb" data-slide-to="{{$img_key}}" class="{{ ($img_key == 0)? 'active':'' }}"> <img class="d-block w-100" src="{{url('uploads/products/'.$image->media_name)}}" class="img-fluid"></li>
	@endforeach
    </ol>
</div>
@endif
<!--/.Carousel Wrapper-->
                        
<!--                   -->
                    <div class="intro_content">
						<div class="intro_title_container">
							<div class="section_title_container">
							<div class="section_title">{{$service->title}}</div>
						</div>
						</div>
						<div class="intro_text">
							<p>{{$service->description}}</p>
						</div>
					</div>
                
<!-- -->


  <div class="row">
         
        @if ($service->category()->first()->parent()->first()->form)
			<br><br><br>
			<a href="{{url('form/'.$service->category()->first()->parent()->first()->form)}}" class="btn btn-primary" style="float:right;">
               Send Inquiry
            </a>
		@endif
                       
    </div>  

</div>
               
			@if (!empty($service->document()))			   
				<div class="col-lg-3">
					<div class="about-history-content bero">
					@php $c = 0 @endphp
					@foreach ($service->document as $doc_key => $document)
						@if($c != $document->document_type_id)
                        <h4>{{$document->doctype()->first()->type_name}}</h4>
                        <ul>
						@endif
                            <li>
								<a href="#" data-toggle="modal" data-target="#show-{{$document->id}}"><i class="fa fa-file-pdf-o"></i> {{$document->document_name}} </a>
								<div id="show-{{$document->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											{{$document->document_name}}
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<div class="embed-responsive embed-responsive-4by3">
												<iframe src="{{url('uploads/documents/'.$document->document_name)}}" class="embed-responsive-item" frameborder="0"></iframe>
											</div>
										</center>
										</div>
									</div>
								</div>
								</div>
							</li>
							@php $c = $document->document_type_id @endphp
						@if($c != $document->document_type_id)
                        </ul>
						@endif
                    @endforeach
                    </div>
				</div>
			@endif
@endif
			</div>
		</div>
	</div>
	
	
@endsection