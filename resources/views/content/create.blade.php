@extends('layouts.default')
@section('header')
	@parent
	@include('content.actions')
@endsection

@section('content')
	@include('errors.errors')
	@include('content.form')
@endsection