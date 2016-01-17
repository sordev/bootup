<div class="ui input @if (isset($f['class'])) {{$f['class']}} @endif">
	<?php
		$attr = [];
		if (isset($f['class'])){
			$attr = array_merge($attr,['class'=>$f['class']]);
		}
		if (isset($f['placeholder'])){
			$attr = array_merge($attr,['placeholder'=>$f['placeholder']]);
		}
	?>
	<?php switch($f['type']){
		case "text":?>
			{!! Form::text($f['input'], Input::get($f['input']), $attr) !!}
		<?php break;
		case "select":?>
			{!! Form::select($f['input'], $f[4], Input::get($f['input']), $attr) !!}
		<?php break;
		case "textarea":?>
			{!! Form::textarea($f['input'], Input::get($f['input']), $attr) !!}
		<?php break;?>
	<?php } ?>
	@if ( isset($f['icon']) )
		<i class="{{ $f['icon'] }} icon"></i>
	@endif
</div>