{{--
 * resources/views/components/front/mobile-nav.blade.php
 * Mobile navigation drawer.
 --}}

<div class="mobile-nav" id="mobile-nav" aria-hidden="true" aria-label="{{ __('Menú de navegación móvil') }}">
    <div class="mobile-nav-inner">

        <div class="mobile-close">
            <button class="mobile-close-btn" aria-label="{{ __('Cerrar menú') }}">&#x2715;</button>
        </div>

        <a href="{{ route('home') }}" class="mobile-nav-link" @if (request()->routeIs('home')) aria-current="page" @endif>
            {{ __('Inicio') }}
        </a>
        <a href="{{ route('projects') }}" class="mobile-nav-link" @if (request()->routeIs('projects')) aria-current="page" @endif>
            {{ __('Proyectos') }}
        </a>
        <a href="{{ route('about') }}" class="mobile-nav-link" @if (request()->routeIs('about')) aria-current="page" @endif>
            {{ __('Sobre el Centro') }}
        </a>

        <x-front.language-switcher />
    </div>
</div>
