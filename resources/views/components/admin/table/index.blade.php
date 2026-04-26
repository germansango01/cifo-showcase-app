<div {{ $attributes }}>
    {{-- Scroll wrapper --}}
    <div class="overflow-x-auto w-full">
        <table class="table table-zebra w-full">

            {{-- Head --}}
            <thead>
                <tr class="bg-base-200 text-base-content/70 text-xs uppercase tracking-wider">
                    @foreach ($normalizedColumns() as $col)
                        <th class="font-semibold">
                            @if ($col['sortable'] && $col['key'])
                                <a href="{{ $sortUrl($col['key']) }}"
                                    class="inline-flex items-center gap-1 hover:text-primary transition-colors">
                                    {{ $col['label'] }}
                                    <i class="{{ $sortIconClass($col['key']) }} text-sm"></i>
                                </a>
                            @else
                                {{ $col['label'] }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>

            {{-- Body --}}
            <tbody>
                @if ($items->isEmpty())
                    <tr>
                        <td colspan="{{ count($normalizedColumns()) ?: 1 }}" class="p-0 h-64">
                            {{ $empty ??
                                view('components.admin.table.empty', [
                                    'message' => __('admin.common.no_results'),
                                ]) }}
                        </td>
                    </tr>
                @else
                    {{ $slot }}
                @endif
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    @if ($isPaginated() && $items->hasPages())
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-4 py-3 border-t border-base-300">
            <p class="text-sm text-base-content/60">
                Mostrando
                <span class="font-medium">{{ $items->firstItem() }}</span>–<span
                    class="font-medium">{{ $items->lastItem() }}</span>
                de <span class="font-medium">{{ $items->total() }}</span> resultados
            </p>

            <div class="join">
                {{-- Previous --}}
                @if ($items->onFirstPage())
                    <button class="join-item btn btn-sm btn-disabled" disabled aria-label="Página anterior">
                        <i class="icofont-arrow-left"></i>
                    </button>
                @else
                    <a href="{{ $items->previousPageUrl() }}" class="join-item btn btn-sm"
                        aria-label="Página anterior">
                        <i class="icofont-arrow-left"></i>
                    </a>
                @endif

                {{-- Page numbers (window of 5) --}}
                @php
                    $current = $items->currentPage();
                    $last = $items->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $start + 4);
                    $start = max(1, $end - 4);
                @endphp

                @if ($start > 1)
                    <a href="{{ $items->url(1) }}" class="join-item btn btn-sm">1</a>
                    @if ($start > 2)
                        <button class="join-item btn btn-sm btn-disabled" disabled>…</button>
                    @endif
                @endif

                @for ($p = $start; $p <= $end; $p++)
                    <a href="{{ $items->url($p) }}"
                        class="join-item btn btn-sm {{ $p === $current ? 'btn-primary border-2 border-primary-content/30' : '' }}"
                        aria-current="{{ $p === $current ? 'page' : 'false' }}">
                        {{ $p }}
                    </a>
                @endfor

                @if ($end < $last)
                    @if ($end < $last - 1)
                        <button class="join-item btn btn-sm btn-disabled" disabled>…</button>
                    @endif
                    <a href="{{ $items->url($last) }}" class="join-item btn btn-sm">{{ $last }}</a>
                @endif

                {{-- Next --}}
                @if ($items->hasMorePages())
                    <a href="{{ $items->nextPageUrl() }}" class="join-item btn btn-sm" aria-label="Página siguiente">
                        <i class="icofont-arrow-right"></i>
                    </a>
                @else
                    <button class="join-item btn btn-sm btn-disabled" disabled aria-label="Página siguiente">
                        <i class="icofont-arrow-right"></i>
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>
