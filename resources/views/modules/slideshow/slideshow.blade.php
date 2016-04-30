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
		@include('modules.slideshow.item'.$id,['s'=>$s])
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