<div class="comment-container">
	<h2>{{trans('comment.comments')}}</h2>
	<div class="comment-add">
		@if(Auth::user())
		{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
			{!! Form::hidden('type',$type) !!}
			{!! Form::hidden('item_id',$item_id) !!}
			<div class="btn btn-default" data-action="addCommentModal">
				{{trans('comment.add')}}
			</div>
		{!! Form::close() !!}
		@else
			{{trans('comment.notauthorized')}}
		@endif
	</div>
	@if(isset($comments) && !empty($comments))
		<ul class="list-unstyled comment-list">
			@foreach($comments as $comment)
				@include('modules.comment.item',['comment'=>$comment])
			@endforeach
		</ul>
	@else
		<div class="alert alert-warning" role="alert">{{trans('comment.notfound')}}</div>
	@endif
</div>
