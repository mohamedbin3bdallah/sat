@extends('web.layouts.app')

@section('content')

<title>Product</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product-responsive.css')}}">

@if (!empty($alldata))
<div class="test_faq">


		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-5 test_faq_col">

						<!-- Accordions -->
						 <div id="accordion" role="tablist">
						  <h2>Categories</h2>

@foreach ($alldata as $key => $data)
  <div class="card">
    <div class="card-header" role="tab" id="heading{{$key}}">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapse{{$key}}" aria-expanded="{{(!isset($subcategory) or (!empty($subcategory) and ($subcategory->parent()->first()->id == $data->id)))? 'true':'false'}}" aria-controls="collapse{{$key}}">
          {{$data->title}}
        </a>
      </h5>
    </div>

		@if (!empty($data->children()))
    <div id="collapse{{$key}}" class="collapse {{(!isset($subcategory) or (!empty($subcategory) and ($subcategory->parent()->first()->id == $data->id)))? 'show':''}}" role="tabpanel" aria-labelledby="heading{{$key}}" data-parent="#accordion">
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
	
	<div class="card">
    <div class="card-header" role="tab" id="heading_ser">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapse_ser" aria-expanded="{{(!isset($subcategory) or (!empty($subcategory) and ($subcategory->parent()->first()->id == $solution->id)))? 'true':'false'}}" aria-controls="collapse_ser">
          {{$solution->title}}
        </a>
      </h5>
    </div>

		@if (!empty($solution->children))
    <div id="collapse_ser" class="collapse {{(!isset($subcategory) or (!empty($subcategory) and ($subcategory->parent()->first()->id == $solution->id)))? 'show':''}}" role="tabpanel" aria-labelledby="heading_ser" data-parent="#accordion">
      <div class="card-body">
				@foreach ($solution->children as $child)
      		<a href="{{url('solution/'.$child->id)}}">{{$child->title}}</a>
          <br>
          <!--<em class="mdn-tagline">Painter (1881–1973)</em>
        	<br>-->
				@endforeach
      </div>
    </div>
		@endif

  </div>

<!--                  end card-->

            </div>

<!--            -->
         </div>

<!--     descrip img              -->
@if (!empty($subcategory))
                     <div class="col-sm-7">
                              <figure class="snip1445">
                              <img src="{{url('uploads/categories/'.$alldata[0]->children()->first()->image)}}" alt="sample84" />
                              <figcaption>
                            <div>
                              <h4>{{$subcategory->title}}</h4>
                            </div>
                          </figcaption>
                          <a href="#"></a>
                        </figure>
                        <div class="features_item_content">
							<div class="features_item_title"><a href="#">{{$subcategory->title}}</a></div>
							<div class="features_item_text">
								<p>{{$subcategory->description}}</p>
                        </div>
                     </div>

<div>
@if(!empty($subcategory->catdoc))
	<ul>
	@foreach($subcategory->catdoc as $catdoc)
		<li style="padding:5px;">
		<a href="#" data-toggle="modal" data-target="#show-{{$catdoc->id}}"><i class="fa fa-file-pdf-o"></i> {{$catdoc->document_name}} </a>
								<div id="show-{{$catdoc->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											{{$catdoc->document_name}}
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
@endif
</div>

                    <div class="row">

        @if ($subcategory->parent()->first()->form)
			<a href="{{url('form/'.$subcategory->parent()->first()->form)}}" class="btn btn-primary" style="float:right;">
               Send Inquiry
            </a>
		@endif

    </div>


<!--           product          -->
				@if (!empty($subcategory->product()))
          <div class="product ">
            <div class="row product_row">
     <!--    Info Item                  -->
		 					@foreach ($subcategory->product as $service)
                    <div class="col-lg-4 product_col">
                        <div class="info_item text-center">
                            <figure class="snip1477">
                  <img src="{{url('uploads/products/'.$service->image()->first()->media_name)}}" alt="sample38" />
                  <div class="title">
                    <div>
                      <h4>{{$service->title}}</h4>
                    </div>
                  </div>
                  <figcaption>

                  </figcaption>
              <a href="{{url('product_details/'.$service->id)}}"></a>
            </figure>
                        </div>
                    </div>
							@endforeach

        </div>
    </div>
		@endif
</div>
@elseif ($alldata->first()->children)
<div class="col-sm-7">
				 <figure class="snip1445">
				 <img src="{{url('uploads/categories/'.$alldata[0]->children()->first()->image)}}" alt="sample84" />
				 <figcaption>
			 <div>
				 <h4>{{$alldata->first()->children()->first()->title}}</h4>
			 </div>
		 </figcaption>
		 <a href="#"></a>
	 </figure>
	 <div class="features_item_content">
<div class="features_item_title"><a href="#">{{$alldata->first()->children()->first()->title}}</a></div>
<div class="features_item_text">
<p>{{$alldata->first()->children()->first()->description}}</p>
	 </div>
</div>

<div class="row">

@if ($alldata->first()->children()->first()->parent()->first()->form)
<a href="{{url('form/'.$alldata->first()->children()->first()->parent()->first()->form)}}" class="btn btn-primary" style="float:right;">
Send Inquiry
</a>
@endif

</div>


<!--           product          -->
@if (!empty($alldata->first()->children()->first()->product()))
<div class="product ">
<div class="row product_row">
<!--    Info Item                  -->
@foreach ($alldata->first()->children()->first()->product as $service)
<div class="col-lg-4 product_col">
	 <div class="info_item text-center">
			 <figure class="snip1477">
<img src="{{url('uploads/products/'.$service->image()->first()->media_name)}}" alt="sample38" />
<div class="title">
<div>
 <h4>{{$service->title}}</h4>
</div>
</div>
<figcaption>

</figcaption>
<a href="{{url('product_details/'.$service->id)}}"></a>
</figure>
	 </div>
</div>
@endforeach

</div>
</div>
@endif

</div>
@endif


<!--                     end				-->


   </div>


         </div>

      </div>
@endif

@endsection
