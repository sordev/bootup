@if(isset($goals) && !empty($goals))
	<ul class="project-goal-list">
	@foreach ($goals as $g)
		@if($g)
			@include('modules.project.goal_list_item',['g'=>$g])
		@endif
	@endforeach 
	</ul>
@endif