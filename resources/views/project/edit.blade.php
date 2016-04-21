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
				
				<div class="projectteammemberscontainer" data-teamleader="{{{$project->user_id}}}">
					<h3>Төслийн гишүүд</h3>
					{!! Form::hidden('team_members',$project->team_members,['class'=>'team_members']) !!}
					<div class="projectteammemberslist">
						@include('modules.user.list',['users'=>$project->team,'remove'=>true])
					</div>
					<div class="projectteammembersadd">
						<button type="button" class="btn btn-primary" data-action="addTeamMemberModal"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Гишүүн нэмэх</button>
					</div>
				</div>
				
				<div class="projectgoalscontainer">
					<h3>Төслийн Зорилтууд</h3>
					{!! Form::hidden('step','goals',['class'=>'goals']) !!}
					<div class="projectgoalslist">
						<?php //var_dump($project->goal);?>
						@include('modules.project.goal_list',['goals'=>$project->goal,'remove'=>true])
					</div>
					<div class="projectgoalsadd">
						<button type="button" class="btn btn-primary" data-action="addGoalModal"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Зорилт нэмэх</button>
					</div>
				</div>
				
				<div class="projectrewardscontainer">
					{!! Form::hidden('step','rewards',['class'=>'rewards']) !!}
					<ul class="projectrewardslist">
					</ul>
					<div class="projectrewardsadd">
					</div>
				</div>
				
				
				@include('modules.upload.uploaditem',['id'=>'image','label'=>'Төслийн толгой зураг','view'=>'create','old'=>$project->image])
				@include('modules.form.formgroup',['type'=>'text','label'=>'Видео','id'=>'video','required'=>'required','note'=>'Youtube болон Vimeo дэмжинэ.','old'=>$project->video])
				@include('modules.form.formgroup',['type'=>'text','label'=>'Төслийн товч','id'=>'intro','required'=>'required','old'=>$project->intro])
				@include('modules.form.formgroup',['type'=>'textarea','label'=>'Төслийн дэлгэрэнгүй танилцуулга','id'=>'detail','required'=>'required','cke'=>true,'old'=>$project->detail])
				
				{!! Form::hidden('step','addprojectdetail',['class'=>'step']) !!}
				{!! Form::hidden('id',$project->id,['id'=>'id','class'=>'project_id']) !!}
				{!! Form::submit('Хадгалах',['class'=>'btn btn-default next']) !!}
				
			</div>
		{!! Form::close() !!}
	</div>
@endsection