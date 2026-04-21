@props(['icon', 'title', 'message', 'actionLabel', 'actionHref'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-16 px-4 text-center']) }}>
    {{-- Illustrated icon bubble --}}
    <div class="mb-5 flex items-center justify-center w-20 h-20 rounded-full bg-base-200 text-primary shadow-inner">
        <i class="{{ $icon }} text-4xl"></i>
    </div>

    <h3 class="text-lg font-semibold text-base-content mb-1">{{ $title }}</h3>

    <p class="text-sm text-base-content/60 max-w-xs mb-6">{{ $message }}</p>

    @if ($actionLabel && $actionHref)
        <a href="{{ $actionHref }}" class="btn btn-primary btn-sm gap-2">
            <i class="icofont-plus"></i>
            {{ $actionLabel }}
        </a>
    @endif
</div>
