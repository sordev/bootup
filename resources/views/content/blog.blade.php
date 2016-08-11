@extends('layouts.defaultaside')
@section('header')
	@parent
@endsection

@section('aside')
	@include('errors.errors')
	@if(isset($categories) && !empty($categories))
		{!! Form::open(array('url'=>'blog/search','method'=>'get','class'=>'navbar-form navbar-right')) !!}
			<div class="form-group">
				{!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>trans('blog.blog')]) !!}
			</div>
			<button type="submit" class="btn btn-default">{{trans('messages.search')}}</button>
		{!! Form::close() !!}
		<ul class="nav nav-pills nav-stacked">
		@foreach($categories as $c)
			<li >
				<a href="{{$c->url}}" >{{$c->title}}</a>
			</li>
		@endforeach
		</ul>
		
	@endif
@endsection

@section('content')
	@include('errors.errors')
	@if(isset($blogs) && !empty($blogs))
		@foreach($blogs as $content)
			<article>
			<h2><a href="{{$content->url}}">{{{$content->title}}}</a></h2>
			<div><small>{{trans('blog.author')}} {{{$content->author->firstname}}} {{{$content->author->lastname}}} | {{trans('messages.date')}} {{{$content->updated_at->format('Y/m/d')}}}</small></div>
			
			{{{$content->summary}}}
			</article>
			<hr>
		@endforeach
		{!! $blogs->links() !!}
	@endif
@endsection