@extends('layouts.default')

@section('sidebar')
    @parent
@endsection

@section('header')
	<p>
		Нууц үгээ солих.
	</p>
@endsection

@section('content')

@if($errors->any())
	@include('errors.errors')
@endif
@if (session('status'))
    <div class="ui message success">
        {{ session('status') }}
    </div>
@endif
{!! Form::open(array('url'=>'user/update/profile/password','method'=>'post','class'=>'ui form editpasswordform')) !!}  
<div class="three fields">
	<div class="required field">
		{!! Form::label('password_old','Old Password') !!}
		{!! Form::password('password_old','',['required']) !!}
	</div>
	<div class="required field">
		{!! Form::label('password_new','New Password') !!}
		{!! Form::password('password_new','',['required']) !!}
	</div>
	<div class="required field">
		{!! Form::label('password_new_confirmation','New Password Repeat') !!}
		{!! Form::password('password_new_confirmation','',['required']) !!}
	</div>
</div>
<div class="ui error message">
	<div class="header">We noticed some issues</div>
</div>
{!! Form::submit('Update',['class'=>'ui submit button blue']) !!}
{!! Form::close() !!}
@endsection