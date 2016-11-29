<?php $count = count($projects);?>
@if(isset($projects))
	@foreach($projects as $k => $p)
		@include('modules.project.homepage.item',['p'=>$p])
		@if ($k+1 < $count)
			<hr class="tiny">
		@else
			<a title="{{trans('project.viewallprojects')}}" href="{{{url('projects')}}}" class="btn btn-default btn-lrg">{{trans('project.viewallprojects')}}</a>
		@endif

	@endforeach
@endif
