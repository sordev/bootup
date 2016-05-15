{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
	@if(isset($reply_id) && !empty($reply_id))
		{!! Form::hidden('reply_id',$reply_id) !!}
	@endif
	{!! Form::hidden('type',$type) !!}
	{!! Form::hidden('item_id',$item_id) !!}
	@include('modules.form.formgroup',['type'=>'textarea','label'=>trans('comment.add'),'id'=>'comment','required'=>true])
	<button class="btn btn-default" data-action="addComment" type="button">{{trans('comment.add')}}</button>
{!! Form::close() !!}