@extends('admin.layouts.app')

@section('content')

<title>News</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;News</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/news')}}">News</a></li>
  </ul>

  <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button><br /><br />

   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New</h4>
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
					Image Dimension:  width=750,height=360
			</li>
		</ul>-->

      {!! Form::open(['url' => 'admin/news/add', 'files' => true]) !!}
		  <div class="form-group">
        {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image', $attributes = array()) }}
		  </div>
		  <div class="form-group">
        {{ Form::label('Description:', null, ['for' => 'description']) }}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('File:', null, ['for' => 'file']) }}
        {{ Form::file('file', $attributes = array()) }}
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

@if(!empty($alldata))
  <table class="table table-bordered" id="example">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
		<th>Image</th>
		<th>News</th>
		<th>File</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($alldata as $key => $data)
      <tr>
        <td>{{$key+1}}</td>
		    <td style="width:20%;">{{$data->title}}</td>
		    <td><img src="{{url('./uploads/news/'.$data->image)}}" width="80px" ></td>
			<td style="text-align:justify;width:50%;"><p><?php echo htmlspecialchars_decode(stripslashes($data->description)); ?></p></td>
			<td>
			@if ($data->pdf)
				<a href="#" data-toggle="modal" data-target="#show-{{$data->id}}">{{$data->pdf}}</a>
           <div id="show-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											{{$data->pdf}}
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<div class="embed-responsive embed-responsive-4by3">
												<iframe src="{{url('uploads/news/'.$data->pdf)}}" class="embed-responsive-item" frameborder="0"></iframe>
											</div>
										</center>
										</div>
									</div>
								</div>
							</div>
			@endif
			</td>
		    <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
			<td><a class="btn btn-default" href="{{url('admin/news/delete/'.$data->id)}}"><span class="glyphicon glyphicon-remove"></span></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

       <!-- Modal -->
  @foreach ($alldata as $data)
  <div class="modal fade" id="myModal{{$data->id}}" role="dialog">
    <div class="modal-dialog modal-lg">

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
		
		<!--<ul class="ul-warning">
			<li class="li-warning">
					Image Dimension:  width=750,height=360
			</li>
		</ul>-->

      {!! Form::open(['url' => 'admin/news/edit/'.$data->id, 'files' => true]) !!}
      {!! Form::hidden('oldimg', $data->image) !!}
	  {!! Form::hidden('oldpdf', $data->pdf) !!}
		  <div class="form-group">
        {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', $data->title, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image', $attributes = array()) }}
		  </div>
		  <div class="form-group">
        {{ Form::label('Description:', null, ['for' => 'description']) }}
        {!! Form::textarea('description', $data->description, ['class' => 'form-control']) !!}
		  </div>
		  <div class="form-group">
        {{ Form::label('File:', null, ['for' => 'file']) }}
        {{ Form::file('file', $attributes = array()) }}
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
