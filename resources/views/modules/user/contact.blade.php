{!! Form::open(array('url'=>'user/contact','method'=>'post','class'=>'preventSubmit')) !!}
	{!! Form::hidden('id',$user->id)!!}
	@include('modules.form.formgroup',['type'=>'email','label'=>'Таны Имэйл','id'=>'email',$required='required'])
	@include('modules.form.formgroup',['type'=>'text','label'=>'Таны Овог Нэр','id'=>'fullname',$required='required'])
	@include('modules.form.formgroup',['type'=>'textarea','label'=>'Захиа','id'=>'message',$required='required'])
	{!! Form::submit('Илгээх',['class'=>'btn btn-default','data-action'=>'contactUser']) !!}
{!! Form::close() !!}