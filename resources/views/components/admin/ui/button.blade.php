@props(['variant', 'size', 'icon', 'iconRight', 'type', 'outline', 'ghost', 'loading', 'block', 'href'])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes()]) }}>
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
        @if ($iconRight)
            <i class="{{ $iconRight }}"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes()]) }} @disabled($loading)
        aria-busy="{{ $loading ? 'true' : 'false' }}">
        @if ($loading)
            <span class="loading loading-spinner loading-sm"></span>
        @else
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif
        @endif
        {{ $slot }}
        @if ($iconRight && !$loading)
            <i class="{{ $iconRight }}"></i>
        @endif
    </button>
@endif
