{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('item_id', 'Item_id:') !!}
			{!! Form::text('item_id') !!}
		</li>
		<li>
			{!! Form::label('comment', 'Comment:') !!}
			{!! Form::textarea('comment') !!}
		</li>
		<li>
			{!! Form::label('status', 'Status:') !!}
			{!! Form::text('status') !!}
		</li>
		<li>
			{!! Form::label('ip', 'Ip:') !!}
			{!! Form::text('ip') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}