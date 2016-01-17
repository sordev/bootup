<li><a href="{{{$item['url']}}}"
@if(isset($item['attributes']))
	@foreach($item['attributes'] as $k => $a)
	{{{$k}}}="{{{$a}}}"
	@endforeach
@endif
>{{{$item['title']}}}</a></li>