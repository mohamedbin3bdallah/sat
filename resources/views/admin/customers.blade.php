@extends('admin.layouts.app')

@section('content')

<title>Customers</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Customers</h2>
  <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/customers')}}">Customers</a></li>
  </ul>

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
  <!--<input class="form-control" id="myInput" type="text" placeholder="Search..">-->
  <br>
  <table class="table table-bordered" id="example">
    <thead>
      <tr>
        <th>ID</th>
		<th>Code</th>
        <th>Name</th>
        <th>Email</th>
		<th>Phone</th>
		<th>Company Name</th>
		<th>Company Code</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody id="myTable">
      @foreach ($alldata as $key => $data)
        <tr>
          <td>{{$key+1}}</td>
		  <td>{{$data->code}}</td>
          <td>{{$data->name}}</td>
          <td>{{$data->email}}</td>
          <td>{{$data->phone}}</td>
          <td>@if ($data->company) {{$data->company()->first()->name}} @else {{$data->company_name}} @endif</td>
          <td>@if ($data->company) {{$data->company()->first()->code}} @endif</td>
          <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
		  <td><a class="btn btn-default" href="{{url('admin/customers/delete/'.$data->id)}}"><span class="glyphicon glyphicon-remove"></span></a></td>
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
          <h4 class="modal-title">Edit Customer Company</h4>
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
		
      {!! Form::open(['url' => 'admin/customers/edit/'.$data->id]) !!}
		<div class="form-group">
          {{ Form::label('Code:', null, ['for' => 'code']) }}
          {!! Form::text('code', $data->code, ['class' => 'form-control']) !!}
		    </div>
		<div class="form-group">
          {{ Form::label('Name:', null, ['for' => 'name']) }}
          {!! Form::text('name', $data->name, ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
          {{ Form::label('Email:', null, ['for' => 'email']) }}
          {!! Form::email('email', $data->email, ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
          {{ Form::label('Password:', null, ['for' => 'password']) }}
          {!! Form::text('password', '', ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
          {{ Form::label('Phone:', null, ['for' => 'phone']) }}
          {!! Form::text('phone', $data->phone, ['class' => 'form-control']) !!}
		    </div>
		  <div class="form-group">
			<label for="email">Company Name:</label>
			<input type="text" name="company_name" value="{{$data->company_name}}" class="form-control">
			<br>
			<select class="form-control" name="company">
				<option value="0">Select</option>
        @foreach ($companies as $company)
			     <option value="{{$company->id}}" {{ ($company->id == $data->company_id)? "selected":"" }}>{{$company->code.' '.$company->name}}</option>
        @endforeach
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
  @endforeach

@endsection
