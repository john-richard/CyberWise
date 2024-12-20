@if ($paginator->hasPages())
    <ul class="pagination pagination-sm pagination-circle justify-content-center mb-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link has-icon"><i class="material-icons">Previous</i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link has-icon" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="material-icons">Previous</i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link has-icon" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="material-icons">Next</i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link has-icon"><i class="material-icons">Next</i></span>
            </li>
        @endif
    </ul>
@endif
