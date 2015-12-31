{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('tag_id', 'Tag_id:') !!}
			{!! Form::text('tag_id') !!}
		</li>
		<li>
			{!! Form::label('post_id', 'Post_id:') !!}
			{!! Form::text('post_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}