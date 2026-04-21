@if ($paginator->hasPages())
    <nav class="dresses-pagination" role="navigation" aria-label="Dresses pagination">
        <span class="dresses-pagination-meta">
            Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
        </span>

        <div class="dresses-pagination-links">
            @if ($paginator->onFirstPage())
                <span class="dresses-pagination-link is-disabled" aria-disabled="true" aria-label="Previous page">
                    Prev
                </span>
            @else
                <a class="dresses-pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">
                    Prev
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="dresses-pagination-ellipsis" aria-disabled="true">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="dresses-pagination-link is-active" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="dresses-pagination-link" href="{{ $url }}" aria-label="Go to page {{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a class="dresses-pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">
                    Next
                </a>
            @else
                <span class="dresses-pagination-link is-disabled" aria-disabled="true" aria-label="Next page">
                    Next
                </span>
            @endif
        </div>
    </nav>
@endif
