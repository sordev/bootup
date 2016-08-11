<!DOCTYPE html>
<html>
	@include('layouts.parts.head')
    <body>
		@include('layouts.parts.beginbody')
		@if (isset($navigations) && isset($navigations['super']))
			@include('modules.navigations.supernav')
		@endif
		@if(isset($slideshow))
			@include('modules.slideshow.slideshow',['slideshow'=>$slideshow,'id'=>'homepage'])
		@else
			<div class="navpadding">
			</div>
		@endif
		<div class="container">
			@section('header')
				@include('layouts.parts.header')
			@show
		</div>
		<div class="container">
			@yield('content')
		</div>
		@include('layouts.parts.footer')
		@include('layouts.parts.endbody')
    </body>
</html>