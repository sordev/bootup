<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	@if(isset($metas))
		<meta name="description" content="{{$metas['description']}}">
		<meta name="keywords" content="{{$metas['keywords']}}">
		<meta name="author" content="{{$metas['author']}}">
			@if(isset($settings) && $settings['live'] == '0')
				<meta name="robots" content="noindex, nofollow">
			@else
				<meta name="robots" content="index, follow">
			@endif
		<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
		<link rel="apple-touch-icon" href="{{asset('assets/images/apple-touch-icon-57.png')}}" />
		<link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/apple-touch-icon-72.png')}}" />
		<link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/apple-touch-icon-114.png')}}" />
		<link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/apple-touch-icon-144.png')}}" />
		<title>{{$metas['title']}}</title>
	@endif

	@if(isset($styles))
		@foreach($styles as $style)
		{!! HTML::style(URL::asset('/css/'.$style)) !!}
		@endforeach
	@else
		<link media="all" type="text/css" rel="stylesheet" href="http://bootup.local/css/app.css">
		<link media="all" type="text/css" rel="stylesheet" href="http://bootup.local/css/main.css">
	@endif

	@if(isset($scripts['header']))
		@foreach($scripts['header'] as $script)
			@if (!preg_match("~^(?:f|ht)tps?://~i", $script))
				{!! HTML::script(URL::asset('/js/'.$script)) !!}
			@else
				{!! HTML::script(URL::asset($script)) !!}
			@endif
		@endforeach
	@endif
	
	@if(isset($recaptchakey))
		<script>
			var recaptchakey = '{!!$recaptchakey!!}';
		</script>
	@endif

	@yield('head')
</head>