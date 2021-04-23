@extends('web.layouts.app')

@section('content')

<title>Contact</title>
	
	<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/contact.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/contact_responsive.css')}}">

	<div class="hero">


  
   <!-- Header -->
 

     </div> 
     
<!--        head    -->
    
	<div class="head">
		<div class="container-fluid" id="contact">
			<div class="row">
				<div class="col-lg-4" >
					<div class="Address" id="contact_bg_x">
						<div class="section_title_container" >
							<div class="Address_title" >Contact info</div>
						</div>
						<div class="info_title" id="one">Head Office</div>
						<ul>
                        
					   <li>Address: 61 Iran Street, Dokki </li>  
							
						    <li>Phone:  +202-3335-3664</li>
							
							<li>Email: sales@sat-eng.com </li>
						</ul>
					</div>
					<div class="contact">
                    <div class="envelope">
                        <div class="top">
                            <div class="outer"><div class="inner"></div></div>
                        </div>
                        <div class="bottom"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                        <div class="cover"></div>
                        <div class="paper">
                            <a class="call" href="tel:5555555555"><i class="ion-ios-telephone-outline"></i>TEL:+25 25 300 800</a>
                            <a class="mail" href="mailto:you@domain.com"><div class="i"></div>you@domain.com</a>
                        </div>
                    </div>
                </div>
				</div>
				<div class="col-lg-8 head_form_col">
					<div class="map">
		<div id="google_map" class="google_map">
            <div class="container" id="maps">
            <div class="row">
			      <div class="col">
			      <!-- Contact -->
    <div class="circle">
         <i id="scroll-icon" class="fa fa-angle-down icon" aria-hidden="true"></i>
        </div> 
			   <iframe class="fame" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3453.976330704627!2d31.2004567!3d30.0375369!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145846cdcd68ace1%3A0x3c31f0c4efc74e34!2sSystems+and+Technology+Co.!5e0!3m2!1sen!2seg!4v1542022828074" width="100%" height="400" frameborder="0"  style="border:0" allowfullscreen></iframe></div>
			   </div>
			</div>
		</div>
		</div>
	</div>

	
			</div>
		</div>
	</div>
	
	<!-- Google Map -->
	<div class="container">
	    
	
	
	<div class="section_container">
					    <div class="section_title">CONTACT US</div>
					   
					   
					</div>
					<div class="head_form_container">
					@if (session('message'))
						<p style="text-align:center;color:{{session('color')}}">{{session('message')}}</p>
					@endif
						{!! Form::open(['url' => 'contact']) !!}
							<div class="row">
							@if (!Auth::check())
								<div class="col-md-6">
									{!! Form::text('name', old('name'), ['class'=>'input_item', 'placeholder'=>'Your Name', 'required'=>'required']) !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('email', old('email'), ['class'=>'input_item', 'placeholder'=>'Your E-mail', 'required'=>'required']) !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('phone', old('phone'), ['class'=>'input_item', 'placeholder'=>'Your Phone']) !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('company', old('company'), ['class'=>'input_item', 'placeholder'=>'Company Name']) !!}
								</div>
							@else
								{!! Form::hidden('name', Auth::user()->name) !!}
								{!! Form::hidden('email', Auth::user()->email) !!}
								{!! Form::hidden('phone', Auth::user()->phone) !!}
								{!! Form::hidden('company', (isset(Auth::user()->company->name))? Auth::user()->company->name:'') !!}
							@endif
								<div class="col-md-12">
									{!! Form::textarea('message', old('description'), ['class'=>'input_item contact_message', 'placeholder'=>'Your Message', 'required'=>'required']) !!}
								</div>
								<div class="col-md-12">
									{!! Form::submit('Send Message', ['name'=>'submit', 'class'=>'contact_button trans_200 btn btn-warning', 'id'=>'contact_btn']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
@endsection