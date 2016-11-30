{!! Form::open(array('url'=>'admin/content','method'=>'get','class'=>'form-inline')) !!}

		@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.title'),'id'=>'title'])
		@include('modules.form.formgroup',['type'=>'select','label'=>trans('project.type'),'id'=>'type','option'=>$content_type_options])
		@include('modules.form.formgroup',['type'=>'select','label'=>trans('project.category'),'id'=>'category_id','option'=>$categories])
		@include('modules.form.formgroup',['type'=>'select','label'=>trans('messages.status'),'id'=>'status','option'=>['publish'=>trans('project.publish'),'draft'=>trans('project.draft'),'trashed'=>trans('project.trashed')]])
	<button type="submit" class="btn btn-default">{{trans('messages.search')}}</button>
{!! Form::close() !!}
<hr>
