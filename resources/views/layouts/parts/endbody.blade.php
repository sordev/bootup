@if(isset($scripts['footer']))
	@foreach($scripts['footer'] as $script)
		@if (!preg_match("~^(?:f|ht)tps?://~i", $script))
			{!! HTML::script(URL::asset('/js/'.$script)) !!}
		@else
			{!! HTML::script(URL::asset($script)) !!}
		@endif
	@endforeach
@endif
@yield('endbody')