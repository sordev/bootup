{!! Form::open(array('url'=>'admin/content/store','method'=>'post','class'=>'')) !!}
	@if (!isset($content) && empty($content))
		<?php $content = null;?>
	@else
		{!! Form::hidden('id',$content->id) !!}
	@endif

	@include('modules.form.formgroup',['data'=>$content,'type'=>'text','label'=>'Гарчиг','id'=>'title','required'=>true])
	@include('modules.form.formgroup',['data'=>$content,'type'=>'text','label'=>'Зам','id'=>'slug','required'=>true,'note'=>'Хэрвээ агуулгын төрөл нь Хуудас байвал энэ замаа шууд ашиглана, Харин блог байвал blog/АНГИЛАЛЫН_ЗАМ/ТАНЫ_ЗАМ хэлбэрээр гарна'])
	<div class="row">
		<div class="col-md-2">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'select','label'=>'Төлөв','id'=>'status','option'=>['draft'=>'Ноорог','publish'=>'Идэвхитэй'],'required'=>true,'old'=>'draft',])
		</div>
		<div class="col-md-3">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'checkbox','label'=>'Онцгой болгох','id'=>'featured'])
		</div>
		<div class="col-md-3">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'checkbox','label'=>'Сэтгэгдэл асаах','id'=>'comments'])
		</div>
		<div class="col-md-2">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'select','label'=>'Төрөл','id'=>'type','required'=>true,'option'=>$content_type_options])
		</div>
		<div class="col-md-2">
			@include('modules.form.formgroup',['data'=>$content,'type'=>'select','label'=>'Ангилал','id'=>'category_id','required'=>true,'option'=>$categories])
		</div>
	</div>
	@include('modules.form.formgroup',['data'=>$content,'type'=>'text','label'=>'Тайлбар','id'=>'description'])
	@include('modules.form.formgroup',['data'=>$content,'type'=>'textarea','label'=>'Товчлол','id'=>'summary'])
	@include('modules.form.formgroup',['data'=>$content,'type'=>'textarea','label'=>'Агуулга','id'=>'content','cke'=>true,'required'=>true])
		
	{!! Form::submit('Хадгалах',['class'=>'btn btn-default']) !!}
{!! Form::close() !!}