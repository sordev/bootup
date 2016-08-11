<li class="comment clearfix">
	@if($comment->user && $comment->user->avatar)
		<img src="{{{asset('images/avatar/thumbnail/'.$comment->user->avatar)}}}" class="thumbnail pull-left" />
	@endif
	<div class="pull-left padding-sm">
		<a target="_blank" href="{{{$comment->user->url}}}" title="{{{$comment->user->fullname}}}">{{{$comment->user->fullname}}}</a>
		<div class="comment">
			{{{$comment->comment}}}
		</div>
		@if(Auth::user())
			{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
				<div class="btn btn-default" data-action="replyCommentModal" data-replyid="{{{$comment->id}}}">
					{{trans('comment.reply')}}
				</div>
				{!! Form::hidden('type',$type) !!}
				{!! Form::hidden('item_id',$item_id) !!}
				@if(Auth::user() && Auth::user()->id == $comment->user->id)
					<div class="btn btn-default" data-action="deleteComment" data-id="{{{$comment->id}}}">
						{{trans('comment.delete')}}
					</div>
				@endif
			{!! Form::close() !!}
		@endif
	</div>
	<div class="comment-reply clearfix" id="comment-reply-{{{$comment->id}}}">
		<ul class="list-unstyled comment-list">
			@if(isset($comment->reply) && !empty($comment->reply))
				@foreach($comment->reply as $reply)
					@include('modules.comment.item',['comment'=>$reply])
				@endforeach
			@endif
		</ul>
	</div>
</li>