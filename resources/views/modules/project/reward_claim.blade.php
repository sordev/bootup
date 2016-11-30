@if(!$user)
	@include('modules.user.login')
	Та урамшууллыг авахаасаа өмнө нэвтрэн орно уу эсвэл <a href="{{{url('user/register')}}}" target="_blank">{{{trans('messages.clickhere')}}}</a> бүртгүүлж болно.
	<hr>
	<h4>Эсвэл бүртгүүлэлгүй урамшууллыг авч болно.</h4>
	{!! Form::open(array('url'=>'user/store','method'=>'post','class'=>'')) !!}
		@include('modules.form.formgroup',['type'=>'text','label'=>'Таны бүтэн нэр','id'=>'fullname',$required='required'])
		@include('modules.form.formgroup',['type'=>'email','label'=>'Имэйл хаяг','id'=>'email',$required='required'])
		@include('modules.form.formgroup',['type'=>'text','label'=>'Утас','id'=>'password',$required='required'])
		<ul class="reward-claim-list">
			<li>
				Таны дэмжиж байгаа төсөл: <a href="{{{$reward->project->url}}}" target="_blank" alt="{{{$reward->project->title}}}">{{{$reward->project->title}}}</a>
					{!! Form::hidden('project_id',$reward->project->id)!!}
			</li>
			<li>
				Таны авч байгаа урамшуулал: <b>{{{$reward->title}}} x 1 (ширхэг)</b>
					{!! Form::hidden('id',$reward->id)!!}
			</li>
			<li>
				<p class="bg-success">Таны төлөх дүн: <b>{{{number_format($reward->value)}}} ₮</b></p>
					{!! Form::hidden('value',$reward->value)!!}
			</li>
		</ul>
		{!! Form::submit('Төлбөр төлөх',['class'=>'btn btn-default','data-action'=>'claimreward']) !!}
	{!! Form::close() !!}
@else
	{!! Form::open(array('url'=>'user/store','method'=>'post','class'=>'')) !!}
		<ul class="reward-claim-list">
			<li>
				Таны дэмжиж байгаа төсөл: <a href="{{{$reward->project->url}}}" target="_blank" alt="{{{$reward->project->title}}}">{{{$reward->project->title}}}</a>
					{!! Form::hidden('project_id',$reward->project->id)!!}
			</li>
			<li>
				Таны авч байгаа урамшуулал: <b>{{{$reward->title}}} x 1 (ширхэг)</b>
					{!! Form::hidden('id',$reward->id)!!}
			</li>
			<li>
				<p class="bg-success">Таны төлөх дүн: <b>{{{number_format($reward->value)}}} ₮</b></p>
					{!! Form::hidden('value',$reward->value)!!}
			</li>
		</ul>
		{!! Form::submit('Төлбөр төлөх',['class'=>'btn btn-default','data-action'=>'claimreward']) !!}
	{!! Form::close() !!}
@endif
