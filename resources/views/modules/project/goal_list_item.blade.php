<li data-goalid="{{{$g->id}}}">
	<h4>{{{$g->title}}}</h4>
	<p>{{{$g->description}}}</p>
	<p>Төслийн үе шат: {{{$g->phase}}}</p>
	<p>Шаардагдах хөрөнгө: {{{$g->goal}}}₮</p>
	<p>Эхлэх огноо: {{{$g->start}}} - Дуусах огноо:  {{{$g->end}}}</p>
	@if(isset($remove) && $remove == true)
		<button type="button" class="btn btn-default" data-action="removeGoal" data-goalid="{{{$g->id}}}">
			<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> {{trans('messages.delete')}}
		</button>
	@endif
</li>