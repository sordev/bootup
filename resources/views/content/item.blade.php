@extends('layouts.default')
@section('header')
	@parent
	@if($content->showinfo == 1)
		Бичсэн {{{$content->author->firstname}}} {{{$content->author->lastname}}} | Огноо {{{$content->updated_at->format('Y/m/d')}}}
		<hr>
	@endif
@endsection

@section('content')
	{!!$content->content!!}
@endsection