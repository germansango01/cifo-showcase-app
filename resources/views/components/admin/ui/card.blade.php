@props(['padding', 'shadow'])

<div
    {{ $attributes->merge([
        'class' => collect(['card', 'bg-base-100'])->when($shadow, fn($c) => $c->push('shadow-md'))->implode(' '),
    ]) }}>

    @isset($header)
        <div class="card-header border-b border-base-300 {{ $padding ? 'px-6 py-4' : '' }}">
            {{ $header }}
        </div>
    @endisset

    <div class="{{ $padding ? 'card-body' : '' }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="border-t border-base-300 {{ $padding ? 'px-6 py-4' : '' }}">
            {{ $footer }}
        </div>
    @endisset
</div>
