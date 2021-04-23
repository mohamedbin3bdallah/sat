@extends('admin.layouts.app')

@section('content')

<title>SubCategories</title>
<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;SubCategories</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/subcategories')}}">SubCategories</a></li>
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

  <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button><br /><br />

   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add item</h4>
        </div>
        <div class="modal-body">
      {!! Form::open(['url' => 'admin/subcategories/add', 'files' => true]) !!}
        <div class="form-group">
          {{ Form::label('Parent:', null, ['for' => 'parent']) }}
          <select class="form-control" name="parent[]" multiple>
            @foreach ($parents as $parent)
              <option value="{{$parent->id}}">{{$parent->title}}</option>
             @endforeach
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

  @if (!empty($alldata))
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
		<th>image</th>
		<th>Setting</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $data)
        <tr>
          <td>{{$data->id}}</td>
          <td>{{$data->title}}</td>
          <td>{{$data->description}}</td>
          <td><img src="{{url('uploads/categories/'.$data->image)}}" width="60px"></td>
          <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!! $alldata->render() !!}
  @endif


       <!-- Modal -->
@foreach ($alldata as $data)
  <div class="modal fade" id="myModal{{$data->id}}" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit item</h4>
        </div>
        <div class="modal-body">
      {!! Form::open(['url' => 'admin/subcategories/edit/'.$data->id, 'files' => true]) !!}
      {!! Form::hidden('oldimg', $data->image) !!}
		    <div class="form-group">
          <select class="form-control" name="parent[]" multiple>
            @foreach ($parents as $parent)
    			     <option value="{{$parent->id}}" {{ ($parent->id == $data->parent)? "selected":"" }}>{{$parent->title}}</option>
            @endforeach
    			</select>
		    </div>
        <div class="form-group">
          {{ Form::label('Title:', null, ['for' => 'title']) }}
          {!! Form::text('title', $data->title, ['class' => 'form-control']) !!}
		    </div>
		    <div class="form-group">
			    {{ Form::label('Description:', null, ['for' => 'description']) }}
          {!! Form::textarea('description', $data->description, ['class' => 'form-control']) !!}
		    </div>
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
  @endforeach
  </div>

@endsection
