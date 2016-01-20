{!! Form::open(array('url'=>'user/store','method'=>'post','class'=>'')) !!}
	@include('modules.form.formgroup',['type'=>'text','label'=>'Хэрэглэгчийн нэр','id'=>'username',$required='required'])
	@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйл','id'=>'email',$required='required'])
	@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйлээ давтана уу','id'=>'emailConfirmation',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Нууц үг','id'=>'password',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Нууц үгээ давтана уу','id'=>'passwordConfirmation',$required='required'])
	<div class="field">
		<div class="g-recaptcha" data-sitekey="{{$recaptchakey}}"></div>
	</div>
	<div class="checkbox">
		<label>
			{!! Form::checkbox('subscribe_me',null,false,["id"=>"subscribe_me"]) !!} Мэйлээр мэдээлэл хүлээн авах
		</label>
	</div>
	<div class="checkbox">
		<label>
			{!! Form::checkbox('tos',null,false,["id"=>"tos"]) !!} Би <a href="{{{url('tos')}}}" target="_blank">үйлчилгээний нөхцлийг</a> зөвшөөрч байна
		</label>
	</div>
  {!! Form::submit('Бүртгүүлэх',['class'=>'btn btn-default']) !!}
  <br>эсвэл<br>
  @include('modules.user.social')
{!! Form::close() !!}