{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('request', 'Request:') !!}
			{!! Form::textarea('request') !!}
		</li>
		<li>
			{!! Form::label('response', 'Response:') !!}
			{!! Form::textarea('response') !!}
		</li>
		<li>
			{!! Form::label('type', 'Type:') !!}
			{!! Form::text('type') !!}
		</li>
		<li>
			{!! Form::label('project_id', 'Project_id:') !!}
			{!! Form::text('project_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}