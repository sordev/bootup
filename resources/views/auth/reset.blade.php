@extends('layouts.default')
<!-- resources/views/auth/password.blade.php -->
@section('sidebar')
    @parent
@endsection

@section('header')
	@parent
	<p>
		Enter you email address below, you'll receive password reset link.
	</p>
@endsection

@section('content')
@if (count($errors) > 0)
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
@endif
@if (session('status'))
	<div class="ui positive message">{{ session('status') }}</div>
@endif 
{!! Form::open(array('url'=>'password/reset','method'=>'post','class'=>'ui form passwordresetemailform')) !!}

	<div class="field">	  
	  <div class="three fields">
		<div class="required field">
			{!! Form::label('email','Email') !!}
			<div class="ui icon input">
			{!! Form::email('email',old('email'),['placeholder'=>'Email','required']) !!}
			<i class="mail icon"></i>
			</div>
		</div>
		<div class="required field">
		  <label>Password</label>
		  <div class="ui icon input">
			{!! Form::password('password',null) !!}
			<i class="lock icon"></i>
		  </div>
		</div>
		<div class="required field">
		  <label>Confirm Password</label>
		  <div class="ui icon input">
			{!! Form::password('password_confirmation',null) !!}
			<i class="lock icon"></i>
		  </div>
		</div>
	  </div>
	</div>
    <input type="hidden" name="token" value="{{ $token }}">

	{!! Form::submit('Reset Password',['class'=>'ui submit red button']) !!}
{!! Form::close() !!}
@endsection