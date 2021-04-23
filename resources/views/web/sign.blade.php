@extends('web.layouts.app')

@section('content')

<title>Sign In</title>

<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/assets/styles/sign.css')}}">
   
    <div class="row">
        <div class="col-lg-12"> 
        <div class="login-wrap">
	<div class="login-html">
  
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
			<form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
				<div class="group">
					<label for="email" class="label">Email</label>
					<input id="user" type="email" name="email" value="{{ old('email') }}" class="input" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" name="password" class="input" data-type="password" required>
				</div>
				<!--<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>-->
				<div class="group">
					<input type="submit" class="button" value="Sign In">
				</div>
				<!--<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>-->
			</form>
			</div>
			<div class="sign-up-htm">
			<form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
				<div class="group">
					<label for="user" class="label">Name</label>
					<input id="user" type="text" name="name" value="{{ old('name') }}" class="input" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" type="text" name="email" value="{{ old('email') }}" class="input" required>
				</div>
				<div class="group">
					<label for="phone" class="label">Phone</label>
					<input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="input" required>
				</div>
				<div class="group">
					<label for="company" class="label">Company</label>
					<input id="company" type="text" name="company" value="{{ old('company') }}" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" name="password" data-type="password" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" name="password_confirmation" data-type="password" required>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</label>
				</div>
			</form>
			</div>
		</div>
		
		@if ($errors->any())
			<ul class="ul-danger">
				@foreach ($errors->all() as $error)
  					<li class="li-danger">
  						{{$error}}
  					</li>
				@endforeach
			</ul>
		@endif
	
	</div>
</div>
</div>
</div>

@endsection