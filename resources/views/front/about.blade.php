{{--
 * resources/views/front/about.blade.php
 * About page — hero, mission/vision, stats, cycles.
 --}}

<x-layouts.app :title="__('Sobre el Centro')" :description="__('Conoce el CIFO La Violeta, su misión, visión, áreas formativas y los datos que hacen de este centro un referente en formación profesional en Barcelona.')">

    {{-- ── HERO ──────────────────────────────────────────── --}}
    <section class="about-hero" aria-labelledby="about-hero-title">
        <div class="container">

            <nav class="about-hero-breadcrumb" aria-label="{{ __('Ruta de navegación') }}">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                    <li aria-hidden="true"><span class="breadcrumb-sep">›</span></li>
                    <li><span class="breadcrumb-current" aria-current="page">{{ __('Sobre el Centro') }}</span></li>
                </ol>
            </nav>

            <div class="about-hero-content reveal">
                <h1 id="about-hero-title">CIFO La Violeta</h1>
                <p>{{ __("Centre d'Innovació i Formació Ocupacional de Barcelona. Formando a los profesionales del mañana desde 2005.") }}</p>
            </div>

        </div>
    </section>

    {{-- ── MISIÓN Y VISIÓN ─────────────────────────────── --}}
    <section class="about-mission" aria-labelledby="about-mission-title">
        <div class="container">

            <header class="about-mission-header reveal">
                <h2 class="about-mission-title" id="about-mission-title">{{ __('Nuestra identidad') }}</h2>
                <p class="about-mission-intro">{{ __('Impulsamos la formación profesional con rigor, innovación y vocación de servicio a la comunidad.') }}</p>
            </header>

            {{-- Misión --}}
            <div class="about-split reveal">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-mission/800/600" alt="{{ __('Alumnos colaborando en el aula de informática del CIFO La Violeta') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <div class="about-split-icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <circle cx="20" cy="20" r="18" stroke="currentColor" stroke-width="2" />
                            <circle cx="20" cy="20" r="8" fill="currentColor" opacity="0.2" />
                            <circle cx="20" cy="20" r="3" fill="currentColor" />
                            <line x1="20" y1="2" x2="20" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <line x1="20" y1="30" x2="20" y2="38" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <line x1="2" y1="20" x2="10" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <line x1="30" y1="20" x2="38" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>
                    </div>
                    <h3>{{ __('Misión') }}</h3>
                    <p>{{ __('Proporcionar formación profesional de calidad, orientada al mercado laboral real, que capacite a nuestros alumnos con las competencias técnicas y transversales necesarias para desarrollar su carrera en el sector tecnológico con éxito y responsabilidad.') }}</p>
                </div>
            </div>

            {{-- Visión --}}
            <div class="about-split reveal" data-reverse>
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-vision/800/600" alt="{{ __('Vista de las instalaciones modernas del CIFO La Violeta en Barcelona') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <div class="about-split-icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 8C10 8 3 20 3 20C3 20 10 32 20 32C30 32 37 20 37 20C37 20 30 8 20 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <circle cx="20" cy="20" r="6" stroke="currentColor" stroke-width="2" />
                            <circle cx="20" cy="20" r="2.5" fill="currentColor" /></svg>
                    </div>
                    <h3>{{ __('Visión') }}</h3>
                    <p>{{ __('Ser el centro de formación profesional tecnológica de referencia en Barcelona, reconocido por la excelencia de sus graduados, la innovación pedagógica y su estrecha colaboración con el tejido empresarial y las instituciones públicas del sector.') }}</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ── CIFRAS CLAVE ─────────────────────────────────── --}}
    <section class="about-stats" aria-labelledby="about-stats-title">
        <div class="container">

            <header class="about-stats-header reveal">
                <h2 class="about-stats-title" id="about-stats-title">{{ __('El CIFO en cifras') }}</h2>
                <p class="about-stats-intro">{{ __('Dos décadas de trayectoria avalan nuestro compromiso con la formación profesional tecnológica.') }}</p>
            </header>

            <div class="about-stats-grid">
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('Más de 500 alumnos formados') }}">+500</span>
                    <span class="about-stats-label">{{ __('Alumnos formados') }}</span>
                </div>
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('Más de 120 proyectos fin de ciclo') }}">+120</span>
                    <span class="about-stats-label">{{ __('Proyectos fin de ciclo') }}</span>
                </div>
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('20 años de historia') }}">20</span>
                    <span class="about-stats-label">{{ __('Años de historia') }}</span>
                </div>
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('20 docentes especializados') }}">20</span>
                    <span class="about-stats-label">{{ __('Docentes especializados') }}</span>
                </div>
            </div>

        </div>
    </section>

    {{-- ── CICLOS FORMATIVOS ────────────────────────────── --}}
    <section class="about-programs" aria-labelledby="about-programs-title">
        <div class="container">

            <header class="about-programs-header reveal">
                <h2 class="about-programs-title" id="about-programs-title">{{ __('Ciclos formativos') }}</h2>
                <p class="about-programs-intro">{{ __('Cuatro itinerarios de Grado Superior adaptados a las demandas actuales del mercado tecnológico.') }}</p>
            </header>

            {{-- DAW --}}
            <div class="about-split reveal" aria-labelledby="program-daw-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-daw/800/600" alt="{{ __('Alumno trabajando en el desarrollo de una aplicación web en el CIFO') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="daw">DAW</span>
                    <h3 id="program-daw-title">{{ __('Desarrollo de Aplicaciones Web') }}</h3>
                    <p>{{ __('Diseño, desarrollo y mantenimiento de aplicaciones web. HTML, CSS, JavaScript, frameworks modernos, bases de datos y backend.') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'DAW']) }}" class="btn" data-variant="ghost">
                        {{ __('Ver proyectos DAW →') }}
                    </a>
                </div>
            </div>

            {{-- DAM --}}
            <div class="about-split reveal" data-reverse aria-labelledby="program-dam-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-dam/800/600" alt="{{ __('Alumna desarrollando una aplicación móvil en el laboratorio del CIFO') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="dam">DAM</span>
                    <h3 id="program-dam-title">{{ __('Desarrollo de Aplicaciones Multiplataforma') }}</h3>
                    <p>{{ __('Desarrollo de aplicaciones para escritorio, móvil y web. Java, Kotlin, Swift y entornos multiplataforma.') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'DAM']) }}" class="btn" data-variant="ghost">
                        {{ __('Ver proyectos DAM →') }}
                    </a>
                </div>
            </div>

            {{-- ASIR --}}
            <div class="about-split reveal" aria-labelledby="program-asir-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-asir/800/600" alt="{{ __('Administración de servidores y redes en el CIFO La Violeta') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="asir">ASIR</span>
                    <h3 id="program-asir-title">{{ __('Administración de Sistemas Informáticos en Red') }}</h3>
                    <p>{{ __('Gestión de redes, sistemas operativos, virtualización, ciberseguridad y servicios cloud.') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'ASIR']) }}" class="btn" data-variant="ghost">
                        {{ __('Ver proyectos ASIR →') }}
                    </a>
                </div>
            </div>

            {{-- SMX --}}
            <div class="about-split reveal" data-reverse aria-labelledby="program-smx-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-smx/800/600" alt="{{ __('Soporte técnico y microinformática en el CIFO La Violeta') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="smx">SMX</span>
                    <h3 id="program-smx-title">{{ __('Sistemas Microinformáticos y Redes') }}</h3>
                    <p>{{ __('Instalación, configuración y mantenimiento de equipos y redes de área local. Soporte técnico presencial y remoto.') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'SMX']) }}" class="btn" data-variant="ghost">
                        {{ __('Ver proyectos SMX →') }}
                    </a>
                </div>
            </div>

        </div>
    </section>

</x-layouts.app>
