<hr>
{!! Form::open(array('url'=>'admin/content/store','method'=>'post','class'=>'')) !!}
	@if (isset($content))
		{!! Form::hidden('id',$category->id) !!}
		@include('modules.form.formgroup',['type'=>'text','label'=>'Нэр','id'=>'title',$required='required','old'=>$content->title])
	@else
		@include('modules.form.formgroup',['type'=>'text','label'=>'Гарчиг','id'=>'title',$required='true'])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Зам','id'=>'slug',$required='true','note'=>'Хэрвээ агуулгын төрөл нь Хуудас байвал энэ замаа шууд ашиглана, Харин блог байвал blog/АНГИЛАЛЫН_ЗАМ/ТАНЫ_ЗАМ хэлбэрээр гарна'])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Төлөв','id'=>'status','option'=>['draft'=>'Ноорог','publish'=>'Идэвхитэй'],'required'=>true])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Онцгой төлөв','id'=>'status','option'=>['0'=>'Хэвийн','1'=>'Онцгой']])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Төрөл','id'=>'type',$required='required','option'=>$content_type_options])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Ангилал','id'=>'category_id',$required='required','option'=>$categories])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Тайлбар','id'=>'description'])
		@include('modules.form.formgroup',['type'=>'textarea','label'=>'Товчлол','id'=>'summary'])
		@include('modules.form.formgroup',['type'=>'textarea','label'=>'Агуулга','id'=>'content','cke'=>true])
		
	@endif
	{!! Form::submit('Хадгалах',['class'=>'btn btn-default']) !!}
{!! Form::close() !!}