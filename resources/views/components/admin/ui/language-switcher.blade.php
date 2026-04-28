@props(['class' => ''])

@php
$current = app()->getLocale();
$locales = ['es' => 'ES', 'ca' => 'CA'];
@endphp

<div {{ $attributes->merge(['class' => "join {$class}"]) }}>
    @foreach ($locales as $code => $label)
    <form method="POST" action="{{ route('admin.locale.update') }}" class="inline">
        @csrf
        <input type="hidden" name="locale" value="{{ $code }}">
        <button type="submit" class="btn btn-sm join-item {{ $current === $code ? 'btn-primary' : 'btn-ghost' }}" aria-pressed="{{ $current === $code ? 'true' : 'false' }}" aria-label="{{ __('admin.nav.switch_lang') }} {{ $label }}">

            {{ $label }}
        </button>
    </form>
    @endforeach
</div>
