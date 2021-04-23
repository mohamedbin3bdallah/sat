@extends('admin.layouts.app')

@section('content')

<title>Solutions</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Solutions</h2>
  <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/services/solutions')}}">Solutions</a></li>
  </ul>

<button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Solutions</button><br /><br />

   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Solution</h4>
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
		
		<!--<ul class="ul-warning">
			<li class="li-warning">
					Image Dimension:  width=432,height=349
			</li>
		</ul>-->

      {!! Form::open(['url' => 'admin/services/solutions/add', 'files' => true]) !!}
		{!! Form::hidden('service', 2) !!}
		<div class="form-group">
			{{ Form::label('Category:', null, ['for' => 'category']) }}
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
        {{ Form::label('Brief:', null, ['for' => 'brief']) }}
        {!! Form::textarea('brief', old('brief'), ['class' => 'form-control']) !!}
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
        <th>Name</th>
		<th>Brief</th>
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
		  <td><?php echo htmlspecialchars_decode(stripslashes($data->brief)); ?></td>
          <td>{{implode(' , ',array_unique($data->cats))}}</td>
          <td><a href="{{url('admin/servicedetails/solution/'.str_replace(' ','_',$data->title))}}"><button type="button" class="btn btn-default" ><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
		  <td><a class="btn btn-default" href="{{url('admin/services/solutions/delete/'.str_replace(' ','_',$data->title))}}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @endif
  </div>
  
  <script src="{{asset('resources/assets/tinymce/tinymce.min.js')}}"></script>
	<!--<script>tinymce.init({ selector:'textarea' });</script>-->
	<script>
		tinymce.init({
			selector: 'textarea',
			height: 99,
			menubar: false,
			plugins: [
				'advlist autolink lists link image charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code'
			],
			toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
			content_css: '//www.tinymce.com/css/codepen.min.css'
		});
	</script>

@endsection
