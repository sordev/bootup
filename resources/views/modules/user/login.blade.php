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
  <button type="button" class="btn btn-default" href="{{url('user/login/facebook')}}" >Facebook -р нэвтрэх</button>
  <button type="button" class="btn btn-default" href="{{url('user/login/twitter')}}" >Twitter -р нэвтрэх</button>
  <button type="button" class="btn btn-default" href="{{url('user/login/google')}}" >Google -р нэвтрэх</button>
{!! Form::close() !!}