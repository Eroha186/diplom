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
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a  class="link-paginate" href="{{ $url }}">{{ $page }}</a></li>
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
