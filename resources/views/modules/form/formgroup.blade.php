@if (!isset($old) && empty($old))
	<?php
		$old = old($id);
	?>
@endif
@if (!isset($required) && empty($required))
	<?php
		$required = 'required';
	?>
@else
	<?php
		$required = '';
	?>
@endif

<div class="form-group">
	{!! Form::label($id,$label) !!}
	@if ($type=='email')
		{!! Form::email($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
	@elseif ($type=='password')
		{!! Form::password('password',['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
	@elseif ($type=='text')
		{!! Form::text($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
	@elseif ($type=='textarea')
		{!! Form::textarea($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
		@if($cke==true)
			<script>
                CKEDITOR.replace( '{{{$id}}}' );
            </script>
		@endif
	@elseif ($type=='select')
		{!! Form::select($id,$option,$old,['class'=>'form-control','placeholder'=>$label]) !!}
	@endif
	@if (isset($note) && !empty($note))
		<p class="help-block">{{{$note}}}</p>
	@endif
</div>