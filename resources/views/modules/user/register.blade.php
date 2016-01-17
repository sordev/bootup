{!! Form::open(array('url'=>'user/login','method'=>'post','class'=>'')) !!}
	@include('modules.form.formgroup',['type'=>'text','label'=>'Хэрэглэгчийн нэр','id'=>'username',$required='required'])
	@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйл','id'=>'email',$required='required'])
	@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйлээ давтана уу','id'=>'emailConfirmation',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Нууц үг','id'=>'password',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Нууц үгээ давтана уу','id'=>'passwordConfirmation',$required='required'])
	<div class="checkbox">
		<label>
			{!! Form::checkbox('subscribe_me',null,false,["id"=>"subscribe_me"]) !!} Мэйлээр мэдээлэл хүлээн авах
		</label>
	</div>
  {!! Form::submit('Бүртгүүлэх',['class'=>'btn btn-default']) !!}
  <br>эсвэл<br>
  <button type="button" class="btn btn-default" href="{{url('user/login/facebook')}}" >Facebook -р нэвтрэх</button>
  <button type="button" class="btn btn-default" href="{{url('user/login/twitter')}}" >Twitter -р нэвтрэх</button>
  <button type="button" class="btn btn-default" href="{{url('user/login/google')}}" >Google -р нэвтрэх</button>
{!! Form::close() !!}