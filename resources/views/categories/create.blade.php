@extends('layouts.default')
@section('header')
	@include('categories.actions')
@endsection

@section('content')
	@include('errors.errors')
	@include('categories.form')
@endsection