@extends('layouts.default')
@section('header')
<!-- TODO Show content detail based on $content->showdetail -->
	@if($content->type == 1)
		
	@else
		Бичсэн {{{$content->author->firstname}}} {{{$content->author->lastname}}} | Огноо {{{$content->updated_at->format('Y/m/d')}}}
		<hr>
	@endif
@endsection

@section('content')
	{!!$content->content!!}
@endsection