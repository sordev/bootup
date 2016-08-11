<tr>
	<td>
		{{{$p->id}}}
	</td>
	<td>
		<a target="_blank" href="{{{$p->url}}}">{{{$p->title}}}</a>
		<br>
		<i><small>{{trans('messages.url')}}: {{{$p->url}}}</small></i>
		<br>
		<i><small>{{trans('messages.categories')}}: @include('modules.categories.list',['categories'=>$p->categories])</small></i>
		<br>
		@if($p->status > 0)
			@include('modules.project.progressbar',['p'=>$p])
		@endif
	</td>
	<td class="text-center">
		{{{$p->statustext}}}
		@if(isset($user) && $user->role == 1)
			<br>
			<a href="{{{url('project/enable/'.$p->id)}}}"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> {{{trans('messages.enable')}}}</a>
			<br>
			<a href="{{{url('project/disable/'.$p->id)}}}"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> {{{trans('messages.disable')}}}</a> 
			<br>
			<a href="{{{url('project/lock/'.$p->id)}}}"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> {{{trans('messages.lock')}}}</a> 
		@endif
	</td>
	<td class="text-center">
		@if(!empty($p->image))
			<span class="success glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
		@else
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
		@endif
	</td>
	<td class="text-center">
		@if(!empty($p->video))
			<span class="success glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
		@else
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
		@endif
	</td>
	<td class="text-center">
		@if(!empty($p->intro))
			<span class="success glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
		@else
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
		@endif
	</td>
	<td class="text-center">
		@if(!empty($p->detail))
			<span class="success glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
		@else
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
		@endif
	</td>
	<td class="text-center">
		@if(!empty($p->goal()->exists()))
			<span class="success glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
		@else
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
		@endif
	</td>
	<td>
		<a href="{{{url('project/edit/'.$p->id)}}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> {{{trans('messages.edit')}}}</a> 
		<br>
		<a href="{{{url('project/delete/'.$p->id)}}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> {{{trans('messages.delete')}}}</a>
		<br>
		<a href="{{{url('project/updates/'.$p->id)}}}" class="btn btn-default">{{{trans('project.updates')}}}</a>
		<br>
		{!! Form::open() !!}
		<a href="{{{url('project/delete/'.$p->id)}}}" class="btn btn-default" data-projectid="{{$p->id}}" data-action="supporterListModal">{{{trans('project.supporters')}}}</a> 
		{!! Form::close() !!}
	</td>
</tr>