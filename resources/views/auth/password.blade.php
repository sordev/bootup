@extends('layouts.default')
@section('header')
	@parent
	<p>
		Бүртгэлтэй имэйл хаягаа оруулснаар таны имэйл хаяг руу нууц үгээ солих имэйл очино.
	</p>
@endsection

@section('content')
@include('errors.errors')
{!! Form::open(array('url'=>'user/reset/password','method'=>'post','class'=>'passwordresetemailform form-inline')) !!}
	@include('modules.form.formgroup',['type'=>'email','label'=>'Таны бүртгэлтэй имэйл хаяг','id'=>'email',$required='required'])
	{!! Form::submit('Нууц үг солих холбоосыг илгээх',['class'=>'btn btn-default']) !!}
{!! Form::close() !!}
@endsection