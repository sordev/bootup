<div id="carousel-{{{$id}}}" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
	@foreach($slideshow as $k=>$s)
	<li data-target="#carousel-{{{$id}}}" data-slide-to="{{{$k}}}" class="active"></li>
	@endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
	@foreach($slideshow as $k=>$s)
		<div class="item @if($k==0) active @endif()">
		  <img src="{{{$s['slide']}}}" alt="{{{$s['title']}}}">
		  <div class="carousel-caption">
			<h2>{{{$s['title']}}}</h2>
			<a href="{{{$s['url']}}}" class="button button-default">{{{$s['cta']}}}</a>
		  </div>
		</div>
	@endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-{{{$id}}}" role="button" data-slide="prev">
	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-{{{$id}}}" role="button" data-slide="next">
	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
  </a>
</div>