@extends('layouts.default')
@section('header')
	@parent
	<a href="{{{url('project/update/create')}}}" class="btn btn-default">{{trans('messages.add')}}</a>
	<hr>
@endsection
@section('content')
	@include('errors.errors')
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>{{{trans('messages.title')}}}</th>
				<th>{{{trans('messages.status')}}}</th>
				<th>{{{trans('messages.intro')}}}</th>
				<th>{{{trans('messages.actions')}}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($contents as $content)
				<tr>
					<td>
						{{$content->id}}
					</td>
					<td>
						<a href="{{$content->url}}" target="_blank">{{$content->title}}</a>
					</td>
					<td>
						{{$content->status}}
					</td>
					<td>
						{{$content->summary}}
					</td>
					<td>
						<a href="{{{url('project/update/edit/'.$content->id)}}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> {{{trans('messages.edit')}}}</a> 
						<br>
						<a href="{{{url('project/update/delete/'.$content->id)}}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> {{{trans('messages.delete')}}}</a>
						<br>
					</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9">
					{!! $contents->links() !!}
				</td>
			</tr>
		</tfoot>
	</table>
@endsection