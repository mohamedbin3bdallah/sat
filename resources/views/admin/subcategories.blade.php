@extends('admin.layouts.app')

@section('content')

<title>SubCategories</title>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;SubCategories</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/subcategories')}}">SubCategories</a></li>
  </ul>
@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
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
		
      {!! Form::open(['url' => 'admin/subcategories/add', 'files' => true]) !!}
		<div class="form-group">
		{{ Form::label('Category:', null, ['for' => 'parent']) }}
			<div class="row">
			<!--<iframe allowfullscreen>-->
				@foreach ($parents as $parent)
					<div class="col-xs-6"><input type="checkbox" name="parent[]" value="{{$parent->id}}" /> {{$parent->title}}</div>
				@endforeach
			<!--</iframe>-->
			</div>
        </div>
		    <div class="form-group">
          {{ Form::label('Title:', null, ['for' => 'title']) }}
          {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
		    </div>
		    <div class="form-group">
          {{ Form::label('Description:', null, ['for' => 'description']) }}
          {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
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
		<th>Description</th>
		<th>Order</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
        <tr>
			<?php $pre=$data->order-1; ?>
			<?php $nxt=$data->order+1; ?>
          <td>{{$key+1}}</td>
          <td>{{$data->title}}</td>
		  <td>{{$data->description}}</td>
		  <td>@if($data->order!=1)<a href="{{url('admin/subcategories/reorder_title/'.$data->order.'_'.$pre)}}"><span class="glyphicon glyphicon-arrow-up"></span></a>@endif @if($data->order!=$max)<a href="{{url('admin/subcategories/reorder_title/'.$data->order.'_'.$nxt)}}"><span class="glyphicon glyphicon-arrow-down"></span></a>@endif</td>
          <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{str_replace(' ','_',$data->title)}}"><span class="glyphicon glyphicon-edit"></span></button></td>
		  <td><a class="btn btn-default" href="{{url('admin/subcategories/delete/'.str_replace(' ','_',$data->title))}}"><span class="glyphicon glyphicon-remove"></span></a></td>
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
		
		@if (session('success') and session('modal') == 'myModal'.str_replace(' ','_',$data->title))
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
	  
	  {!! Form::open(['url' => 'admin/subcategories/edit/'.str_replace(' ','_',$data->title), 'files' => true]) !!}
		{!! Form::hidden('id', $data->id) !!}
		{!! Form::hidden('order', $data->order) !!}
		<div class="form-group">
		{{ Form::label('Category:', null, ['for' => 'parent']) }}
			<div class="row">
			<!--<iframe allowfullscreen>-->
				@foreach ($parents as $parent)
					<div class="col-xs-6"><input type="checkbox" name="parent[]" value="{{$parent->id}}" {{(in_array($parent->id,$data->parents))? "checked":"" }} /> {{$parent->title}}</div>
				@endforeach
			<!--</iframe>-->
			</div>
        </div>
        <div class="form-group">
          {{ Form::label('Title:', null, ['for' => 'title']) }}
          {!! Form::text('title', $data->title, ['class' => 'form-control']) !!}
		    </div>
		    <div class="form-group">
			    {{ Form::label('Description:', null, ['for' => 'description']) }}
          {!! Form::textarea('description', $data->description, ['class' => 'form-control']) !!}
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
