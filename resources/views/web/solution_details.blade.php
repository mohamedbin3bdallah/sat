@extends('web.layouts.app')

@section('content')

<title>Solution Details</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/solution-details.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/solution-details-responsive.css')}}">

<style>
.img_h {width: auto; height: 100%;}
.img_w {width: 100%; height: auto;}
.carousel-item {width: 868px; height: 394.5px;}
.center {
  display: block;
  margin: auto;
}
</style>

       <!-- Info -->

	
	<div class="intro">
		<div class="container-fluid">
			<div class="row">
			
@if (!empty($alldata))
				<div class="col-lg-3"> <div id="accordion" role="tablist">
						  <!--<h2>Series pump</h2>-->
  
  @foreach ($alldata as $key => $data)
  <div class="card">
   
    <div class="card-header" role="tab" id="heading{{$key}}">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapse{{$key}}" aria-expanded="{{(!empty($service) and ($service->category()->first()->parent()->first()->id == $data->id))? 'true':'false'}}" aria-controls="collapse{{$key}}">
          {{$data->title}}
        </a>
      </h5>
    </div>

	@if (!empty($data->children))
    <div id="collapse{{$key}}" class="collapse {{(!empty($service) and ($service->category()->first()->parent()->first()->id == $data->id))? 'show':''}}" role="tabpanel" aria-labelledby="heading{{$key}}" data-parent="#accordion">
      <div class="card-body">
	  @foreach ($data->children as $child)
			<a href="{{url('solution/'.$child->id)}}">{{$child->title}}</a>
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
	<?php $keys = array(); ?>
<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
	@foreach ($service->image as $img_key => $image)
		<?php $keys[] = $img_key; ?>
        <div class="carousel-item {{ ($img_key == 0)? 'active':'' }}">
            <img id="{{'img'.$img_key}}" src="{{url('uploads/services/'.$image->media_name)}}" class="center d-block one {{$img_key}}">
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
    <!--<ol class="carousel-indicators">
	@foreach ($service->image as $img_key => $image)
        <li data-target="#carousel-thumb" data-slide-to="{{$img_key}}" class="{{ ($img_key == 0)? 'active':'' }}"> <img class="d-block w-100" src="{{url('uploads/services/'.$image->media_name)}}" class="img-fluid"></li>
	@endforeach
    </ol>-->
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
							<p><?php echo htmlspecialchars_decode(stripslashes($service->brief)); ?></p>
							<p><?php echo htmlspecialchars_decode(stripslashes($service->description)); ?></p>
						</div>
					</div>
                
<!-- -->

	<br><br>
  <div class="row">
         
        @if ($service->category()->first()->parent()->first()->form)
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
								<a href="#" data-toggle="modal" data-target="#show-{{$document->id}}"><i class="fa fa-file-pdf-o"></i> {{$document->title}} </a>
								<div id="show-{{$document->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											{{$document->title}}
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
	
<script>
	@if(!empty($keys))
		@foreach ($keys as $my_key)
			var width = document.getElementById('img{{$my_key}}').width;
			var height = document.getElementById('img{{$my_key}}').height;
			if((height/width) >= (394.5/868))
			{
				document.getElementById('img{{$my_key}}').classList.add('img_h');
			}
			else if((height/width) < (394.5/868))
			{
				document.getElementById('img{{$my_key}}').classList.add('img_w');
			}
		@endforeach
	@endif
</script>

@endsection