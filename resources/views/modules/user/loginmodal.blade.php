<!-- Modal -->
<div class="modal fade" id="{{{$id}}}" tabindex="-1" role="dialog" aria-labelledby="{{{$id}}}ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="{{{$id}}}ModalLabel">{{{$title}}}</h4>
      </div>
      <div class="modal-body">
		{!! Form::open(array('url'=>'user/login','method'=>'post','class'=>'')) !!}
			@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйл','id'=>'email',$required='required'])
			@include('modules.form.formgroup',['type'=>'password','label'=>'Нууц үг','id'=>'password',$required='required'])
			<div class="checkbox">
				<label>
					{!! Form::checkbox('remember_me',null,false,["id"=>"remember_me"]) !!} Энэ компьютер дээр сануулах
				</label>
			</div>
			{!! Form::submit('Нэвтрэх',['class'=>'btn btn-default']) !!}
			<br>эсвэл<br>
			@include('modules.user.social')
		{!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
      </div>
    </div>
  </div>
</div>