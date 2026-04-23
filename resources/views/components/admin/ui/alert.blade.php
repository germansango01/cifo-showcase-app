@props(['type' => 'info', 'dismissible' => false, 'icon' => null])
@php
    $map = [
        'success' => ['cls' => 'alert-success', 'ic' => 'icofont-check-circled'],
        'error' => ['cls' => 'alert-error', 'ic' => 'icofont-close-circled'],
        'warning' => ['cls' => 'alert-warning', 'ic' => 'icofont-warning-alt'],
        'info' => ['cls' => 'alert-info', 'ic' => 'icofont-info-circle'],
    ];
    $cfg = $map[$type] ?? $map['info'];
@endphp

<div role="alert" @if ($dismissible) x-data="{ show: true }" x-show="show" x-cloak @endif
    {{ $attributes->merge(['class' => 'alert alert-soft ' . $cfg['cls']]) }}>
    <i class="{{ $icon ?? $cfg['ic'] }} text-xl"></i>
    <span>{{ $slot }}</span>
    @if ($dismissible)
        <button type="button" class="btn btn-ghost btn-xs btn-circle" @click="show = false" aria-label="Cerrar">
            <i class="icofont-close-line"></i>
        </button>
    @endif
</div>
