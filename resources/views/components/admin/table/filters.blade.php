<form method="GET" action="{{ $action }}"
    {{ $attributes->merge(['class' => 'flex flex-col space sm:flex-row justify-between sm:items-end gap-3 mb-4']) }}>

    <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
        {{-- Mantiene el 'sort' y 'direction' cuando haces una búsqueda --}}
        @foreach (collect(request()->query())->except(['search', 'page']) as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        {{-- Buscador automático --}}
        <label class="input input-bordered flex items-center gap-2 mt-1">
            <i class="icofont-search-1 opacity-50"></i>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="{{ $searchPlaceholder }}"
                class="grow" />
        </label>

        {{-- Aquí aparecerá el select que pongas en la vista --}}
        @if ($slot->isNotEmpty())
            <div
                class="flex flex-col gap-3 sm:flex-row sm:w-auto [&_.fieldset]:pb-0 [&_.fieldset-label]:hidden sm:[&_.fieldset]:w-50">
                {{ $slot }}
            </div>
        @endif
    </div>

    <div class="flex gap-2 mt-1">
        <button type="submit" class="btn btn-primary">{{ __('admin.common.filter') }}</button>
        <a href="{{ $action }}" class="btn btn-ghost">{{ __('admin.common.reset') }}</a>
    </div>
</form>
