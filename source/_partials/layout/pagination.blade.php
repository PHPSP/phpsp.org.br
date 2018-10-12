<nav class="pagination is-centered" role="navigation" aria-label="pagination">

    @if ($previous = $pagination->previous)
        <a class="pagination-previous" href="{{ $page->baseUrl }}{{ $previous }}">&lt;</a>
    @else
        <a class="pagination-previous" disabled>&lt;</a>
    @endif

    @if ($next = $pagination->next)
        <a class="pagination-next" href="{{ $page->baseUrl }}{{ $next }}">&gt;</a>
    @else
        <a class="pagination-next" disabled>&gt;</a>
    @endif

    <ul class="pagination-list">

        @foreach ($pagination->pages as $pageNumber => $path)
            <li>
                <a class="pagination-link {{ $pagination->currentPage === $pageNumber ? 'is-current' : '' }}"
                   href="{{ $page->baseUrl }}{{ $path }}"
                   aria-label="Goto page {{ $pageNumber }}" {{ $pagination->currentPage === $pageNumber ? 'disabled' : '' }}>{{ $pageNumber }}</a>
            </li>
        @endforeach

    </ul>
</nav>