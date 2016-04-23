@extends('layouts.default')
@section('header')
	@include('content.actions')
@endsection

@section('content')
	@include('errors.errors')
	@if(isset($content_types))
		<h4>Төрлөө сонгоод харна уу</h4>
		@foreach($content_types as $ct)
			<a href="{{{url('admin/content/'.$ct->uniqid)}}}" class="btn btn-default">{{{$ct->title}}}</a>
		@endforeach
	@endif
	@if(isset($contents) && !empty($contents))
		<table class="table table-striped">
			<tr><th>ID</th><th>Дараалал</th><th>Нэр</th><th>Слаг</th><th>Төрөл</th></tr>
			@foreach($content_types as $c)
			<tr>
				<td>{{{$c->id}}}</td><td>{{{$c->position}}}</td><td>{{{$c->title}}}</td><td>{{{$c->slug}}}</td><td>{{{$c->typetitle}}}</td>
			</tr>
			@endforeach
		</table>
	@endif
@endsection