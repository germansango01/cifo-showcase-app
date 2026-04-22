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
                        {{ __('Formación profesional de calidad en Barcelona desde 2005.') }}
                    </p>
                </div>

                {{-- Link groups --}}
                <div class="footer-links">
                    <div>
                        <p class="footer-link-group-title">{{ __('Navegación') }}</p>
                        <div class="footer-link-group-items">
                            <a href="{{ route('home') }}" class="footer-link">{{ __('Inicio') }}</a>
                            <a href="{{ route('projects') }}" class="footer-link">{{ __('Proyectos') }}</a>
                            <a href="{{ route('about') }}" class="footer-link">{{ __('Sobre el Centro') }}</a>
                        </div>
                    </div>
                    <div>
                        <p class="footer-link-group-title">{{ __('Ciclos Formativos') }}</p>
                        <div class="footer-link-group-items">
                            <span class="footer-cycle-item">DAW — {{ __('Desarrollo Web') }}</span>
                            <span class="footer-cycle-item">DAM — {{ __('Desarrollo Multiplataforma') }}</span>
                            <span class="footer-cycle-item">ASIR — {{ __('Admin. Sistemas') }}</span>
                            <span class="footer-cycle-item">SMX — {{ __('Microinformática') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} CIFO La Violeta — Barcelona. {{ __('Todos los derechos reservados.') }}</p>
                <p>{{ __('Hecho con dedicación por los alumnos del CIFO.') }}</p>
            </div>

        </div>
    </div>
</footer>
