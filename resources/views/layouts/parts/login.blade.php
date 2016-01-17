{!! Form::open(array('url'=>'user/login','method'=>'post','class'=>'ui form registerform')) !!}
	<div class="field">	  
	  <div class="three fields">
		<div class="required field">
			{!! Form::label('email','Email') !!}
			<div class="ui icon input">
			{!! Form::email('email',null,['placeholder'=>'Email','required']) !!}
			<i class="mail icon"></i>
			</div>
		</div>
		<div class="required field">
		  <label>Password</label>
		  <div class="ui icon input">
			{!! Form::password('password',null) !!}
			<i class="lock icon"></i>
		  </div>
		</div>
		<div class="field">
			<label>Remember me</label>
			<div class="ui checkbox">
			  {!! Form::checkbox('remember_me',null,false,["id"=>"remember_me"]) !!}
			  <label for="remember_me">Remember me on this computer.</label>
			</div>
		</div>
	  </div>
	</div>
  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>
  {!! Form::submit('Login',['class'=>'ui submit button']) !!}
{!! Form::close() !!}