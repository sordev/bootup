<?php $count = count($projects);?>
@if(isset($projects))
	@foreach($projects as $k => $p)
		@include('modules.project.homepage.item',['p'=>$p])
		@if ($k+1 < $count)
			<hr class="tiny">
		@else
			<div class="padding text-center">
			<a title="Бүх төслүүдийг харах" href="{{{url('projects')}}}" class="btn btn-default btn-lg">Бүх төслүүдийг харах</a>
			</div>
		@endif
		
	@endforeach
@endif