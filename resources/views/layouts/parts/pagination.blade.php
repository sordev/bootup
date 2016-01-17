@if ($pagination->lastPage() > 1)
<div class="ui pagination menu">
    <a href="{{ $pagination->url(1) }}" class="item{{ ($pagination->currentPage() == 1) ? ' disabled' : '' }}">
        Previous
    </a>
    @for ($i = 1; $i <= $pagination->lastPage(); $i++)
		<a class=" item{{ ($pagination->currentPage() == $i) ? ' active' : '' }}" href="{{ $pagination->url($i) }}">{{ $i }}</a>
    @endfor
	<a href="{{ $pagination->url($pagination->currentPage()+1) }}" class=" item{{ ($pagination->currentPage() == $pagination->lastPage()) ? ' disabled' : '' }}">Next</a>
</div>
@endif