@extends('web.layouts.app')

@section('content')

<title>Product</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product-responsive.css')}}">

<style>
.img_h {width: auto; height: 100%;}
.img_w {width: 100%; height: auto;}
.carousel-item {width: 352px; height: 285px;}
.product_col {border: 2px solid #0d50a2; border-radius: 15px;}
.center {
  display: block;
  margin: auto;
}
</style>

@if (!empty($alldata))
<div class="test_faq">


		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 test_faq_col">

						<!-- Accordions -->
						 <div id="accordion" role="tablist">
						  <!--<h2>Categories</h2>-->

@foreach ($alldata as $key => $data)
  <div class="card">
    <div class="card-header" role="tab" id="heading{{$key}}">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapse{{$key}}" aria-expanded="{{((!empty($subcategory) and ($subcategory->parent()->first()->id == $data->id)))? 'true':'false'}}" aria-controls="collapse{{$key}}">
          {{$data->title}}
        </a>
      </h5>
    </div>

		@if (!empty($data->children()))
    <div id="collapse{{$key}}" class="collapse {{((!empty($subcategory) and ($subcategory->parent()->first()->id == $data->id)))? 'show':''}}" role="tabpanel" aria-labelledby="heading{{$key}}" data-parent="#accordion">
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
<br>

<!--                  end card-->

            </div>

<!--            -->
         </div>

<!--     descrip img              -->
@if (!empty($subcategory))
                     <div class="col-sm-7">
				 
@if (!empty($subcategory->product))
                              <!--<figure class="snip1445">-->
							  <figure class="snip1445">

<!--<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">-->
<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
	<?php $keys = array(); ?>
	@foreach ($subcategory->product as $p_key => $product)
	@if(!empty($product->image))
	@foreach ($product->image as $img_key => $image)
		<?php $keys[] = $p_key.$img_key; ?>
        <div class="carousel-item {{ ($p_key == 0 and $img_key == 0)? 'active':'' }}">
            <img id="{{'img'.$p_key.$img_key}}" src="{{url('uploads/services/'.$image->media_name)}}" class="center d-block one {{$img_key}}">
			<a href="{{url('product_details/'.$product->id)}}"><figcaption><div><h4 style="background-color:#fff;">{{$product->title}}</h4></div></figcaption></a>
        </div>
	@endforeach
	@endif
	@endforeach
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <!--<a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>-->
</div>
<!--</div>
</div>
</div>-->

                              <!--<figcaption>
                            <div>
                              <h4>AAA</h4>
                            </div>
                          </figcaption>
                          <a href="#"></a>-->
                        </figure>
@endif
						
                        <div class="features_item_content">
							<div class="features_item_title"><a href="{{url('product/'.$subcategory->id)}}">{{$subcategory->title}}</a></div>
							<div class="features_item_text">
								<p>{{$subcategory->description}}</p>
                        </div>
                     </div>
<br>
<br>

                    <div class="row">

        @if ($subcategory->parent()->first()->form)
			<a href="{{url('form/'.$subcategory->parent()->first()->form)}}" class="btn btn-primary" style="float:right;">
               Send Inquiry
            </a>
		@endif

    </div>


<!--           product          -->
				@if (!empty($subcategory->product()))
					<?php $keys_2 = array(); ?>
          <div class="product ">
            <div class="row product_row">
     <!--    Info Item                  -->
		 					@foreach ($subcategory->product as $key_2 => $service)
							<?php $keys_2[] = $key_2; ?>
                    <div class="col-lg-4 product_col">
                        <div class="info_item text-center">
                            <figure class="snip1477">
                  <img id="{{'key2'.$key_2}}" src="{{url('uploads/services/'.$service->image()->first()->media_name)}}" alt="sample38" class="center" />
                  <div class="title">
                    <div>
                      <h4>{{$service->title}}</h4>
                    </div>
                  </div>
                  <figcaption>

                  </figcaption>
              <a href="{{url('product_details/'.$service->id)}}"></a>
            </figure>
			<!--<p>{{(strlen(strip_tags($service->brief)) > 75)? substr(strip_tags($service->brief),0,strpos(strip_tags($service->brief),' ',70)):strip_tags($service->brief)}}</p>-->
			<p><?php echo htmlspecialchars_decode(stripslashes($service->brief)); ?></p>
                        </div>
                    </div>
							@endforeach

        </div>
    </div>
		@endif
</div>
<div class="col-sm-2">
<div class="about-history-content bero">
@if(!empty($subcategory->catdoc))
	<br>
	<br>
	<h4>Documents</h4>
	<ul>
	@foreach($subcategory->catdoc as $catdoc)
		<li style="padding:5px;">
		<a href="#" data-toggle="modal" data-target="#show-{{$catdoc->id}}"><i class="fa fa-file-pdf-o"></i> {{$catdoc->title}} </a>
								<div id="show-{{$catdoc->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											{{$catdoc->title}}
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<div class="embed-responsive embed-responsive-4by3">
												<iframe src="{{url('uploads/documents/'.$catdoc->document_name)}}" class="embed-responsive-item" frameborder="0"></iframe>
											</div>
										</center>
										</div>
									</div>
								</div>
								</div>
								</li>
	@endforeach
	</ul>
	<hr>
@endif
</div>
</div>
@endif

<!--                     end				-->


   </div>


         </div>

      </div>
@endif

<script>
	@if(!empty($keys))
		@foreach ($keys as $my_key)
			var width = document.getElementById('img{{$my_key}}').width;
			var height = document.getElementById('img{{$my_key}}').height;
			if((height/width) >= (352/285))
			{
				document.getElementById('img{{$my_key}}').classList.add('img_h');
			}
			else if((height/width) < (352/285))
			{
				document.getElementById('img{{$my_key}}').classList.add('img_w');
			}
		@endforeach
	@endif
	
	@if(!empty($keys_2))
		@foreach ($keys_2 as $my_key_2)
			var width = document.getElementById('key2{{$my_key_2}}').width;
			var height = document.getElementById('key2{{$my_key_2}}').height;
			if((height/width) >= (239/215))
			{
				document.getElementById('key2{{$my_key_2}}').classList.add('img_h');
			}
			else if((height/width) < (239/215))
			{
				document.getElementById('key2{{$my_key_2}}').classList.add('img_w');
			}
		@endforeach
	@endif
</script>

@endsection
