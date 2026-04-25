<form method="GET" action="{{ $action }}"
    {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row gap-3 mb-4']) }}>

    {{-- Mantiene el 'sort' y 'direction' cuando haces una búsqueda --}}
    @foreach (collect(request()->query())->except(['search', 'page']) as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    {{-- Buscador automático --}}
    <label class="input input-bordered flex items-center gap-2 flex-1">
        <i class="icofont-search-1 opacity-50"></i>
        <input type="search" name="search" value="{{ request('search') }}" placeholder="{{ $searchPlaceholder }}"
            class="grow" />
    </label>

    {{-- Aquí aparecerá el select de roles que pongas en la vista --}}
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @endif

    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ $action }}" class="btn btn-ghost">Limpiar</a>
    </div>
</form>
