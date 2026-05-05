@props(['current' => 10])

@php
    $options = [5, 10, 25];
    $query = request()->except(['per_page', 'page']);
@endphp

<form method="GET" action="" class="flex items-center gap-2">
    @foreach ($query as $key => $value)
        @if (is_array($value))
            @foreach ($value as $v)
                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
            @endforeach
        @else
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach

    <label for="per_page_select" class="text-sm opacity-70 whitespace-nowrap shrink-0">{{ __('admin.common.per_page') }}:</label>
    <select id="per_page_select" name="per_page"
            class="select select-sm select-bordered"
            onchange="this.form.submit()">
        @foreach ($options as $option)
            <option value="{{ $option }}" @selected((int) $current === $option)>{{ $option }}</option>
        @endforeach
    </select>
</form>
