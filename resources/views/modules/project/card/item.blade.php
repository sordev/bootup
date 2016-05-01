<div class="col-md-4">
	<div class="project-card white-box">
		@if(isset($edit) && $edit == true)
			<a href="{{{url('project/edit/'.$p->id)}}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Засах</a> 
		@endif
		<a href="{{{url('projects/'.$p->slug)}}}" title="{{{$p->title}}}"><img class="project-card-image" src="{{{asset('images/project/medium/'.$p->image)}}}"></a>
		<div class="project-card-description padding-sm">
			<h3 class="project-card-title"><a href="{{{url('projects/'.$p->slug)}}}" title="{{{$p->title}}}">{{{$p->title}}}</a></h3>
			<p>{{{$p->intro}}}</p>
			<div class="project-card-category">#: @include('modules.categories.list',['categories'=>$p->categories])</div>
			<div class="progress">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{{$p->percentage}}}"
			  aria-valuemin="0" aria-valuemax="100" style="width:{{{$p->percentage}}}%">
			  </div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<b>{{{$p->percentage}}}%</b>
					<br>
					бүрдсэн 
				</div>
				<div class="col-md-4">
					<b>{{{number_format($p->totalpayment)}}} ₮</b>
					<br>
					цуглуулсан
				</div>
				<div class="col-md-4">
					<b>{{{$p->daysleft}}}</b>
					<br>
					хоног үлдсэн
				</div>
			</div>
		</div>
	</div>
</div>