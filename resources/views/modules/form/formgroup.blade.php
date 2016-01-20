<div class="form-group">
	{!! Form::label($id,$label) !!}
	@if ($type=='email')
		{!! Form::email($id,old($id),['class'=>'form-control','placeholder'=>$label,$required]) !!}
	@elseif ($type=='password')
		{!! Form::password('password',['class'=>'form-control','placeholder'=>$label,$required]) !!}
	@elseif ($type=='text')
		{!! Form::text($id,old($id),['class'=>'form-control','placeholder'=>$label,$required]) !!}
	@endif
</div>