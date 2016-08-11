@extends('layouts.default')
@section('header')
	@parent
	<p>Төслийн мэдээллээ засварлах.</p>
@endsection

@section('content')
	@include('errors.errors')
	<div class="well well-lg projectsteps">
	@include('project.steps.addprojectdetail')
	</div>
@endsection