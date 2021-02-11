@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="hide"><span>&larr;</span></li>
        @else
         <li class="page-item">
      <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
          
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                        @if ($paginator->currentPage() > 4 && $page === 2)
                         <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
                        @endif
                        @if ($page == $paginator->currentPage())
                         <li class="page-item active" aria-current="page">
      <a class="page-link" href="#">{{ $page }}</a>
    </li>
                        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                         <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                           
                        @endif
                        @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                             <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">...</a>
    </li>
                        @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
        <li class="page-item">
      <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
            
        @else
            <li class="hide"><span>&rarr;</span></li>
        @endif
    </ul>
    </nav>
@endif
