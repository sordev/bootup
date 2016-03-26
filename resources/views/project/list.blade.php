@extends('layouts.default')
@section('header')
	<p>Төслүүд.</p>
@endsection

@section('content')
	@include('errors.errors')
	@if($projects)
		<div class="row">
		@foreach($projects as $p)
			<div class="col-md-3">
				<div class="project">
					<h3 class="project-title">{{{$p->title}}}</h3>
					<div class="project-category">Ангилал: @include('modules.categories.list',['categories'=>$p->categories])</div>
					<div class="project-teammembers">Төслийн гишүүд: @include('modules.user.list',['users'=>$p->team])</div>
				</div>
			</div>
		@endforeach
		</div>
		{!! $projects->links() !!}
	@endif
@endsection