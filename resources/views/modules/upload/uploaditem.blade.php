@if (!isset($old) && empty($old))
	<?php
		$old = old($id);
	?>
@endif
<div class="form-group">
	{{Form::label($id,$label) }}
	@if($view=='create')
		<span class="btn btn-success fileinput-button">
			<i class="glyphicon glyphicon-plus"></i>
			<span>Select file...</span>
			<!-- The file input field used as target for the file upload widget -->
			<input class="file_upload_input" id="upload_{{{$id}}}" type="file" name="files[]" multiple value="{{{$old}}}">
		</span>
		<br>
		<br>
		
		<div id="progress_{{{$id}}}" class="progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
		<!-- The container for the uploaded files -->
		<div id="files_{{{$id}}}" class="files">
			@if($old)
				<h4>Одооны зураг</h4>
				<img src="{{{asset('images/projects/'.$old)}}}">
			@endif
		</div>
	@elseif ($view=='edit')
		@if($event->$id)
			@include('events.imagepreview',['field'=>$id,'img'=>$event->$id])
		@endif()
		<span class="btn btn-success fileinput-button" data-toggle="modal" data-target="#modal_{{{$id}}}">
			<i class="glyphicon glyphicon-edit"></i>
			<span>Change</span>
		</span>
		<span class="btn btn-danger empty-field" data-field="{{{$id}}}">
			<i class="glyphicon glyphicon-remove"></i>
		</span>
	@endif
	{{Form::hidden($id) }}
</div>