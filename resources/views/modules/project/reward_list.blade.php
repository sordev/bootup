@if(isset($rewards) && !empty($rewards))
	<ul class="project-reward-list">
	@foreach ($rewards as $r)
		@if($r)
			@include('modules.project.reward_list_item',['r'=>$r])
		@endif
	@endforeach 
	</ul>
@endif