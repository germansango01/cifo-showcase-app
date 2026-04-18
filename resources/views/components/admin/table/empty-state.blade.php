@props(['message', 'icon', 'actionLabel', 'actionHref'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-14 px-6 text-center']) }}>
    <div
        class="mb-4 flex items-center justify-center w-16 h-16 rounded-full bg-base-200 text-base-content/40 shadow-inner">
        <i class="{{ $icon }} text-3xl"></i>
    </div>

    <p class="text-base-content/60 text-sm font-medium mb-4">{{ $message }}</p>

    @if ($actionLabel && $actionHref)
        <a href="{{ $actionHref }}" class="btn btn-primary btn-sm gap-2">
            <i class="icofont-plus"></i>
            {{ $actionLabel }}
        </a>
    @endif
</div>
