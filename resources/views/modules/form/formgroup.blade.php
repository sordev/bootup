<?php

if(isset($data) && !empty($data)){
	$old = $data->$id;
} elseif(Request::has($id)) {
	$old = Request::get($id);
} else {
	$old = old($id);
}
if (isset($required) && ($required==true || $required == 'required')){
	$required = 'required';
} else {
	$required = '';
}
?>

<div class="form-group">
	{!! Form::label($id,$label) !!}
	
		@if ($type=='email')
			{!! Form::email($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
		@elseif ($type=='password')
			{!! Form::password('password',['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
		@elseif ($type=='number')
			{!! Form::number($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
		@elseif ($type=='text')
			{!! Form::text($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
		@elseif ($type=='currency')
		<div class="input-group">
			{!! Form::number($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label,'min'=>'0','step'=>'0.01',]) !!}
			<span class="input-group-addon">₮</span>
		</div>
		@elseif ($type=='checkbox')
		<div class="checkbox">
			<label>
			{!! Form::checkbox($id,$old,false,['class'=>' '.$required,'placeholder'=>$label]) !!}
				{{{$label}}}
			</label>
		</div>
		@elseif ($type=='date')
			{!! Form::text($id,$old,['class'=>'form-control date '.$required,'placeholder'=>$label]) !!}
		@elseif ($type=='textarea')
			{!! Form::textarea($id,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
			@if(isset($cke) && $cke==true)
				<script>
					CKEDITOR.replace( '{{{$id}}}' );
				</script>
			@endif
		@elseif ($type=='select')
			{!! Form::select($id,$option,$old,['class'=>'form-control '.$required,'placeholder'=>$label]) !!}
		@endif
		@if (isset($note) && !empty($note))
			<p class="help-block">{{{$note}}}</p>
		@endif
	
</div>