@extends('layouts.default')
@section('header')
	{{{$content->title}}}
@endsection

@section('content')
	@include('errors.errors')
	{{{$content->title}}}
	{{{$content->content}}}
@endsection