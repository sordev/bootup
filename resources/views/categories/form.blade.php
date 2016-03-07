{!! Form::open(array('url'=>'admin/categories/store','method'=>'post','class'=>'')) !!}
	@if (isset($category))
		{!! Form::hidden('id',$category->id) !!}
		@include('modules.form.formgroup',['type'=>'text','label'=>'Дараалал','id'=>'position',$required='','old'=>$category->position])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Нэр','id'=>'title',$required='required','old'=>$category->title])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Слаг','id'=>'slug',$required='required','old'=>$category->slug])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Төрөл','id'=>'type',$required='required','option'=>$category_type_options,'old'=>$category->type])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Тайлбар','id'=>'description',$required='','old'=>$category->description])
	@else
		@include('modules.form.formgroup',['type'=>'text','label'=>'Дараалал','id'=>'position',$required=''])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Нэр','id'=>'title',$required='required'])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Слаг','id'=>'slug',$required='required'])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Төрөл','id'=>'type',$required='required','option'=>$category_type_options])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Тайлбар','id'=>'description',$required=''])
	@endif
	{!! Form::submit('Хадгалах',['class'=>'btn btn-default']) !!}
{!! Form::close() !!}