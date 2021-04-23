@extends('web/layouts.app')

@section('content')

<title>Search</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/product-responsive.css')}}">
<style>
.pagination > li > a, .pagination > li > span
{
	position: relative;
	display: block;
	padding: .5rem .75rem;
	margin-left: -1px;
	line-height: 1.25;
	color: #007bff;
	background-color: #fff;
	border: 1px solid #ddd;
}
.pagination > li > a:hover, .pagination > li > span:hover
{
	background-color: #ddd;
}
.active::after
{
	content: '';
}
</style>

<div class="test_faq">
		<div class="container">
		<br />
<nav class="navbar navbar-expand-sm bg-light" style="font-size:25px;">
	Search Keyword: {{($q)? $q:'Nothing'}}
</nav>
		<br />
		@if (!empty($alldata))
			<div class="row">

<!--     descrip img              -->
					@foreach ($alldata as $data)
                     <div class="col-sm-4">
					   <div class="card" style="width:100%">
							@if ($data->flag == 1) <center><img class="card-img-top" src="{{url('uploads/services/'.$data->image)}}"" alt="Card image" style="width:50%"></center>
							@else <center><img class="card-img-top" src="{{url('uploads/services/'.$data->image)}}"" alt="Card image" style="width:50%"></center>
							@endif
							<div class="card bg-primary" style="width:100%">
							<div class="card-body">
							  <h4 class="card-title" style="color:orange;">{{(strlen($data->title) > 25)? substr($data->title,0,strpos($data->title,' ',20)):$data->title}}</h4>
							  <p class="card-text" style="color:white;">{{(strlen(strip_tags($data->brief)) > 75)? substr(strip_tags($data->brief),0,strpos(strip_tags($data->brief),' ',70)):strip_tags($data->brief)}}</p>
							  @if ($data->flag == 1) <a href="{{url('product_details/'.$data->id)}}" class="btn btn-warning" style="color:white;">See Details</a>
							  @else <a href="{{url('solution_details/'.$data->id)}}" class="btn btn-warning" style="color:white;">See Details</a>
							  @endif
							</div>
							</div>
						  </div>
						</div>
						@endforeach
<!--                     end				-->
   </div>

	 <div class="row">
			 <div class="col-lg-6 offset-lg-5 py-5 d-fl">
					{!! $alldata->render() !!}
			 </div>
	 </div>
@endif

  </div>

</div>

@endsection
