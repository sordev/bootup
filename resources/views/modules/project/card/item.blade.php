<div class="col-md-4">
	<div class="project-card white-box">
		<a href="{{{url('projects/'.$p->slug)}}}" title="{{{$p->title}}}"><img class="project-card-image" src="{{{asset('images/project/medium/'.$p->image)}}}"></a>
		<div class="project-card-description padding-sm">
			<h3 class="project-card-title"><a href="{{{url('projects/'.$p->slug)}}}" title="{{{$p->title}}}">{{{$p->title}}}</a></h3>
			<p>{{{$p->intro}}}</p>
			<div class="project-card-category">#: @include('modules.categories.list',['categories'=>$p->categories])</div>
			@include('modules.project.progressbar',['p'=>$p])
		</div>
	</div>
</div>