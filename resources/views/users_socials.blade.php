{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('social', 'Social:') !!}
			{!! Form::text('social') !!}
		</li>
		<li>
			{!! Form::label('socialname', 'Socialname:') !!}
			{!! Form::text('socialname') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}