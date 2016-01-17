{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('project_id', 'Project_id:') !!}
			{!! Form::text('project_id') !!}
		</li>
		<li>
			{!! Form::label('value', 'Value:') !!}
			{!! Form::text('value') !!}
		</li>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('gateway', 'Gateway:') !!}
			{!! Form::text('gateway') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}