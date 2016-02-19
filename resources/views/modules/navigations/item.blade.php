<li><a href="{{{$item['url']}}}"

@if(isset($item['child']))
	data-toggle="dropdown"
	aria-haspopup="true"
	aria-expanded="false"
@endif

@if(isset($item['attributes']))
	@foreach($item['attributes'] as $k => $a)
		@if ($k=='class')
			{$a = $a.' dropdown-toggle'}
		@endif
	{{{$k}}}="{{{$a}}}"
	@endforeach
@endif
>
{{{$item['title']}}}
@if(isset($item['child']))
	<span class="caret"></span>
@endif
</a>
	@if(isset($item['child']))
		<ul class="dropdown-menu">
			@foreach($item['child'] as $c)
				@include('modules.navigations.item',['item'=>$c])
			@endforeach
		</ul>
	@endif
</li>