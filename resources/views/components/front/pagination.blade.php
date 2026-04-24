{{--
 * resources/views/components/front/pagination.blade.php
 * Custom pagination links for the front public.
 --}}

@if ($paginator->hasPages())
    <nav class="pagination" aria-label="{{ __('Paginación') }}">
        <ul class="pagination-list">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link" aria-hidden="true">‹</span>
                </li>
            @else
                <li class="pagination-item">
                    <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}"
                        aria-label="{{ __('Página anterior') }}">‹</a>
                </li>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination-item disabled" aria-hidden="true">
                        <span class="pagination-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item active" aria-current="page">
                                <span class="pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a class="pagination-link" href="{{ $url }}"
                                    aria-label="{{ __('Página') }} {{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}"
                        aria-label="{{ __('Página siguiente') }}">›</a>
                </li>
            @else
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link" aria-hidden="true">›</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
