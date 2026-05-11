{{--
 * resources/views/components/front/language-switcher.blade.php
 *
 * URL-prefix language switcher. Preserves current route and params.
 *
 * @prop string|null $class  Extra CSS classes
--}}

@props(['class' => ''])

@php
    $current = app()->getLocale();
    $route = Route::currentRouteName();
    $params = request()->route()?->parameters() ?? [];

    $buildUrl = function (string $locale) use ($route, $params) {
        $params['locale'] = $locale;
        return $route ? route($route, $params) : url("/{$locale}");
    };
@endphp

<div class="lang-switcher {{ $class }}" role="group" aria-label="{{ __('front.nav.select_lang') }}">


    <a href="{{ $buildUrl('ca') }}" class="lang-switcher-option" aria-pressed="{{ $current === 'ca' ? 'true' : 'false' }}"
        hreflang="ca">CA</a>
    <span class="lang-switcher-sep" aria-hidden="true">/</span>
    <a href="{{ $buildUrl('es') }}" class="lang-switcher-option"
        aria-pressed="{{ $current === 'es' ? 'true' : 'false' }}" hreflang="es">ES</a>
</div>
