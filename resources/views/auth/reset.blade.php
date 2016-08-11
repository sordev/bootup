@extends('layouts.default')
<!-- resources/views/auth/password.blade.php -->
@section('sidebar')
    @parent
@endsection

@section('header')
	@parent
	<p>
		Та дараах талбарыг бөглөн нууц үгээ шинээр бүтээнэ үү.
	</p>
@endsection

@section('content')
@include('errors.errors')
{!! Form::open(array('url'=>'password/reset','method'=>'post','class'=>'')) !!}
	<input type="hidden" name="token" value="{{ $token }}">
	@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйл','id'=>'email',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Шинэ нууц үг','id'=>'password',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Шинэ нууц үг давтан','id'=>'password_confirmation',$required='required'])
	{!! Form::submit('Нууц үгээ солих',['class'=>'btn btn-default']) !!}
{!! Form::close() !!}
@endsection