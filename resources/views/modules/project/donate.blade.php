@if(!$user)
	@include('modules.user.login')
	Та хандив өргөхөөсөө өмнө нэвтрэн орно уу эсвэл <a href="{{{url('user/register')}}}" target="_blank">{{{trans('messages.clickhere')}}}</a> бүртгүүлж болно.
	<hr>
	<h4>Эсвэл бүртгүүлэлгүй хандив өргөж болно.</h4>
	{!! Form::open(array('url'=>'user/store','method'=>'post','class'=>'')) !!}
		@include('modules.form.formgroup',['type'=>'text','label'=>'Таны бүтэн нэр','id'=>'fullname',$required='required'])
		@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйл хаяг','id'=>'email',$required='required'])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Утас','id'=>'password',$required='required'])
		<ul class="reward-claim-list">
			<li>
				Таны дэмжиж байгаа төсөл: <a href="{{{$project->url}}}" target="_blank" alt="{{{$project->title}}}">{{{$project->title}}}</a>
					{!! Form::hidden('project_id',$project->id)!!}
			</li>
			<li>
				@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.amount'),'id'=>'amount',$required='required'])
			</li>
		</ul>
		{!! Form::submit('Төлбөр төлөх',['class'=>'btn btn-default','data-action'=>'donate']) !!}
	{!! Form::close() !!}
@else
	{!! Form::open(array('url'=>'user/store','method'=>'post','class'=>'')) !!}
		<ul class="reward-claim-list">
			<li>
				Таны дэмжиж байгаа төсөл: <a href="{{{$project->url}}}" target="_blank" alt="{{{$project->title}}}">{{{$project->title}}}</a>
					{!! Form::hidden('project_id',$project->id)!!}
			</li>
			<li>
				@include('modules.form.formgroup',['type'=>'text','label'=>trans('project.amount'),'id'=>'amount',$required='required'])
			</li>
		</ul>
		{!! Form::submit('Төлбөр төлөх',['class'=>'btn btn-default','data-action'=>'donate']) !!}
	{!! Form::close() !!}
@endif
