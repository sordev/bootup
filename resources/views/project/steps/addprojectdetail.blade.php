{!! Form::open(array('url'=>'project/update','method'=>'post','class'=>'')) !!}
	<div class="projectstepcontainer row">
		<div class="col-md-12">
		Төслийн нэр: {{{$project->title}}} | Төслийн ангилал @include('modules.categories.list',['categories'=>$project->categories]) | Төслийн хаяг <a href="{{{$project->url}}}" target="_blank">{{{$project->url}}}</a>
		<hr>
		</div>
		<div class="col-md-12">
		Төслөө оруулахаар санаа шулуудсан танд амжилт хүсье. Талбар бүрийн анхааран уншиж мэдээллээ оруулаарай. Нэг дор оруулах гэж яарах хэрэггүй. Бүх зүйлээ маш сайн хянаж хийгээрэй. Нэгэнт төслийн бүх мэдээлэл тодорхой болсны дараа төслийг хянаж үзээд идэвхижүүлэх ба <b>нэгэнт идэвхижсэн төслийн зорилтууд болон урамшуулалд засвар хийх боломжгүй болно</b>.
		</div>
		
		
		<div class="col-md-4 projectteammemberscontainer" data-teamleader="{{{$project->user_id}}}">
			<h3>Төслийн гишүүд</h3>
			<p class="help-block">Нэгэнт бусдаас дэмжлэг хүсч байгаа юм чинь өөрийгөө болон багийн гишүүдээ хэн бэ. Ямар мэдлэг чадвартай юу хийж чадах хүмүүс вэ гэдгээ харуулах хэрэгтэй. Мэдээж хэрэг өөрийн жинхэнэ зураг мэдээлэл танилцуулга. Шаардлагатай бол фэйсбүүк, твиттер, линкдн хаягуудаа ч оруулаад өгөхөд буруудахгүй. Танай багийн гишүүдээс бүх зүйл шалтгаална.</p>
			{!! Form::hidden('team_members',$project->team_members,['class'=>'team_members']) !!}
			
			<div class="projectteammembersadd">
				<button type="button" class="btn btn-primary" data-action="addTeamMemberModal"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Гишүүн нэмэх</button>
			</div>
			
			<div class="projectteammemberslist">
				@include('modules.user.list',['users'=>$project->team,'remove'=>true])
			</div>
			
		</div>
		
		<div class="col-md-4 projectgoalscontainer">
			<h3>Төслийн Зорилтууд</h3>
			<p class="help-block">Зорилтууд нь төслийн амин чухал зүйл юм. Төслийн цаг хугацаатай үнэлэмжтэй зорилтууд дээр үндэслэн танд болон танай багт хүмүүс итгэл хүлээлгэх эсэхээ шийднэ. Тэгэхээр зорилтоо аль болох ойлгомжтой цаг хугацаатай хийгээр. Зорилтуудын нийт зардал нийлээд танай төслийн нийт зардал гарах ба эхний зорилтын хугацаа нь танай төслийн эхлэл хугацааг заана.</p>
			@if($project->status == 0)
			<div class="projectgoalsadd">
				<button type="button" class="btn btn-primary" data-action="addGoalModal"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Зорилт нэмэх</button>
			</div>
			<div class="projectgoalslist">
				@include('modules.project.goal_list',['goals'=>$project->goal,'remove'=>true])
			</div>
			@else
				<div class="projectgoalslist">
					@include('modules.project.goal_list',['goals'=>$project->goal,'remove'=>false])
				</div>
			@endif
		</div>
		
		<div class="col-md-4 projectrewardscontainer">
			<h3>Төслийн Урамшууллууд</h3>
			<p class="help-block">Урамшууллууд нь заавал байх албагүй боловч, таны төслийг дэмжиснээр бусдад ямар үр ашигтай вэ гэдгээ харуулах юм. Жишээ нь та тоглоом хийж байвал хийж дуусаад тоглоомоо өгөх, Загвар хийж байвал хийж дуусаад загвараа өгөх. Эсвэл хийсэн бүтээлийнхээ дэмжигчдийн хүндэт самбарт залах гэх мэт яаж ч ашиглаж болно. Бүр хувьцаагаа ч өгсөн болно шүү дээ.</p>
			@if($project->status == 0)
			<div class="projectrewardsadd">
				<button type="button" class="btn btn-primary" data-action="addRewardModal"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left" aria-hidden="true"></span> Урамшуулал нэмэх</button>
			</div>
			<div class="projectrewardslist">
				@include('modules.project.reward_list',['rewards'=>$project->reward,'remove'=>true])
			</div>
			@else
			<div class="projectrewardslist">
				@include('modules.project.reward_list',['rewards'=>$project->reward,'remove'=>false])
			</div>
			@endif
			
		</div>
		<div class="col-md-12">
		<hr>
		<h3>Төслийн ерөнхий зураг</h3>
		@include('modules.upload.uploaditem',['id'=>'image','label'=>'Төслийн толгой зураг','view'=>'create','old'=>$project->image,'type'=>'project'])
		@include('modules.form.formgroup',['data'=>$project,'type'=>'text','label'=>'Видео','id'=>'video','note'=>'Youtube болон Vimeo дэмжинэ. Энэ видеог заавал хийхийг шаардах бөгөөд хамгийн чухал зүйл бол видео юм.'])
		@include('modules.form.formgroup',['data'=>$project,'type'=>'text','label'=>'Төслийн товч','id'=>'intro','note'=>'Бусдын анхаарлыг гол татах талбар бөгөөд бүх л газар харагдана. Их биш бага биш сонирхолтой ойлгомжтой байдлаар төслөө танилцуулаарай.'])
		@include('modules.form.formgroup',['data'=>$project,'type'=>'textarea','label'=>'Төслийн дэлгэрэнгүй танилцуулга','id'=>'detail','cke'=>'true'])
		{!! Form::hidden('step','addprojectdetail',['class'=>'step']) !!}
		{!! Form::hidden('id',$project->id,['id'=>'id','class'=>'project_id']) !!}
		{!! Form::submit('Хадгалах',['class'=>'btn btn-default next']) !!}
		</div>
	</div>
{!! Form::close() !!}
