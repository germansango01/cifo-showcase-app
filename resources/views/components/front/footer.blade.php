{{--
 * resources/views/components/front/footer.blade.php
 * Shared front footer.
 --}}

<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-inner">

            <div class="footer-top">
                {{-- Brand --}}
                <div class="footer-brand">
                    <p class="footer-brand-name">CIFO La Violeta</p>
                    <p class="footer-brand-desc">
                        Centre d'Innovació i Formació Ocupacional.
                        {{ __('front.footer.brand_desc') }}
                    </p>
                </div>

                {{-- Link groups --}}
                <div class="footer-links">
                    <div>
                        <p class="footer-link-group-title">{{ __('front.footer.nav_title') }}</p>
                        <div class="footer-link-group-items">
                            <a href="{{ route('home') }}" class="footer-link">{{ __('front.nav.home') }}</a>
                            <a href="{{ route('projects') }}" class="footer-link">{{ __('front.nav.projects') }}</a>
                            <a href="{{ route('about') }}" class="footer-link">{{ __('front.nav.about') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} CIFO La Violeta — Barcelona. {{ __('front.footer.rights') }}</p>
            </div>

        </div>
    </div>
</footer>
