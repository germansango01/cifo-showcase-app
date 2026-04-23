@props(['id', 'title' => null, 'size' => 'md'])
@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
    ];
@endphp

<dialog id="{{ $id }}" class="modal">
    <div class="modal-box {{ $sizes[$size] ?? $sizes['md'] }}">
        @if ($title)
            <h3 class="font-bold text-lg mb-4">{{ $title }}</h3>
        @endif
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" aria-label="Cerrar">✕</button>
        </form>
        {{ $slot }}
        @isset($actions)
            <div class="modal-action">{{ $actions }}</div>
        @endisset
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>
