@extends('layouts.default')
@section('header')
	@parent
	@include('categories.actions')
@endsection

@section('content')
	@include('errors.errors')

	@if(isset($category_types))
		<p>{{trans('project.categoriestype')}}</p>
		@foreach($category_types as $ct)
			<a href="{{{url('admin/categories/'.$ct->slug)}}}" class="btn btn-default">{{{$ct->title}}}</a>
		@endforeach
	@endif
	@if(isset($categories) && !empty($categories))
		<table class="table table-striped">
			<tr><th>ID</th><th>{{trans('project.position')}}</th><th>{{trans('project.title')}}</th><th>{{trans('project.slug')}}</th><th>{{trans('project.type')}}</th></tr>
			@foreach($categories as $c)
			<tr>
				<td>{{{$c->id}}}</td><td>{{{$c->position}}}</td><td>{{{$c->title}}}</td><td>{{{$c->slug}}}</td><td>{{{$c->typetitle}}}</td>
			</tr>
			@endforeach
		</table>
	@endif
@endsection
