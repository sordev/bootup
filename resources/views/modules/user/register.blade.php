{!! Form::open(array('url'=>'user/store','method'=>'post','class'=>'')) !!}
	@include('modules.form.formgroup',['type'=>'text','label'=>'Хэрэглэгчийн нэр','id'=>'username',$required='required'])
	@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйл','id'=>'email',$required='required'])
	@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйлээ давтана уу','id'=>'emailConfirmation',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Нууц үг','id'=>'password',$required='required'])
	@include('modules.form.formgroup',['type'=>'password','label'=>'Нууц үгээ давтана уу','id'=>'passwordConfirmation',$required='required'])
	<div class="form-group">
		<div class="g-recaptcha" id="g-recaptcha" data-sitekey="{{$recaptchakey}}"></div>
	</div>
	@include('modules.form.formgroup',['type'=>'checkbox','showlabel'=>false,'label'=>'Мэйлээр мэдээлэл хүлээн авах','id'=>'subscribe_me'])
	@include('modules.form.formgroup',['type'=>'checkbox','showlabel'=>false,'label'=>'Би <a href="'.url('tos').'" target="_blank">үйлчилгээний нөхцлийг</a> зөвшөөрч байна','id'=>'tos'])
  {!! Form::submit('Бүртгүүлэх',['class'=>'btn btn-default','data-action'=>'register']) !!}
  <br>эсвэл<br>
  @include('modules.user.social')
{!! Form::close() !!}