{{--@if ($paginator->hasPages())--}}
{{--    <nav>--}}
{{--        <ul class="pagination">--}}
{{--            --}}{{-- Previous Page Link --}}
{{--            @if ($paginator->onFirstPage())--}}
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                    <span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
{{--                </li>--}}
{{--            @endif--}}

{{--            --}}{{-- Pagination Elements --}}
{{--            @foreach ($elements as $element)--}}
{{--                --}}{{-- "Three Dots" Separator --}}
{{--                @if (is_string($element))--}}
{{--                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>--}}
{{--                @endif--}}

{{--                --}}{{-- Array Of Links --}}
{{--                @if (is_array($element))--}}
{{--                    @foreach ($element as $page => $url)--}}
{{--                        @if ($page == $paginator->currentPage())--}}
{{--                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
{{--                        @else--}}
{{--                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            @endforeach--}}

{{--            --}}{{-- Next Page Link --}}
{{--            @if ($paginator->hasMorePages())--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </nav>--}}
{{--@endif--}}

@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Назад</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Назад</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled d-none d-md-block"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- Отображать только текущую, предыдущую и следующую страницы --}}
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @elseif ($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() + 1)
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == 1 || $page == $paginator->lastPage())
                            <li class="page-item d-none d-md-block"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Вперед</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Вперед</span></li>
            @endif
        </ul>
    </nav>
@endif