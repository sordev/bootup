@if(isset($users) && !empty($users))
	<ul class="project-team-list list-unstyled">
	@foreach ($users as $u)
		@if($u)
		<li class="padding-sm">
			@if($u->avatar)
				<img src="{{{asset('images/avatar/thumbnail/'.$u->avatar)}}}" class="thumbnail pull-left" />
			@endif
			<div class="pull-left padding-sm">
				<a target="_blank" href="{{{$u->url}}}" title="{{{$u->fullname}}}">{{{$u->fullname}}}</a>
				@if(isset($contact) && $contact == true)
				{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
					<div>
						<a href="#" class="btn btn-default" data-action="contactUserModal" data-userid="{{{$u->id}}}">Холбогдох</a>
					</div>
				{!! Form::close() !!}
				@endif
				@if(isset($remove) && $remove == true && $u->leader != true)
					</br>
					<button type="button" class="btn btn-default" data-action="removeTeamMember" data-userid="{{{$u->id}}}">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Хасах
					</button>
				@endif
				@if(isset($add) && $add == true && $u->leader != true)
					</br>
					<button type="button" class="btn btn-default" data-action="addTeamMember" data-userid="{{{$u->id}}}">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Нэмэх
					</button>
				@endif
			</div>
			<div class="clearfix"></div>
		</li>
		@endif
	@endforeach 
	</ul>
@endif