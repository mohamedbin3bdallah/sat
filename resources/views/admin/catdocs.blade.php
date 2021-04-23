@extends('admin.layouts.app')

@section('content')

<title>Category Documents</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Category Documents</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/catdocs')}}">Category Documents</a></li>
  </ul>

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
		
		@if ($errors->any() and session('modal') == 'myModal')
			<ul class="ul-danger">
				@foreach ($errors->all() as $error)
					<li class="li-danger">
						{{$error}}
					</li>
				@endforeach
			</ul>
		@endif
		
		@if (session('success') and session('modal') == 'myModal')
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
		
      {!! Form::open(['url' => 'admin/catdocs/add', 'files' => true]) !!}
		<div class="form-group">
		{{ Form::label('Categpry:', null, ['for' => 'category']) }}
			<div class="row">
			<!--<iframe allowfullscreen>-->
				@foreach ($categories as $category)
					<div class="col-xs-6"><input type="checkbox" name="category[]" value="{{$category->title}}" /> {{$category->title}}</div>
				@endforeach
			<!--</iframe>-->
			</div>
        </div>
		<div class="form-group">
        {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
		  </div>
		<div class="form-group">
			{{ Form::label('Files:', null, ['for' => 'file']) }}
			<input type="file" name="file[]" multiple>
		  </div>
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>

    </div>
  </div>

	@if (session('del_success'))
		<ul class="ul-success">
				<li class="li-success">
					{{session('del_success')}}
				</li>
		</ul>
	@endif
	@if (session('del_fail'))
		<ul class="ul-danger">
				<li class="li-danger">
					{{session('del_fail')}}
				</li>
		</ul>
	@endif

  @if (!empty($alldata))
  <table class="table table-bordered" id="example">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
		<th>Category</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$data->title}}</td>
		  <td>{{implode(' , ',array_unique($data->cats))}}</td>
          <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{str_replace(' ','_',$data->title)}}"><span class="glyphicon glyphicon-edit"></span></button></td>
		  <td><a class="btn btn-default" href="{{url('admin/catdocs/delete/'.str_replace(' ','_',$data->title))}}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @endif


       <!-- Modal -->
@foreach ($alldata as $key => $data)
  <div class="modal fade" id="myModal{{str_replace(' ','_',$data->title)}}" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit item</h4>
        </div>
        <div class="modal-body">
      
		@if ($errors->any() and session('modal') == 'myModal'.str_replace(' ','_',$data->title))
			<ul class="ul-danger">
				@foreach ($errors->all() as $error)
					<li class="li-danger">
						{{$error}}
					</li>
				@endforeach
			</ul>
		@endif
		
		@if (session('success') and session('modal') == 'myModal'.str_replace('.','_',$data->title))
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
	  
	  {!! Form::open(['url' => 'admin/catdocs/edit/'.str_replace(' ','_',$data->title), 'files' => true]) !!}
	  {!! Form::hidden('file', $data->document_name) !!}
		<div class="form-group">
		{{ Form::label('Categpry:', null, ['for' => 'category']) }}
			<div class="row">
			<!--<iframe allowfullscreen>-->
				@foreach ($categories as $category)
					<div class="col-xs-6"><input type="checkbox" name="category[]" value="{{$category->title}}" {{(in_array($category->title,$data->cats))? "checked":"" }} /> {{$category->title}}</div>
				@endforeach
			<!--</iframe>-->
			</div>
        </div>
		<div class="form-group">
        {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', $data->title, ['class' => 'form-control']) !!}
		  </div>
        {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>

    </div>
  </div>
  @endforeach
  </div>

@endsection
