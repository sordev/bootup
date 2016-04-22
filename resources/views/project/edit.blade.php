@extends('layouts.default')
@section('header')
	<p>Төслийн мэдээллээ засварлах.</p>
@endsection

@section('content')
	<div class="well well-lg projectsteps">
	@include('errors.errors')
	@include('project.steps.addprojectdetail')
	</div>
@endsection