<div class="progressbar">
	<div class="progress">
	  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{{$p->percentage}}}"
	  aria-valuemin="0" aria-valuemax="100" style="width:{{{$p->percentage}}}%">
	  </div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<b>{{{$p->percentage}}}%</b>
			<br>
			{{trans('project.percentage')}} 
		</div>
		<div class="col-md-5">
			<b>{{{number_format($p->totalpayment)}}} {{trans('messages.currencysymbol')}}</b>
			<br>
			{{trans('project.totalpayment')}} 
		</div>
		<div class="col-md-4">
			<b>{{{$p->daysleft}}}</b>
			<br>
			{{trans('project.daysleft')}} 
		</div>
	</div>
</div>