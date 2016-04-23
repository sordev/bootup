{!! Form::open(array('url'=>'admin/content/store','method'=>'post','class'=>'')) !!}
	@if (isset($content))
		{!! Form::hidden('id',$category->id) !!}
		@include('modules.form.formgroup',['type'=>'text','label'=>'Нэр','id'=>'title','required'=>true,'old'=>$content->title])
	@else
		@include('modules.form.formgroup',['type'=>'text','label'=>'Гарчиг','id'=>'title','required'=>true])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Зам','id'=>'slug','required'=>true,'note'=>'Хэрвээ агуулгын төрөл нь Хуудас байвал энэ замаа шууд ашиглана, Харин блог байвал blog/АНГИЛАЛЫН_ЗАМ/ТАНЫ_ЗАМ хэлбэрээр гарна'])
		<div class="row">
			<div class="col-md-2">
				@include('modules.form.formgroup',['type'=>'select','label'=>'Төлөв','id'=>'status','option'=>['draft'=>'Ноорог','publish'=>'Идэвхитэй'],'required'=>true,'old'=>'draft',])
			</div>
			<div class="col-md-3">
				@include('modules.form.formgroup',['type'=>'checkbox','label'=>'Онцгой болгох','id'=>'featured'])
			</div>
			<div class="col-md-3">
				@include('modules.form.formgroup',['type'=>'checkbox','label'=>'Сэтгэгдэл асаах','id'=>'comments'])
			</div>
			<div class="col-md-2">
				@include('modules.form.formgroup',['type'=>'select','label'=>'Төрөл','id'=>'type','required'=>true,'option'=>$content_type_options])
			</div>
			<div class="col-md-2">
				@include('modules.form.formgroup',['type'=>'select','label'=>'Ангилал','id'=>'category_id','required'=>true,'option'=>$categories])
			</div>
		</div>
		@include('modules.form.formgroup',['type'=>'text','label'=>'Тайлбар','id'=>'description'])
		@include('modules.form.formgroup',['type'=>'textarea','label'=>'Товчлол','id'=>'summary'])
		@include('modules.form.formgroup',['type'=>'textarea','label'=>'Агуулга','id'=>'content','cke'=>true,'required'=>true])
		
	@endif
	{!! Form::submit('Хадгалах',['class'=>'btn btn-default']) !!}
{!! Form::close() !!}