@props(['label', 'value', 'icon', 'trend', 'trendValue', 'color'])

<div {{ $attributes->merge(['class' => 'stat bg-base-100 rounded-box shadow-md']) }}>
    @if ($icon)
        <div class="stat-figure {{ $colorClass() }}">
            <i class="{{ $icon }} text-3xl"></i>
        </div>
    @endif

    <div class="stat-title text-base-content/60 text-sm font-medium">{{ $label }}</div>

    <div class="stat-value text-2xl font-bold {{ $colorClass() }}">{{ $value }}</div>

    @if ($trendValue !== null)
        <div class="stat-desc flex items-center gap-1 {{ $trendClass() }}">
            <i class="{{ $trendIcon() }} text-xs"></i>
            <span class="text-xs font-medium">{{ $trendValue }}</span>
        </div>
    @endif
</div>
