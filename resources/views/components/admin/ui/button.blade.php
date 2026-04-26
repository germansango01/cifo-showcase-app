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
        aria-busy="{{ $loading ? 'true' : 'false' }}"
        :disabled="$data.form?.processing ?? false"
        :aria-busy="($data.form?.processing ?? false) ? 'true' : 'false'">
        @if ($loading)
            <span class="loading loading-spinner loading-sm"></span>
        @else
            @if ($icon)
                <i class="{{ $icon }}" x-show="!($data.form?.processing ?? false)"></i>
            @endif
            <span class="loading loading-spinner loading-sm" x-cloak x-show="$data.form?.processing ?? false"></span>
        @endif
        {{ $slot }}
        @if ($iconRight && !$loading)
            <i class="{{ $iconRight }}" x-show="!($data.form?.processing ?? false)"></i>
        @endif
    </button>
@endif
