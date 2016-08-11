{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
	@include('modules.form.formgroup',['type'=>'text','label'=>'Зорилтын нэр','id'=>'title','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'textarea','label'=>'Тайлбар','id'=>'description','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'date','label'=>'Эхлэх огноо','id'=>'start','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'date','label'=>'Дуусах огноо','id'=>'end','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'number','label'=>'Үе шат','id'=>'phase','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'currency','label'=>'Шаардагдах хөрөнгө','id'=>'goal','required'=>'required'])
	<button class="btn btn-default" data-action="addGoal" type="button">Нэмэх</button>
{!! Form::close() !!}