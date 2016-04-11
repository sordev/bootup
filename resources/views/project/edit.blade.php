@extends('layouts.default')
@section('header')
	<p>Төслийн мэдээллээ засварлах.</p>
@endsection

@section('content')
	@include('errors.errors')
	<div class="well well-lg projectsteps">
		{!! Form::open(array('url'=>'/','method'=>'post','class'=>'')) !!}
			<div class="projectstepcontainer">
				@include('project.steps.addproject')
			</div>
		{!! Form::close() !!}
	</div>
@endsection