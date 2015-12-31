{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('project_id', 'Project_id:') !!}
			{!! Form::text('project_id') !!}
		</li>
		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::label('start', 'Start:') !!}
			{!! Form::text('start') !!}
		</li>
		<li>
			{!! Form::label('end', 'End:') !!}
			{!! Form::text('end') !!}
		</li>
		<li>
			{!! Form::label('phase', 'Phase:') !!}
			{!! Form::text('phase') !!}
		</li>
		<li>
			{!! Form::label('description', 'Description:') !!}
			{!! Form::text('description') !!}
		</li>
		<li>
			{!! Form::label('goal', 'Goal:') !!}
			{!! Form::text('goal') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}