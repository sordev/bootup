@extends('layouts.default')
@section('header')
	@include('content.actions')
@endsection

@section('content')
	@include('errors.errors')
	@include('content.filter')
	@if(isset($contents) && !empty($contents))
		<table class="table table-striped">
			<tr><th>ID</th><th>Гарчиг</th><th>Төлөв</th><th>Ангилал</th><th>Төрөл</th><th>Үйлдэл</th></tr>
			@foreach($contents as $c)
			<tr>
				<td>{{{$c->id}}}</td><td>{{{$c->title}}}</td><td>{{{$c->status}}}</td><td>{{{$c->category}}}</td><td>{{{$c->typetitle}}}</td>
				<td>
					<a href="{{{url('admin/content/edit/'.$c->id)}}}">Засах</a> | 
					
					@if($c->trashed())
						<a href="{{{url('admin/content/restore/'.$c->id)}}}">Сэргээх</a> |
					@else
						<a href="{{{url('admin/content/delete/'.$c->id)}}}">Хогийн саванд хийх</a> |
					@endif
					
					<a href="{{{url('admin/content/destroy/'.$c->id)}}}">Устгах</a>
				</td>
			</tr>
			@endforeach
			<tfoot>
				{!! $contents->links() !!}
			</tfoot>
		</table>
	@endif
@endsection