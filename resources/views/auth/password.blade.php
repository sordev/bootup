@extends('layouts.default')
@section('header')
	@parent
	<p>
		Бүртгэлтэй имэйл хаягаа оруулснаар таны имэйл хаяг руу нууц үгээ солих имэйл очино.
	</p>
@endsection

@section('content')
{!! Form::open(array('url'=>'password/email','method'=>'post','class'=>'ui form passwordresetemailform')) !!}

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

	<div class="field">
		<div class="required field">
			{!! Form::label('email','Email') !!}
			<div class="ui icon input">
			{!! Form::email('email',null,['placeholder'=>'Email','required']) !!}
			<i class="mail icon"></i>
			</div>
		</div>
	</div>
	{!! Form::submit('Send Password Reset Link',['class'=>'ui submit blue button']) !!}
{!! Form::close() !!}
@endsection