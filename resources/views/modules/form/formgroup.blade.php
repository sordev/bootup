@if (!isset($old) && empty($old))
	<?php $old = old($id); ?>
@endif

<div class="form-group">
	{!! Form::label($id,$label) !!}
	@if ($type=='email')
		{!! Form::email($id,$old,['class'=>'form-control','placeholder'=>$label,$required]) !!}
	@elseif ($type=='password')
		{!! Form::password('password',['class'=>'form-control','placeholder'=>$label,$required]) !!}
	@elseif ($type=='text')
		{!! Form::text($id,$old,['class'=>'form-control','placeholder'=>$label,$required]) !!}
	@elseif ($type=='textarea')
		{!! Form::textarea($id,$old,['class'=>'form-control','placeholder'=>$label,$required]) !!}
		@if($cke==true)
			<script>
                CKEDITOR.replace( '{{{$id}}}' );
            </script>
		@endif
	@elseif ($type=='select')
		{!! Form::select($id,$option,$old,['class'=>'form-control','placeholder'=>$label,$required]) !!}
	@endif
	@if (isset($note) && !empty($note))
		<p class="help-block">{{{$note}}}</p>
	@endif
</div>