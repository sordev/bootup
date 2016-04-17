@extends('layouts.default')
@section('header')
	<p>Төслийн мэдээллээ засварлах.</p>
@endsection

@section('content')
	@include('errors.errors')
	<div class="well well-lg projectsteps">
		{!! Form::open(array('url'=>'/','method'=>'post','class'=>'')) !!}
			<div class="projectstepcontainer">
				<div>Төслийн нэр: {{{$project->title}}} | Төслийн ангилал @include('modules.categories.list',['categories'=>$project->categories]) | Төслийн хаяг http://bootup.mn/projects/{{{$project->slug}}}</div>
				
				<div class="projectteammemberscontainer">
					<h3>Төслийн гишүүд</h3>
					{!! Form::hidden('team_members','team_members',['class'=>'team_members']) !!}
					<ul class="projectteammemberslist">
						@include('modules.user.list',['users'=>$project->team,'remove'=>true])
					</ul>
					<div class="projectteammembersadd">
						<button type="button" class="btn btn-primary" data-action="addTeamMember"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Гишүүн нэмэх</button>
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
		{!! Form::close() !!}
	</div>
@endsection