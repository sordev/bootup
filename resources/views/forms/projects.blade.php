{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('team_members', 'Team_members:') !!}
			{!! Form::text('team_members') !!}
		</li>
		<li>
			{!! Form::label('image', 'Image:') !!}
			{!! Form::text('image') !!}
		</li>
		<li>
			{!! Form::label('intro', 'Intro:') !!}
			{!! Form::textarea('intro') !!}
		</li>
		<li>
			{!! Form::label('detail', 'Detail:') !!}
			{!! Form::textarea('detail') !!}
		</li>
		<li>
			{!! Form::label('video', 'Video:') !!}
			{!! Form::text('video') !!}
		</li>
		<li>
			{!! Form::label('status', 'Status:') !!}
			{!! Form::text('status') !!}
		</li>
		<li>
			{!! Form::label('slug', 'Slug:') !!}
			{!! Form::text('slug') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}