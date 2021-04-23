@extends('admin.layouts.app')

@section('content')

<title>Admin Account</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif


<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Admin Account</h2>
  <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/admins')}}">Admins</a></li>
  </ul>
  
@if (!empty($data))
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
		<th>Phone</th>
		<th>Role</th>
		<th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$data->id}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->email}}</td>
		    <td>{{$data->phone}}</td>
		    <td>{{$data->role}}</td>
			<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span></button></td>
      </tr>
    </tbody>
  </table>
  
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Customer Company</h4>
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
		
      {!! Form::open(['url' => 'admin/admins/edit/'.$data->id]) !!}
		<div class="form-group">
          {{ Form::label('Name:', null, ['for' => 'name']) }}
          {!! Form::text('name', $data->name, ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
          {{ Form::label('Email:', null, ['for' => 'email']) }}
          {!! Form::email('email', $data->email, ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
          {{ Form::label('Phone:', null, ['for' => 'phone']) }}
          {!! Form::text('phone', $data->phone, ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
          {{ Form::label('Password:', null, ['for' => 'password']) }}
          {!! Form::text('password', '', ['class' => 'form-control']) !!}
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
  
@endif
</div>

@endsection
