{!! Form::open(array('url'=>'admin/content/store','method'=>'post','class'=>'')) !!}
	@if (!isset($content) && empty($content))
		<?php $content = null;?>
	@else
		{!! Form::hidden('id',$content->id) !!}
	@endif

	@include('modules.form.formgroup',['data'=>$content,'type'=>'text','label'=>trans('project.title'),'id'=>'title','required'=>true])
	@include('modules.form.formgroup',['data'=>$content,'type'=>'text','label'=>trans('project.slug'),'id'=>'slug','required'=>true,'note'=>trans('project.ifcontenttypeispagedirectlyusethisslugbutitisbloguseblogcategoryslug')])
	<div class="row">
		<div class="col-md-2">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'select','label'=>trans('messages.status'),'id'=>'status','option'=>['draft'=>trans('project.draft'),'publish'=>trans('project.publish')],'required'=>true,'old'=>'draft',])
		</div>
		<div class="col-md-3">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'checkbox','label'=>trans('project.featured'),'id'=>'featured'])
		</div>
		<div class="col-md-3">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'checkbox','label'=>trans('project.turnoncomments'),'id'=>'comments'])
		</div>
		<div class="col-md-2">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'select','label'=>trans('project.type'),'id'=>'type','required'=>true,'option'=>$content_type_options])
		</div>
		<div class="col-md-2">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'select','label'=>trans('project.category'),'id'=>'category_id','required'=>true,'option'=>$categories])
		</div>
	</div>
	@include('modules.form.formgroup',['data'=>$content,'type'=>'text','label'=>trans('project.description'),'id'=>'description'])
	@include('modules.form.formgroup',['data'=>$content,'type'=>'textarea','label'=>trans('project.summary'),'id'=>'summary'])
	@include('modules.form.formgroup',['data'=>$content,'type'=>'textarea','label'=>trans('project.content'),'id'=>'content','cke'=>true,'required'=>true])

	{!! Form::submit(trans('messages.save'),['class'=>'btn btn-default']) !!}
{!! Form::close() !!}
