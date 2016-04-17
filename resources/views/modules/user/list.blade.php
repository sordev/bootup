@if(isset($users) && !empty($users))
	<ul class="project-team-list">
	@foreach ($users as $u)
		<li>
			<a href="{{{url('user/profile/'.$u->username)}}}">{{{$u->firstname}}} {{{$u->lastname}}}</a>
			@if(isset($remove) && $remove == true && $u->leader != true)
				<button type="button" class="btn btn-default" data-action="removeTeamMember">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Хасах
				</button>
			@endif
			@if(isset($add) && $add == true && $u->leader != true)
				<button type="button" class="btn btn-default" data-action="removeTeamMember">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Нэмэх
				</button>
			@endif
		</li>
	@endforeach 
	</ul>
@endif