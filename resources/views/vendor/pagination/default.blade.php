@if ($paginator->hasPages())
    <ul class="wg-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="javascript:void(0);" class="pagination-link animate-hover-btn"><span aria-hidden="true" class="icon icon-arrow-left"></span></a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" disabled="true" rel="prev" class="pagination-link animate-hover-btn" aria-label="@lang('pagination.previous')"><span aria-hidden="true" class="icon icon-arrow-left"></span></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span class="pagination-link">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" class="pagination-link animate-hover-btn">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link animate-hover-btn" rel="next" aria-label="@lang('pagination.next')"><span class="icon icon-arrow-right"></span></a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="javascript:void(0);" class="pagination-link animate-hover-btn"><span aria-hidden="true" class="icon icon-arrow-right"></span></a>
            </li>
        @endif
    </ul>
@endif
