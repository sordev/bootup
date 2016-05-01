@if(isset($categories))
	<ul class="project-category-list">
	@foreach ($categories as $c)
		<li>
			<a href="{{{$c->url}}}">{{{$c->title}}}</a>
		</li>
	@endforeach 
	</ul>
@endif