<div class="step-addproject">
	<h3>Төсөл Бүртгүүлэх</h3>
	<p class="alert alert-info">Доорхи талбаруудыг дараа өөрчлөх боломжгүй тул та сайн бодолцож байж бөглөнө үү. </p>
	@include('modules.form.formgroup',['type'=>'text','label'=>'Төслийн нэр','id'=>'title',$required='required'])
	@include('modules.form.formgroup',['type'=>'select','label'=>'Төслийн ангилал','id'=>'category_ids',$required='required','option'=>$categories])
	@include('modules.form.formgroup',['type'=>'text','label'=>'Төслийн хаяг','id'=>'slug',$required='required','option'=>$categories,'note'=>'Хаяг тань дараах байдлаар харагдана http://bootup.mn/projects/ТАНЫСОНГОСОНХАЯГ'])
	{!! Form::hidden('step','addproject',['class'=>'step']) !!}
	{!! Form::submit('Бүртгүүлэх',['class'=>'btn btn-default next']) !!}
</div>