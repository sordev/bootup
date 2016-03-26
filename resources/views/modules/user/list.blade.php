@if(isset($users) && !empty($users))
	<ul class="project-team-list">
	@foreach ($users as $u)
		<li>
			<a href="{{{url('user/profile/'.$u->username)}}}">{{{$u->firstname}}} {{{$u->lastname}}}</a>
		</li>
	@endforeach 
	</ul>
@endif