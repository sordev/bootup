<div class="modal fade" tabindex="-1" role="dialog" id ="modal_{{{$field}}}">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body">
		<span class="btn btn-success fileinput-button">
			<i class="glyphicon glyphicon-plus"></i>
			<span>Select files...</span>
			<!-- The file input field used as target for the file upload widget -->
			<input class="file_upload_input" id="upload_{{{$field}}}" type="file" name="files[]" multiple>
		</span>
		<br>
		<br>
		<div id="progress_{{{$field}}}" class="progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
		<!-- The container for the uploaded files -->
		<div id="files_{{{$field}}}" class="files">
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->