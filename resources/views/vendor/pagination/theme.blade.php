@if ($paginator->hasPages())
    <div class="tf-pagination-wrap">
        <ul class="tf-pagination-list" style="flex-wrap:nowrap; list-style:none; padding:0; margin:0;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span class="pagination-link" aria-disabled="true">
                        <i class="icon icon-arrow-left"></i>
                    </span>
                </li>
            @else
                <li>
                    <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="icon icon-arrow-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled">
                        <span class="pagination-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <span class="pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="pagination-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="icon icon-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span class="pagination-link" aria-disabled="true">
                        <i class="icon icon-arrow-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </div>
@endif

