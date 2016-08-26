<li data-rewardid="{{{$r->id}}}">
	@if($r->image)
		<img src="{{{asset('/images/reward/thumbnail/'.$r->image)}}}" class="img-thumbnail"/>
	@endif
	<h4>{{{$r->title}}}</h4>
	<p>{{{$r->description}}}</p>
	<p>Үнэлгээ: {{{$r->value}}}₮</p>
	<p>Тоо/ширхэг: {{{$r->amount}}}</p>
	<p>Ойролцоогоор бэлэн болох огноо: {{{$r->estimated_date}}}</p>
	@if(isset($remove) && $remove == true)
		<button type="button" class="btn btn-default" data-action="removeReward" data-rewardid="{{{$r->id}}}">
			<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> {{trans('messages.delete')}}
		</button>
	@endif
</li>