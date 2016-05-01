@extends('layouts.default')
@section('header')
</div>
<div class="gray-box">
	<div class="container">
		@if(isset($project) && !empty($project))
			<h1>{{{$project->title}}}</h1>
			<div class="row">
				<div class="col-md-8">
					@if(isset($video))
						<div class="videoWrapper">
							@if($video['type']=='youtube')
								<iframe width="560" height="315" src="https://www.youtube.com/embed/{{{$video['id']}}}" frameborder="0" allowfullscreen></iframe>
							@endif
						</div>
					@endif
				</div>
				<div class="col-md-4">
					<div class="padding-lg">
						<div>
							<b>{{{count($project->payment)}}}</b>
							<br>
							Дэмжигчид
						</div>
						<div>
							<b>{{{number_format($project->totalpayment)}}} ₮</b>
							<br>
							Нийт төсөв: {{{number_format($project->totalgoal)}}} ₮
						</div>
						<div>
							<b>{{{$project->daysleft}}}</b>
							<br>
							Хоног үлдсэн
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
</div>
<div class="container">
@endsection

@section('content')
	@include('errors.errors')
	
	<div class="row">
		<div class="col-md-8">
			<div>
				# @include('modules.categories.list',['categories'=>$project->categories])
			</div>
			<p>
				{{{$project->intro}}}
			</p>
			<div class="share">
				Түгээх
				@foreach($project->shares as $s)
					<a href="{{{$s['href']}}}" class="btn btn-share btn-{{{$s['class']}}}">{{{$s['class']}}}</a>
				@endforeach
			</div>
		</div>
		<div class="col-md-4">
			<div class="padding-lg">
				<div class="project-leader">Төслийн удирдагч: @include('modules.user.list',['users'=>[$project->leader],'contact'=>true])</div>
				<div class="project-teammembers">Төслийн гишүүд: @include('modules.user.list',['users'=>$project->team,'contact'=>true])</div>
			</div>
		</div>
	</div>
	
	@if(isset($project) && !empty($project))
		{{{$project->title}}}
		@if(isset($edit) && $edit == true)
			<a href="{{{url('edit/project/'.$project->id)}}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
		@endif
	@endif
@endsection