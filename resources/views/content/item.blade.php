@extends('layouts.default')
@section('header')
	@parent
	@if($content->showinfo == 1)
		{{trans('blog.author')}} {{{$content->author->firstname}}} {{{$content->author->lastname}}} | {{trans('messages.date')}} {{{$content->updated_at->format('Y/m/d')}}}
		<div>
		Түгээх
		@foreach($content->shares as $s)
			<a href="{{{$s['href']}}}" data-action="share" data-href="{{{$s['href']}}}" class="btn btn-default btn-share btn-{{{$s['class']}}}">{{{$s['class']}}}</a>
		@endforeach
		</div>
		<hr>
	@endif
@endsection

@section('content')
	{!!$content->content!!}
	@if($content->comments == 1)
		@include('modules.comment.list',['comments'=>$content->comment,'type'=>3,'item_id'=>$content->id])
	@endif
@endsection
