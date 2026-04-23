@props(['name', 'src', 'size', 'ring'])

<div {{ $attributes->merge(['class' => 'avatar' . ($src ? '' : ' avatar-placeholder')]) }}>
    <div
        class="{{ $sizeClass() }} rounded-full
                 {{ $ring ? 'ring ring-primary ring-offset-base-100 ring-offset-2' : '' }}
                 {{ $src ? '' : $bgColorClass() }}">
        @if ($src)
            <img src="{{ $src }}" alt="{{ $name }}" />
        @else
            <span class="{{ $textSizeClass() }} font-semibold text-white leading-none">
                {{ $initials() }}
            </span>
        @endif
    </div>
</div>
