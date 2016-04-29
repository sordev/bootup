{!! Form::open(array('url'=>'admin/content','method'=>'get','class'=>'form-inline')) !!}
	
		@include('modules.form.formgroup',['type'=>'text','label'=>'Гарчиг','id'=>'title'])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Төрөл','id'=>'type','option'=>$content_type_options])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Ангилал','id'=>'category_id','option'=>$categories])
		@include('modules.form.formgroup',['type'=>'select','label'=>'Төлөв','id'=>'status','option'=>['publish'=>'Идэвхитэй','draft'=>'Ноорог','trashed'=>'Хогийн саванд']])
	<button type="submit" class="btn btn-default">Хайх</button>
{!! Form::close() !!}
<hr>