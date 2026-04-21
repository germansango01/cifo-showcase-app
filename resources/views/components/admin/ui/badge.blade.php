@props(['color' => 'primary', 'size' => 'md', 'outline' => false])

<span {{ $attributes->merge(['class' => $classes()]) }}>{{ $slot }}</span>
