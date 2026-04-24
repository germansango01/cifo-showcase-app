{{--
 * resources/views/front/about.blade.php
 * About page — hero, mission/vision, stats, cycles.
 --}}

<x-layouts.app :title="__('front.about.page_title')" :description="__('front.about.page_desc')">

    {{-- ── HERO ──────────────────────────────────────────── --}}
    <section class="about-hero" aria-labelledby="about-hero-title">
        <div class="container">

            <nav class="about-hero-breadcrumb" aria-label="{{ __('front.about.breadcrumb_aria') }}">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __('front.nav.home') }}</a></li>
                    <li aria-hidden="true"><span class="breadcrumb-sep">›</span></li>
                    <li><span class="breadcrumb-current" aria-current="page">{{ __('front.nav.about') }}</span></li>
                </ol>
            </nav>

            <div class="about-hero-content reveal">
                <h1 id="about-hero-title">CIFO La Violeta</h1>
                <p>{{ __('front.about.hero_intro') }}</p>
            </div>

        </div>
    </section>

    {{-- ── MISIÓN Y VISIÓN ─────────────────────────────── --}}
    <section class="about-mission" aria-labelledby="about-mission-title">
        <div class="container">

            <header class="about-mission-header reveal">
                <h2 class="about-mission-title" id="about-mission-title">{{ __('front.about.mission_title') }}</h2>
                <p class="about-mission-intro">{{ __('front.about.mission_intro') }}</p>
            </header>

            {{-- Misión --}}
            <div class="about-split reveal">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-mission/800/600" alt="{{ __('front.about.mission_img_alt') }}" width="800" height="600" loading="lazy">
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
                    <h3>{{ __('front.about.mission_heading') }}</h3>
                    <p>{{ __('front.about.mission_body') }}</p>
                </div>
            </div>

            {{-- Visión --}}
            <div class="about-split reveal" data-reverse>
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-vision/800/600" alt="{{ __('front.about.vision_img_alt') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <div class="about-split-icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 8C10 8 3 20 3 20C3 20 10 32 20 32C30 32 37 20 37 20C37 20 30 8 20 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <circle cx="20" cy="20" r="6" stroke="currentColor" stroke-width="2" />
                            <circle cx="20" cy="20" r="2.5" fill="currentColor" /></svg>
                    </div>
                    <h3>{{ __('front.about.vision_heading') }}</h3>
                    <p>{{ __('front.about.vision_body') }}</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ── CIFRAS CLAVE ─────────────────────────────────── --}}
    <section class="about-stats" aria-labelledby="about-stats-title">
        <div class="container">

            <header class="about-stats-header reveal">
                <h2 class="about-stats-title" id="about-stats-title">{{ __('front.about.stats_title') }}</h2>
                <p class="about-stats-intro">{{ __('front.about.stats_intro') }}</p>
            </header>

            <div class="about-stats-grid">
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('front.about.stats_graduates_aria') }}">+500</span>
                    <span class="about-stats-label">{{ __('front.about.stats_graduates') }}</span>
                </div>
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('front.about.stats_projects_aria') }}">+120</span>
                    <span class="about-stats-label">{{ __('front.about.stats_projects') }}</span>
                </div>
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('front.about.stats_years_aria') }}">20</span>
                    <span class="about-stats-label">{{ __('front.about.stats_years') }}</span>
                </div>
                <div class="about-stats-item reveal">
                    <span class="about-stats-number" aria-label="{{ __('front.about.stats_teachers_aria') }}">20</span>
                    <span class="about-stats-label">{{ __('front.about.stats_teachers') }}</span>
                </div>
            </div>

        </div>
    </section>

    {{-- ── CICLOS FORMATIVOS ────────────────────────────── --}}
    <section class="about-programs" aria-labelledby="about-programs-title">
        <div class="container">

            <header class="about-programs-header reveal">
                <h2 class="about-programs-title" id="about-programs-title">{{ __('front.about.programs_title') }}</h2>
                <p class="about-programs-intro">{{ __('front.about.programs_intro') }}</p>
            </header>

            {{-- DAW --}}
            <div class="about-split reveal" aria-labelledby="program-daw-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-daw/800/600" alt="{{ __('front.about.program_daw_img_alt') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="daw">DAW</span>
                    <h3 id="program-daw-title">{{ __('front.about.program_daw_title') }}</h3>
                    <p>{{ __('front.about.program_daw_desc') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'DAW']) }}" class="btn" data-variant="ghost">
                        {{ __('front.about.program_daw_link') }}
                    </a>
                </div>
            </div>

            {{-- DAM --}}
            <div class="about-split reveal" data-reverse aria-labelledby="program-dam-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-dam/800/600" alt="{{ __('front.about.program_dam_img_alt') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="dam">DAM</span>
                    <h3 id="program-dam-title">{{ __('front.about.program_dam_title') }}</h3>
                    <p>{{ __('front.about.program_dam_desc') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'DAM']) }}" class="btn" data-variant="ghost">
                        {{ __('front.about.program_dam_link') }}
                    </a>
                </div>
            </div>

            {{-- ASIR --}}
            <div class="about-split reveal" aria-labelledby="program-asir-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-asir/800/600" alt="{{ __('front.about.program_asir_img_alt') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="asir">ASIR</span>
                    <h3 id="program-asir-title">{{ __('front.about.program_asir_title') }}</h3>
                    <p>{{ __('front.about.program_asir_desc') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'ASIR']) }}" class="btn" data-variant="ghost">
                        {{ __('front.about.program_asir_link') }}
                    </a>
                </div>
            </div>

            {{-- SMX --}}
            <div class="about-split reveal" data-reverse aria-labelledby="program-smx-title">
                <div class="about-split-media">
                    <img src="https://picsum.photos/seed/cifo-smx/800/600" alt="{{ __('front.about.program_smx_img_alt') }}" width="800" height="600" loading="lazy">
                </div>
                <div class="about-split-content">
                    <span class="badge" data-cycle="smx">SMX</span>
                    <h3 id="program-smx-title">{{ __('front.about.program_smx_title') }}</h3>
                    <p>{{ __('front.about.program_smx_desc') }}</p>
                    <a href="{{ route('projects', ['cycle' => 'SMX']) }}" class="btn" data-variant="ghost">
                        {{ __('front.about.program_smx_link') }}
                    </a>
                </div>
            </div>

        </div>
    </section>

</x-layouts.app>
