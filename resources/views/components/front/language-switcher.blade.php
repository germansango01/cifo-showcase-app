{{--
 * resources/views/components/front/language-switcher.blade.php
 *
 * @prop string|null $class  Extra CSS classes
 --}}

@props(['class' => ''])

<div class="lang-switcher {{ $class }}" aria-label="{{ __('Seleccionar idioma') }}">
    <a href="{{ route('language', 'ca') }}" class="lang-switcher-option" role="button"
        aria-pressed="{{ app()->getLocale() === 'ca' ? 'true' : 'false' }}" hreflang="ca">CA</a>
    <span class="lang-switcher-sep" aria-hidden="true">/</span>
    <a href="{{ route('language', 'es') }}" class="lang-switcher-option" role="button"
        aria-pressed="{{ app()->getLocale() === 'es' ? 'true' : 'false' }}" hreflang="es">ES</a>
</div>
