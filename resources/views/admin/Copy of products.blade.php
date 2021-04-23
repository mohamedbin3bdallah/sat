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
		url:'children/'+id,
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

<title>Products</title>
<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Products</h2>
  <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/services/products')}}">Products</a></li>
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

<button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Products</button><br /><br />

   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add product</h4>
        </div>
        <div class="modal-body">
      {!! Form::open(['url' => 'admin/services/products/add', 'files' => true]) !!}
		{!! Form::hidden('service', 1) !!}
		  <div class="form-group">
        {{ Form::label('Category:', null, ['for' => 'parent']) }}
        <select class="form-control" name="parent" onchange="get_children(value);">
          <option value="">Choose</option>
          @foreach ($parents as $parent)
            <option value="{{$parent->id}}">{{$parent->title}}</option>
           @endforeach
        </select>
		  </div>
      <div class="form-group">
        {{ Form::label('SubCategory:', null, ['for' => 'category']) }}
        <select class="form-control" id="category" name="category">
        </select>
		  </div>
		  <div class="form-group">
        {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('Description:', null, ['for' => 'description']) }}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
		  </div>
      <!--<div class="form-group">
        {{ Form::label('Service:', null, ['for' => 'service']) }}
        <select class="form-control" name="service">
          <option value="">Choose</option>
            <option value="1">Products</option>
            <option value="2">Solutions</option>
        </select>
		  </div>-->
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        <input type="file" name="image[]" multiple>
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

@if (!empty($alldata))
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
		<th>Settings</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $data)
        <tr>
          <td>{{$data->id}}</td>
          <td>{{$data->title}}</td>
          <td>{{ $data->category()->first()->title }}</td>
          <td><a href="{{url('admin/servicedetails/product/'.$data->id)}}"><button type="button" class="btn btn-default" ><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!! $alldata->render() !!}
  @endif
  </div>

@endsection
