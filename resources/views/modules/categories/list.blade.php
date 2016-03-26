@if(isset($categories))
	<ul class="project-category-list">
	@foreach ($categories as $c)
		<li>
			<a href="{{{url($c->typeslug.'/category/'.$c->slug)}}}">{{{$c->title}}}</a>
		</li>
	@endforeach 
	</ul>
@endif