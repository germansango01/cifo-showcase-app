{{--
 * resources/views/components/front/header.blade.php
 * Shared front header: logo, nav links, language switcher, hamburger.
 --}}

@php
$navLinks = [
['href' => route('home'), 'label' => __('Inicio'), 'route' => 'home'],
['href' => route('projects'), 'label' => __('Proyectos'), 'route' => 'projects'],
['href' => route('about'), 'label' => __('Sobre el Centro'), 'route' => 'about'],
];
@endphp

<header class="site-header" role="banner">
    <div class="container">
        <nav class="header" aria-label="{{ __('Navegación principal') }}">
            <div class="header-inner">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="header-logo" aria-label="{{ config('app.name') }} — {{ __('Inicio') }}">
                    <img src="{{ asset('img/logo-placeholder.svg') }}" alt="{{ config('app.name') }}" width="200" height="48">
                </a>

                {{-- Desktop nav --}}
                <div class="header-nav" role="list">
                    @foreach ($navLinks as $link)
                    <a href="{{ $link['href'] }}" class="nav-link" role="listitem" @if (request()->routeIs($link['route'])) aria-current="page" @endif>
                        {{ $link['label'] }}
                    </a>
                    @endforeach
                </div>

                {{-- Actions --}}
                <div class="header-actions">
                    {{-- Language switcher (desktop) --}}
                    <x-front.language-switcher class="desktop-only" />

                    {{-- Hamburger (mobile) --}}
                    <button class="menu-toggle" aria-label="{{ __('Abrir menú de navegación') }}" aria-expanded="false" aria-controls="mobile-nav">
                        <span class="menu-icon" aria-hidden="true">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>

            </div>
        </nav>
    </div>
</header>
