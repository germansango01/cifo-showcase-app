@props(['action', 'searchPlaceholder'])

<form method="GET" action="{{ $action }}"
    {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row gap-3 mb-4']) }}>

    {{-- Preserve current query params (sort, direction, per_page, etc.) --}}
    @foreach ($preserved() as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    {{-- Search input --}}
    <label class="input input-bordered flex items-center gap-2 flex-1">
        <i class="icofont-search-1 opacity-50"></i>
        <input type="search" name="search" value="{{ request('search') }}" placeholder="{{ $searchPlaceholder }}"
            class="grow" autocomplete="off" />
    </label>

    {{-- Additional filters slot --}}
    @if ($slot->isNotEmpty())
        <div class="flex flex-wrap gap-2 items-center">
            {{ $slot }}
        </div>
    @endif

    {{-- Actions --}}
    <div class="flex gap-2 shrink-0">
        <button type="submit" class="btn btn-primary btn-md gap-2">
            <i class="icofont-filter"></i>
            Filtrar
        </button>

        @if (request()->hasAny(['search', 'sort', 'direction']) || ($slot->isNotEmpty() && request()->query()))
            <a href="{{ $action }}" class="btn btn-ghost btn-md gap-2" aria-label="Limpiar filtros">
                <i class="icofont-close-circled"></i>
                Limpiar
            </a>
        @endif
    </div>

</form>
