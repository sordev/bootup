{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('user_id', 'User_id:') !!}
			{!! Form::text('user_id') !!}
		</li>
		<li>
			{!! Form::label('login_ip', 'Login_ip:') !!}
			{!! Form::text('login_ip') !!}
		</li>
		<li>
			{!! Form::label('login_time', 'Login_time:') !!}
			{!! Form::text('login_time') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}