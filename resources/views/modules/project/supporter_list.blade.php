{{{trans('project.supporters')}}} {{count($project->completedpayment)}}
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>{{trans('messages.fullname')}}</th>
			<th>{{trans('project.reward')}}</th>
			<th>{{trans('messages.value')}}</th>
			<th>{{trans('messages.date')}}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($project->completedpayment as $p)
			<tr>
				<td>
					{{$p->id}}
				</td>
				<td>
					{{$p->user->fullname}}
				</td>
				<td>
					@if($p->reward)
					{{{$p->reward->title}}}
					@else
					{{trans('messages.donation')}}
					@endif
				</td>
				<td>
					{{number_format($p->value)}} {{trans('messages.currencysymbol')}}
				</td>
				<td>
					{{$p->updated_at->format('Y-m-d')}}
				</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="9">
			</td>
		</tr>
	</tfoot>
</table>