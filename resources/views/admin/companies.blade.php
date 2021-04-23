@extends('admin.layouts.app')

@section('content')

<title>Companies</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Companies</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/companies')}}">Companies</a></li>
  </ul>

    <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button><br /><br />
     <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Company</h4>
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
		
      {!! Form::open(['url' => 'admin/companies/add']) !!}
		    <div class="form-group">
          {{ Form::label('Code:', null, ['for' => 'code']) }}
          {!! Form::text('code', old('code'), ['class' => 'form-control']) !!}
		    </div>
		    <div class="form-group">
          {{ Form::label('Name:', null, ['for' => 'name']) }}
          {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
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
        <th>Code</th>
        <th>Name</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$data->code}}</td>
          <td>{{$data->name}}</td>
          <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
		  <td><a class="btn btn-default" href="{{url('admin/companies/delete/'.$data->id)}}"><span class="glyphicon glyphicon-remove"></span></a></td>
		  
        </tr>
      @endforeach
    </tbody>
  </table>
	@endif
  </div>


	      <!-- Modal -->
  @foreach ($alldata as $data)
  <div class="modal fade" id="myModal{{$data->id}}" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Company</h4>
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
		
      <!--<form action="companies/edit/{{$data->id}}">-->
      {!! Form::open(['url' => 'admin/companies/edit/'.$data->id]) !!}
		    <div class="form-group">
			       {{ Form::label('Code:', null, ['for' => 'code']) }}
           {!! Form::text('code', $data->code, ['class' => 'form-control']) !!}
		    </div>
		    <div class="form-group">
             {{ Form::label('Name:', null, ['for' => 'name']) }}
             {!! Form::text('name', $data->name, ['class' => 'form-control']) !!}
		    </div>
		    <!--<button type="submit" class="btn btn-default">Save</button>-->
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

@endsection