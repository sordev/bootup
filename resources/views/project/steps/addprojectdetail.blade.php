<div class="step-addprojectdetail">
	<h3>Төслийн Дэлгэрэнгүй</h3>
	<div>Төслийн нэр: {{{$project->title}}} | Төслийн ангилал {{{$project->category}}}</div>
	<div class="projectteammemberscontainer">
		{!! Form::hidden('team_members','team_members',['class'=>'team_members']) !!}
		<ul class="projectteammemberslist">
		</ul>
		<div class="projectteammembersadd">
		</div>
	</div>
	
	@include('modules.upload.uploaditem',['id'=>'image','label'=>'Төслийн толгой зураг','view'=>'create'])
	@include('modules.form.formgroup',['type'=>'text','label'=>'Видео','id'=>'video','required'=>'required','note'=>'Youtube болон Vimeo дэмжинэ.'])
	@include('modules.form.formgroup',['type'=>'text','label'=>'Төслийн товч','id'=>'intro','required'=>'required'])
	@include('modules.form.formgroup',['type'=>'textarea','label'=>'Төслийн дэлгэрэнгүй танилцуулга','id'=>'detail','required'=>'required','cke'=>true])
	
	<div class="projectgoalscontainer">
		{!! Form::hidden('step','goals',['class'=>'goals']) !!}
		<ul class="projectgoalslist">
		</ul>
		<div class="projectgoalsadd">
		</div>
	</div>
	
	<div class="projectrewardscontainer">
		{!! Form::hidden('step','rewards',['class'=>'rewards']) !!}
		<ul class="projectrewardslist">
		</ul>
		<div class="projectrewardsadd">
		</div>
	</div>
	
	{!! Form::hidden('step','addprojectdetail',['class'=>'step']) !!}
	{!! Form::hidden('id',$project->id) !!}
	{!! Form::submit('Хадгалах',['class'=>'btn btn-default next']) !!}
</div>