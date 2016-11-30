
{!! Form::open(array('url'=>'admin/categories/store','method'=>'post','class'=>'')) !!}
	@if (isset($category))
		{!! Form::hidden('id',$category->id) !!}
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.position'),'id'=>'position',$required='','old'=>$category->position])
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.title'),'id'=>'title',$required='required','old'=>$category->title])
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.slug'),'id'=>'slug',$required='required','old'=>$category->slug])
		@include('modules.form.formgroup',['type'=>'select','label'=>trans('project.type'),'id'=>'type',$required='required','option'=>$category_type_options,'old'=>$category->type])
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.description'),'id'=>'description',$required='','old'=>$category->description])
		{!! Form::submit(trans('messages.delete'),['class'=>'btn btn-default btn-danger']) !!}
	@else
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.position'),'id'=>'position',$required=''])
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.title'),'id'=>'title',$required='required'])
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.slug'),'id'=>'slug',$required='required'])
		@include('modules.form.formgroup',['type'=>'select','label'=>trans('project.type'),'id'=>'type',$required='required','option'=>$category_type_options])
		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.description'),'id'=>'description',$required=''])
	@endif
	{!! Form::submit(trans('messages.save'),['class'=>'btn btn-default btn-info']) !!}
{!! Form::close() !!}
