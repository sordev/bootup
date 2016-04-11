@extends('layouts.default')
@section('header')
	<p>Төслийн танилцуулга.</p>
@endsection

@section('content')
	@include('errors.errors')
	@if(isset($project) && !empty($project))
		{{{$project->title}}}
		@if(isset($edit) && $edit == true)
			<a href="{{{url('edit/project/'.$project->id)}}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
		@endif
	@endif
@endsection