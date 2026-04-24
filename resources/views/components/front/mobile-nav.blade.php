{{--
 * resources/views/components/front/mobile-nav.blade.php
 * Mobile navigation drawer.
 --}}

<div class="mobile-nav" id="mobile-nav" aria-hidden="true" aria-label="{{ __('front.nav.mobile_label') }}">
    <div class="mobile-nav-inner">

        <div class="mobile-close">
            <button class="mobile-close-btn" aria-label="{{ __('front.nav.close_menu') }}">&#x2715;</button>
        </div>

        <a href="{{ route('home') }}" class="mobile-nav-link" @if (request()->routeIs('home')) aria-current="page" @endif>
            {{ __('front.nav.home') }}
        </a>
        <a href="{{ route('projects') }}" class="mobile-nav-link" @if (request()->routeIs('projects')) aria-current="page" @endif>
            {{ __('front.nav.projects') }}
        </a>
        <a href="{{ route('about') }}" class="mobile-nav-link" @if (request()->routeIs('about')) aria-current="page" @endif>
            {{ __('front.nav.about') }}
        </a>

        <x-front.language-switcher />
    </div>
</div>
