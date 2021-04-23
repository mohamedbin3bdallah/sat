@extends('admin.layouts.app')

@section('content')

<script type="text/javascript">
function get_children(id)
{
	$.ajax({
		type:'GET',
		//data:dataString,
		data: {
		'id': id,
		},
    //dataType: 'JSON',
		url:'../../services/children/'+id,
		success: function (response) {
		     //document.getElementById("category").innerHTML = response;
         $('#category').html(response);
         //$('#category').hide();
         //console.log(response);alert(response);
        //$('#category').html(data.options);
		}
	});
}
</script>

<title>Solution Details</title>
<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Solution Details</h2>
  <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/solutiondetails/solution/'.$alldata->id)}}">Solution Details</a></li>
  </ul>

  @if ($errors->any())
      <ul class="ul-danger">
          @foreach ($errors->all() as $error)
  						<li class="li-danger">
  							{{$error}}
  					  </li>
  		     @endforeach
      </ul>
  @endif

<br />
@if(!empty($alldata))
  <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Image</button>
  <button type="button" class="btn btn-info" style="float:right;margin-right:1%;" data-toggle="modal" data-target="#myModal5"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Image</button><br /><br />
  <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal4"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Solution Data</button><br /><br />

<br />
 <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
<!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Image</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['url' => 'admin/servicedetails/upload', 'files' => true]) !!}
        {!! Form::hidden('id', $alldata->id) !!}
        {!! Form::hidden('service', $alldata->flag) !!}
		      <div class="form-group">
            {{ Form::label('Image:', null, ['for' => 'image']) }}
            {{ Form::file('image', $attributes = array()) }}
		      </div>
        {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
        {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Solution</h4>
        </div>
        <div class="modal-body">
      {!! Form::open(['url' => 'admin/services/solutions/edit']) !!}
		{!! Form::hidden('id', $alldata->id) !!}
		{!! Form::hidden('service', $alldata->flag) !!}
		  <div class="form-group">
        {{ Form::label('Category:', null, ['for' => 'category']) }}
        <select class="form-control" name="parent" onchange="get_children(value);">
          <option value="">Choose</option>
          @foreach ($categories as $category)
            @if($category->parent == NULL)
             <option value="{{$category->id}}" {{ ($category->id == $alldata->category->parent()->first()->id)? "selected":"" }}>{{$category->title}}</option>
            @endif
          @endforeach
        </select>
		  </div>
		  <div class="form-group">
        {{ Form::label('SubCategory:', null, ['for' => 'category']) }}
        <select class="form-control" id="category" name="category">
          <option value="">Choose</option>
          @foreach ($categories as $category)
            @if($category->parent == $alldata->category()->first()->parent)
             <option value="{{$category->id}}" {{ ($category->id == $alldata->category()->first()->id)? "selected":"" }}>{{$category->title}}</option>
            @endif
          @endforeach
        </select>
		  </div>
      <!--<div class="form-group">
        {{ Form::label('Service:', null, ['for' => 'service']) }}
        <select class="form-control" name="service">
          <option value="">Choose</option>
            <option value="1" {{($alldata->flag==1)? 'selected':''}}>Products</option>
            <option value="2" {{($alldata->flag==2)? 'selected':''}}>Solutions</option>
        </select>
		  </div>-->
		  <div class="form-group">
        {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', $alldata->title, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('Description:', null, ['for' => 'description']) }}
        {!! Form::textarea('description', $alldata->description, ['class' => 'form-control']) !!}
		  </div>
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


   <!-- Modal -->
  <div class="modal fade" id="myModal5" role="dialog">
    <div class="modal-dialog">
<!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Image</h4>
        </div>
        <div class="modal-body">
      @foreach ($alldata->image as $image)
      {!! Form::open(['url' => 'admin/servicedetails/image_edit', 'files' => true]) !!}
      {!! Form::hidden('id', $alldata->id) !!}
      {!! Form::hidden('service', 'solution') !!}
      {!! Form::hidden('oldimg', $image->media_name) !!}
      {!! Form::hidden('imgid', $image->id) !!}
		  <div class="form-group">
		  <div class="row">
		   <div class="col-sm-4">
		   <center>
		   <img src="{{url('uploads/solutions/'.$image->media_name)}}" alt="Los Angeles" width="100px">
       <a href="../image_delete/solution/{{$image->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
		   <!--<button type="button" class="btn btn-danger">
          <span class="glyphicon glyphicon-remove"></span>
        </button>-->
		</center>
		</div>
		<div class="col-sm-5">
      {{ Form::label('Image:', null, ['for' => 'image']) }}
      <input type="file" name="image">
		  </div>
		  <div class="col-sm-3" style="padding-top:15px;">
			{!! Form::submit('Upload', ['class' => 'btn btn-default']) !!}
		  </div>
		  </div>
		  </div>
		  <hr />
      {!! Form::close() !!}
      @endforeach
        </div>
      </div>
</div>
  </div>

@if (!empty($alldata->image()))
<div class="row">
  <div class="col-sm-3">
   <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
		@foreach ($alldata->image as $key => $image)
			<li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{ ($key == 0)? 'active':''}}"></li>
		@endforeach
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach ($alldata->image as $key => $image)
          <div class="item {{ ($key == 0)? 'active':''}}">
            <img src="{{url('uploads/solutions/'.$image->media_name)}}" alt="Los Angeles" style="width:100%;">
          </div>
        @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  <div class="col-sm-4">
  <p>Name: {{$alldata->title}}</p>
  <p style="text-align:justify;">{{$alldata->description}}.</p>

  </div>
</div>
@endif

<hr />
<div class="row">
<div class="col-sm-8">

<button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Document</button><br /><br />

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
<!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Document</h4>
        </div>
        <div class="modal-body">
      {!! Form::open(['url' => 'admin/documents/add', 'files' => true]) !!}
      {!! Form::hidden('service', $alldata->id) !!}
      {!! Form::hidden('service_type', 'solution') !!}
		  <div class="form-group">
        {{ Form::label('Document Type:', null, ['for' => 'doctype']) }}
        <select class="form-control" name="doctype">
          @foreach ($doctypes as $doctype)
             <option value="{{$doctype->id}}">{{$doctype->type_name}}</option>
          @endforeach
        </select>
		  </div>
		  <div class="form-group">
      {{ Form::label('File:', null, ['for' => 'file']) }}
  		{{ Form::file('file', $attributes = array()) }}
  		 </div>
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>
  </div>

@if (!empty($alldata->document()))
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Document</th>
        <th>Type</th>
		<th>Settings</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata->document as $key => $document)
      <tr>
        <td>{{$document->id}}</td>
        <td>
          <a href="#" data-toggle="modal" data-target="#show-{{$document->id}}">{{$document->document_name}}</a>
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
        </td>
        <td>{{$document->doctype()->first()->type_name}}</td>
		<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$document->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif

   <!-- Modal -->
@foreach ($alldata->document as $key => $document)
  <div class="modal fade" id="myModal{{$document->id}}" role="dialog">
    <div class="modal-dialog">
<!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Document</h4>
        </div>
        <div class="modal-body">
      {!! Form::open(['url' => 'admin/documents/edit/'.$document->id, 'files' => true]) !!}
      {!! Form::hidden('service', $alldata->id) !!}
      {!! Form::hidden('service_type', 'solution') !!}
      {!! Form::hidden('oldfile', $document->document_name) !!}
		  <div class="form-group">
        {{ Form::label('Document Type:', null, ['for' => 'doctype']) }}
  			<select class="form-control" name="doctype">
          @foreach ($doctypes as $doctype)
  			     <option value="{{$doctype->id}}" {{ ($doctype->id == $document->document_type_id)? "selected":"" }}>{{$doctype->type_name}}</option>
          @endforeach
  			</select>
		  </div>
		  <div class="form-group">
			{{ Form::label('File:', null, ['for' => 'file']) }}
			{{ Form::file('file', $attributes = array()) }}
		  </div>
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>
  </div>
@endforeach

</div>
  </div>
  @endif
  </div>

@endsection
