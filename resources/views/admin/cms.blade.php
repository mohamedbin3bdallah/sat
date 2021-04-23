@extends('admin.layouts.app')

@section('content')

<title>CMS</title>

@if (session('modal'))
<script type="text/javascript">
$(document).ready(function(){
		$('#{{session("modal")}}').modal({show: true, backdrop: 'static', keyboard: false});
});
</script>
@endif

<script type="text/javascript">
$(document).ready(function(){
		$('#section').change(function(){
			var val = $(this).val();
			if(val=='testimon' || val=='slider') $('#image').show();
			else $('#image').hide();
		});
});
</script>

<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;CMS</h2>
   <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
    <li><a href="{{url('admin/cms')}}">CMS</a></li>
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
		
      {!! Form::open(['url' => 'admin/cms/add', 'files' => true]) !!}
		    <div class="form-group">
			{{ Form::label('Section:', null, ['for' => 'section']) }}
			<select class="form-control" name="section" id="section">
				<option value="slider">Slider</option>
				<option value="testimon">Partners</option>
				<option value="accordion">Accordion</option>
				<option value="timeline">Timeline</option>
			</select>
		  </div>
		    <div class="form-group">
          {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
		    </div>
			<div class="form-group">
        {{ Form::label('Content:', null, ['for' => 'content']) }}
        {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
		  </div>
			<div class="form-group" id="image">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image') }}
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


@if(!empty($alldata))
  <table class="table table-bordered" id="example">
    <thead>
      <tr>
        <th>ID</th>
        <th>Page</th>
		<th>Section</th>
		<th>Title</th>
		<th>Content</th>
		<th>Image</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody id="myTable">
      @foreach ($alldata as $key => $data)
      <tr>
			<td>{{$key+1}}</td>
		    <td>@if($data->page_flag==1) {{'Home'}} @elseif($data->page_flag==2) {{'About'}} @elseif($data->page_flag==3) {{'Contact'}} @else {{'All'}} @endif</td>
			<td>{{($data->section=='testimon')? 'partner':$data->section}}</td>
			<td>{{$data->title}}</td>
			<td style="text-align:justify;"><p>{{$data->content}}</p></td>
		    <td>@if($data->image)<img src="{{url('./uploads/'.$data->image)}}" width="80px" >@endif</td>
		    <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$data->id}}"><span class="glyphicon glyphicon-edit"></span></button></td>
			<td>@if(in_array($data->section,array('slider','testimon','timeline','accordion')))<a class="btn btn-default" href="{{url('admin/cms/delete/'.$data->id)}}"><span class="glyphicon glyphicon-remove"></span></a>@endif</td>
      </tr>
      @endforeach
    </tbody>
  </table>

       <!-- Modal -->
  @foreach ($alldata as $data)
  <div class="modal fade" id="myModal{{$data->id}}" role="dialog">
    <div class="modal-dialog">

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

      {!! Form::open(['url' => 'admin/cms/edit/'.$data->id, 'files' => true]) !!}
      {!! Form::hidden('oldimg', $data->image) !!}
	  {!! Form::hidden('oldpdf', $data->pdf) !!}
		  <div class="form-group">
			{{ Form::label('Page:', null, ['for' => 'page']) }}
			<br>
			@if($data->page_flag==1) {{'Home'}} @elseif($data->page_flag==2) {{'About'}} @elseif($data->page_flag==3) {{'Contact'}} @else {{'All'}} @endif
		  </div>
		   <div class="form-group">
			{{ Form::label('Section:', null, ['for' => 'section']) }}
			<br>	
			{{($data->section=='testimon')? 'partner':$data->section}}
		  </div>
		  
		  @if(!in_array($data->section,array('video')))
		  <div class="form-group">
        {{ Form::label('Title:', null, ['for' => 'title']) }}
        {!! Form::text('title', $data->title, ['class' => 'form-control']) !!}
		  </div>
		  @endif
		  
		  <div class="form-group">
        {{ Form::label('Content:', null, ['for' => 'content']) }}
        {!! Form::textarea('content', $data->content, ['class' => 'form-control']) !!}
		  </div>
		  
		  @if(!in_array($data->section,array('video','timeline','vision','accordion','footer','s.media','contact','contact2')))
		  <div class="form-group">
        {{ Form::label('Image:', null, ['for' => 'image']) }}
        {{ Form::file('image') }}
		  </div>
		  @endif
		  
      {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
        </div>
        <div class="modal-footer">
        </div>
      </div>

    </div>
  </div>
  @endforeach
  @endif
  </div>

@endsection
