@extends('admin.layouts.app')

@section('content')

<title>Categories</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Categories</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/categories')}}">Categories</a></li>
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
		
      {!! Form::open(['url' => 'admin/categories/add', 'files' => true]) !!}
		    <div class="form-group">
          {{ Form::label('Title:', null, ['for' => 'title']) }}
          {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
          {{ Form::label('Type:', null, ['for' => 'type']) }}
			<select name="type" class="form-control">
				<option value="0">Product</option>
				<option value="1">Solution</option>
			</select>
			</div>
			<div class="form-group">
          {{ Form::label('Form:', null, ['for' => 'form']) }}
			<select name="form" class="form-control">
				<option value="0">Choose</option>
				<option value="filters">Filters</option>
				<option value="filterspress">Filters Press</option>
				<option value="galvanizing">Galvanizing</option>
				<option value="pump">Pump</option>
				<option value="watertreatment">Watertreatment</option>
			</select>
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
		<th>Form</th>
		<th>Type</th>
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
		  <td>{{$data->form}}</td>
		  <td>{{($data->type)? 'Solution':'Product'}}</td>
		  <!--<td>@if($key!=0)<a href="{{url('admin/categories/reorder/'.$alldata[$key-1]->id.':'.$data->order.'_'.$data->id.':'.$alldata[$key-1]->order)}}"><span class="glyphicon glyphicon-arrow-up"></span></a>@endif @if($key!=count($alldata)-1)<a href="{{url('admin/categories/reorder/'.$alldata[$key+1]->id.':'.$data->order.'_'.$data->id.':'.$alldata[$key+1]->order)}}"><span class="glyphicon glyphicon-arrow-down"></span></a>@endif</td>-->
		  <td>@if($data->order!=1)<a href="{{url('admin/categories/reorder/'.$data->order.'_'.$pre)}}"><span class="glyphicon glyphicon-arrow-up"></span></a>@endif @if($data->order!=$max)<a href="{{url('admin/categories/reorder/'.$data->order.'_'.$nxt)}}"><span class="glyphicon glyphicon-arrow-down"></span></a>@endif</td>
          <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
		  <td><a class="btn btn-default" href="{{url('admin/categories/delete/'.$data->id)}}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
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
		
		@if ($errors->any() and session('modal') == 'myModal'.$data->id)
			<ul class="ul-danger">
				@foreach ($errors->all() as $error)
					<li class="li-danger">
						{{$error}}
					</li>
				@endforeach
			</ul>
		@endif
		
		@if (session('success') and session('modal') == 'myModal'.$data->id)
			<ul class="ul-success">
					<li class="li-success">
						{{session('success')}}
					</li>
			</ul>
		@endif
		
      {!! Form::open(['url' => 'admin/categories/edit/'.$data->id, 'files' => true]) !!}
		{!! Form::hidden('type', $data->type) !!}
        <div class="form-group">
          {{ Form::label('Title:', null, ['for' => 'title']) }}
          {!! Form::text('title', $data->title, ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
			{{ Form::label('Type:', null, ['for' => 'type']) }}
				{{($data->type)? 'Solution':'Product'}}
			</div>
			<div class="form-group">
          {{ Form::label('Form:', null, ['for' => 'form']) }}
			<select name="form" class="form-control">
				<option>Choose</option>
				<option value="filters" {{($data->form == 'filters')? 'selected':''}}>Filters</option>
				<option value="filterspress" {{($data->form == 'filterspress')? 'selected':''}}>Filters Press</option>
				<option value="galvanizing" {{($data->form == 'galvanizing')? 'selected':''}}>Galvanizing</option>
				<option value="pump" {{($data->form == 'pump')? 'selected':''}}>Pump</option>
				<option value="watertreatment" {{($data->form == 'watertreatment')? 'selected':''}}>Watertreatment</option>
			</select>
		    </div >
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