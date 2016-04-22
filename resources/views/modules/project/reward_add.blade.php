{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
	@include('modules.form.formgroup',['type'=>'text','label'=>'Урамшууллын нэр','id'=>'title','required'=>'required'])
	@include('modules.upload.uploaditem',['id'=>'reward_image','label'=>'Зураг','view'=>'create'])
	@include('modules.form.formgroup',['type'=>'textarea','label'=>'Танилцуулга','id'=>'description','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'currency','label'=>'Үнэлгээ','id'=>'value','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'number','label'=>'Тоо ширхэг','id'=>'amount','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'date','label'=>'Хэзээ бэлэн болох','id'=>'estimated_date','required'=>'required'])
	<button class="btn btn-default" data-action="addReward" type="button">Нэмэх</button>
{!! Form::close() !!}