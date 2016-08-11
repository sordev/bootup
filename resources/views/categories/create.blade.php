@extends('layouts.default')
@section('header')
	@parent
	@include('categories.actions')
@endsection

@section('content')
	@include('errors.errors')
	@include('categories.form')
@endsection