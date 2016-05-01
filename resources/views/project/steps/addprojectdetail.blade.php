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
			<div class="projectgoalslist">
				@include('modules.project.goal_list',['goals'=>$project->goal,'remove'=>true])
			</div>
			<div class="projectgoalsadd">
				<button type="button" class="btn btn-primary" data-action="addGoalModal"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Зорилт нэмэх</button>
			</div>
		</div>
		
		<div class="projectrewardscontainer">
			<h3>Төслийн Урамшууллууд</h3>
			<div class="projectrewardslist">
				@include('modules.project.reward_list',['rewards'=>$project->reward,'remove'=>true])
			</div>
			<div class="projectrewardsadd">
				<button type="button" class="btn btn-primary" data-action="addRewardModal"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Урамшуулал нэмэх</button>
			</div>
		</div>
		
		<h3>Төслийн ерөнхий зураг</h3>
		@include('modules.upload.uploaditem',['id'=>'image','label'=>'Төслийн толгой зураг','view'=>'create','old'=>$project->image])
		@include('modules.form.formgroup',['data'=>$project,'type'=>'text','label'=>'Видео','id'=>'video','required'=>'required','note'=>'Youtube болон Vimeo дэмжинэ.'])
		@include('modules.form.formgroup',['data'=>$project,'type'=>'text','label'=>'Төслийн товч','id'=>'intro','required'=>'required'])
		@include('modules.form.formgroup',['data'=>$project,'type'=>'textarea','label'=>'Төслийн дэлгэрэнгүй танилцуулга','id'=>'detail','required'=>'required','cke'=>true])
		
		{!! Form::hidden('step','addprojectdetail',['class'=>'step']) !!}
		{!! Form::hidden('id',$project->id,['id'=>'id','class'=>'project_id']) !!}
		{!! Form::submit('Хадгалах',['class'=>'btn btn-default next']) !!}
		
	</div>
{!! Form::close() !!}
