<div class="item @if($k==0) active @endif()">
  <img src="{{{$s['slide']}}}" alt="{{{$s['title']}}}">
  <div class="carousel-caption">
	<h2>{{{$s['title']}}}</h2>
	<hr>
	@if(isset($s['desc']))
		<p>{!!$s['desc']!!}</p>
	@endif
	<a href="{{{$s['url']}}}" class="btn btn-default">{{{$s['cta']}}}</a>
	<br>
	<br>
	<br>
  </div>
</div>