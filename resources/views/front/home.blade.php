{{--
 * resources/views/front/home.blade.php
 * Home page — hero, featured projects, stats, about teaser.
 --}}

<x-layouts.app :title="__('Inicio')" :description="__('Portafolio de proyectos finales de los ciclos formativos del CIFO La Violeta, Barcelona.')">

    {{-- ── HERO ──────────────────────────────────────────── --}}
    <section class="hero" aria-labelledby="hero-title">
        <div class="container hero-container">

            <div class="hero-content reveal">
                <span class="hero-eyebrow">CIFO La Violeta — Barcelona</span>
                <h1 id="hero-title">{{ __('Donde el talento se hace visible') }}</h1>
                <p>{{ __('Explora los proyectos finales de nuestros ciclos formativos. Cada entrega es una muestra real del talento y la dedicación de nuestros alumnos.') }}</p>
                <a href="{{ route('projects') }}" class="btn hero-cta" data-variant="primary" data-size="lg">
                    {{ __('Ver todos los proyectos') }}
                </a>
            </div>

            <div class="hero-visual reveal" aria-hidden="true">
                <img src="{{ asset('img/hero-pattern.svg') }}" alt="" width="420" height="263">
            </div>

        </div>
    </section>

    {{-- ── FEATURED PROJECTS ────────────────────────────── --}}
    <section class="featured-projects section" aria-labelledby="featured-title">
        <div class="container">

            <header class="section-header reveal">
                <span class="section-eyebrow">{{ __('Últimas entregas') }}</span>
                <h2 id="featured-title">{{ __('Proyectos destacados') }}</h2>
                <a href="{{ route('projects') }}" class="btn" data-variant="ghost">{{ __('Ver todos →') }}</a>
            </header>

            {{-- Row 1: first 3 featured --}}
            <div class="featured-grid">
                @foreach ($featured->take(3) as $index => $project)
                <x-front.project-card :project="$project" :class="$index === 0 ? 'featured-card-main' : ''" />
                @endforeach
            </div>

            {{-- Row 2: next 3 featured (inverted layout) --}}
            @if ($featured->count() > 3)
            <div class="featured-grid featured-grid--inverted">
                @foreach ($featured->skip(3)->take(3) as $project)
                <x-front.project-card :project="$project" />
                @endforeach
            </div>
            @endif

        </div>
    </section>

    {{-- ── STATS STRIP ─────────────────────────────────── --}}
    <section class="stats-strip" aria-label="{{ __('Cifras del CIFO La Violeta') }}">
        <div class="container">
            <div class="stats-inner">
                <div class="stat-item reveal">
                    <span class="stat-number" data-count="{{ $stats['graduates'] }}">0</span>
                    <span class="stat-label">{{ __('Alumnos graduados') }}</span>
                </div>
                <div class="stat-item reveal">
                    <span class="stat-number" data-count="{{ $stats['projects'] }}">0</span>
                    <span class="stat-label">{{ __('Proyectos publicados') }}</span>
                </div>
                <div class="stat-item reveal">
                    <span class="stat-number" data-count="{{ $stats['years'] }}">0</span>
                    <span class="stat-label">{{ __('Años de formación') }}</span>
                </div>
                <div class="stat-item reveal">
                    <span class="stat-number" data-count="{{ $stats['teachers'] }}">0</span>
                    <span class="stat-label">{{ __('Docentes especializados') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ── ABOUT TEASER ─────────────────────────────────── --}}
    <section class="about-teaser section" aria-labelledby="teaser-title">
        <div class="container">
            <div class="about-teaser-inner reveal">

                <div class="about-teaser-content">
                    <span class="section-eyebrow">{{ __('Sobre el centro') }}</span>
                    <h2 id="teaser-title">{{ __('Formación que transforma carreras') }}</h2>
                    <p>{{ __('El CIFO La Violeta es un centro de referencia en Barcelona para la formación profesional en tecnología. Apostamos por un aprendizaje práctico, orientado al mercado laboral real, donde cada proyecto es una demostración de competencia profesional.') }}</p>
                    <a href="{{ route('about') }}" class="btn" data-variant="primary">{{ __('Conoce el centro →') }}</a>
                </div>

                <figure class="about-teaser-figure">
                    <img src="https://picsum.photos/seed/cifo-building/800/600" alt="{{ __('Instalaciones del CIFO La Violeta en Barcelona') }}" width="800" height="600" loading="lazy">
                </figure>

            </div>
        </div>
    </section>

    {{-- Quick-view modal (once per page) --}}
    <x-front.project-modal />

</x-layouts.app>
