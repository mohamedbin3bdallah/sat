@extends('web.layouts.app')

@section('content')

<title>Form</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/contact.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/contact_responsive.css')}}">
	
	<!-- Google Map -->
	<div class="container">
	    
	
	
	<div class="section_container">
					    <div class="inquary">Galvanizing Inquiry Form</div>
					   
					   
					</div>
					<div class="head_form_container">
						<form action="{{url('form/galvanizing')}}" method="post" class="head_form">
							<input type="hidden" name="form" value="galvanizing" />
							{!! Form::token() !!}
							<div class="row">
							@if (!Auth::check())
								<div class="col-md-6">
									<label>Your Name</label>
									<input type="text" name="name" class="input_item" placeholder="Your Name" required="required">
								</div>
								<div class="col-md-6">
									<label>Your E-mail</label>
									<input type="email" name="email" class="input_item" placeholder="Your E-mail" required="required">
								</div>
								<div class="col-md-6">
									<label>Your Phone</label>
									<input type="text" name="phone" class="input_item" placeholder="Your Phone" required="required">
								</div>
								<div class="col-md-6">
									<label>Company Name</label>
									<input type="text" name="company" class="input_item" placeholder="Company Name">
								</div>
							@else
								<div class="col-md-6">
									<label>Your Name:</label>
									<label>{{Auth::user()->name}}</label>
								</div>
								<div class="col-md-6">
									<label>Your E-mail:</label>
									<label>{{Auth::user()->email}}</label>
								</div>
								<div class="col-md-6">
									<label>Your Phone:</label>
									<label>{{Auth::user()->phone}}</label>
								</div>
								<div class="col-md-6">
									<label>Company Name:</label>
									<label>{{(isset(Auth::user()->company->name))? Auth::user()->company->name:Auth::user()->company_name}}</label>
								</div>
								{!! Form::hidden('name', Auth::user()->name) !!}
								{!! Form::hidden('email', Auth::user()->email) !!}
								{!! Form::hidden('phone', Auth::user()->phone) !!}
								{!! Form::hidden('company', (isset(Auth::user()->company->name))? Auth::user()->company->name:'') !!}
							@endif
								<hr>
								<div class="col-md-12">
									<label>What is to be galvanized?</label>
									<input type="text" name="galvan" class="input_item" placeholder="What is to be galvanized?">
								</div>
								<div class="col-md-12">
									<label>How big are the pieces (length - width - depth)?</label>
									<input type="text" name="lewide" class="input_item" placeholder="How big are the pieces (length - width - depth)?">
								</div>
								<div class="col-md-12">
									<label>How many pounds/tons per hour (or day) do you wish to run?</label>
									<input type="text" name="pounton" class="input_item" placeholder="How many pounds/tons per hour (or day) do you wish to run?">
								</div>
								<div class="col-md-12">
									<label>Are you familiar with the galvanizing process?</label>
									<input type="text" name="galproc" class="input_item" placeholder="Are you familiar with the galvanizing process?">
								</div>
								<div class="col-md-12">
									<label>Where is the plant to be located?</label>
									<input type="text" name="plantloc" class="input_item" placeholder="Where is the plant to be located?">
								</div>
								<div class="col-md-12">
									<label>How much land do you have available?</label>
									<input type="text" name="landavai" class="input_item" placeholder="How much land do you have available?">
								</div>
								<div class="col-md-12">
									<label>What utilities are available?</label>
									<input type="text" name="utiliavai" class="input_item" placeholder="What utilities are available?">
								</div>
								<div class="col-md-12">
									<label>What fuels are available?</label>
									<input type="text" name="fueavai" class="input_item" placeholder="What fuels are available?">
								</div>
								<div class="col-md-12">
									<label>Can you arrange to do simple steel fabrication?</label>
									<input type="text" name="stfab" class="input_item" placeholder="Can you arrange to do simple steel fabrication?">
								</div>
								<div class="col-md-12">
									<label>Are there any Special requirements that need to be addressed?</label>
									<input type="text" name="specreq" class="input_item" placeholder="Are there any Special requirements that need to be addressed?">
								</div>
								<div class="col-md-12">
									<label>Notes</label>
									<textarea id="contact_message" class="input_item contact_message" name="message" placeholder="Notes"  data-error="Please, write us a message."></textarea>
								</div>
								<div class="col-md-12">
									<center><button id="contact_btn" type="submit" class="btn btn-warning" name="submit" value="Submit">Send Inquiry</button></center><br />
								</div>
							</div>
						</form>
					</div>
				</div>
				
				
@endsection