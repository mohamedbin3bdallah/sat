@extends('web.layouts.app')

@section('content')

<title>Form</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/contact.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/contact_responsive.css')}}">
	
	<!-- Google Map -->
	<div class="container">
	    
	
	
	<div class="section_container">
					    <div class="inquary">Filters Press Inquiry Form</div>
					   
					   
					</div>
					<div class="head_form_container">
						<form action="{{url('form/filterspress')}}" method="post" class="head_form">
							<input type="hidden" name="form" value="filterspress" />
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
									<label>Flow Rate</label>
									<input type="text" name="flrate" class="input_item" placeholder="Flow Rate">
								</div>
								<div class="col-md-12">
									<label>Solid Concentration</label>
									<input type="text" name="solidcons" class="input_item" placeholder="Solid Concentration">
								</div>
								<div class="col-md-12">
									<label>Fluid Details</label>
									<input type="text" name="details" class="input_item" placeholder="Fluid Details">
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