@extends('layouts.default')
@section('header')
	@parent
	@include('content.actions')
@endsection

@section('content')
	@include('errors.errors')
	@include('content.filter')
	@if(isset($contents) && !empty($contents))
		<table class="table table-striped">
			<tr><th>ID</th><th>{{trans('messages.title')}}</th><th>{{trans('messages.status')}}</th><th>{{trans('messages.category')}}</th><th>{{trans('messages.type')}}</th><th>{{trans('messages.actions')}}</th></tr>
			@foreach($contents as $c)
			<tr>
				<td>{{{$c->id}}}</td><td><a href="{{{$c->url}}}">{{{$c->title}}}</a></td><td>{{{$c->status}}}</td><td>{{{$c->category->title}}}</td><td>{{{$c->contenttype->title}}}</td>
				<td>
					<a href="{{{url('admin/content/edit/'.$c->id)}}}">{{trans('messages.edit')}}</a> | 
					
					@if($c->trashed())
						<a href="{{{url('admin/content/restore/'.$c->id)}}}">{{trans('messages.restore')}}</a> |
					@else
						<a href="{{{url('admin/content/delete/'.$c->id)}}}">{{trans('messages.trash')}}</a> |
					@endif
					
					<a href="{{{url('admin/content/destroy/'.$c->id)}}}">{{trans('messages.destroy')}}</a>
				</td>
			</tr>
			@endforeach
			<tfoot>
				{!! $contents->links() !!}
			</tfoot>
		</table>
	@endif
@endsection