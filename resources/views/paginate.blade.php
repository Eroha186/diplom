@if ($paginator->hasPages())
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="hide"><span>&larr;</span></li>
        @else
            <li><a class="link-paginate" href="{{ $paginator->previousPageUrl() }}" rel="prev">&larr;</a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                        @if ($paginator->currentPage() > 4 && $page === 2)
                            <li class="disabled"><span>...</span></li>
                        @endif
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                            <li><a class="link-paginate" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                        @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                            <li class="disabled"><span>...</span></li>
                        @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li><a class="link-paginate" href="{{ $paginator->nextPageUrl() }}" rel="next">&rarr;</a></li>
        @else
            <li class="hide"><span>&rarr;</span></li>
        @endif
    </ul>
@endif
