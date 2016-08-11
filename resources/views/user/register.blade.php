@extends('layouts.default')
@section('header')
	@parent
	<p>Бүртгүүлэхийн тулд дараахи талбаруудын бөглөөрэй.</p>
@endsection

@section('content')
	@include('errors.errors')
	@include('modules.user.register')
@endsection