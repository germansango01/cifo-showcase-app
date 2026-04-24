{{--
 * resources/views/front/project-detail.blade.php
 * Individual project detail page.
 *
 * @var \App\Models\Project $project
 --}}

@php
    $locale    = app()->getLocale();
    $title     = $locale === 'ca' ? $project->title_ca : $project->title_es;
    $desc      = $locale === 'ca' ? $project->description_ca : $project->description_es;
    $cycleCode = $project->course?->course_code ?? '';
    $cycleName = $project->course?->category?->{'name_'.$locale} ?? $cycleCode;
    $year      = $project->project_date?->year;
@endphp

<x-layouts.app
    :title="$title"
    :description="$desc"
    ogType="article"
    :ogImage="$project->thumbnail"
>

    <article class="project-detail" aria-labelledby="detail-title">

        {{-- ── BREADCRUMB ────────────────────────────────── --}}
        <nav class="breadcrumb" aria-label="{{ __('Ruta de navegación') }}">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                    <li aria-hidden="true"><span class="breadcrumb-sep">›</span></li>
                    <li><a href="{{ route('projects') }}">{{ __('Proyectos') }}</a></li>
                    <li aria-hidden="true"><span class="breadcrumb-sep">›</span></li>
                    <li><span class="breadcrumb-current" aria-current="page">{{ $title }}</span></li>
                </ol>
            </div>
        </nav>

        {{-- ── HERO IMAGE ─────────────────────────────────── --}}
        <header class="project-detail-hero">
            <figure>
                <img src="{{ $project->thumbnail }}" alt="{{ __('Imagen principal de') }} {{ $title }}" width="1200" height="800">
            </figure>

            <div class="project-detail-hero-overlay">
                <div class="container">
                    <div class="project-detail-hero-badges">
                        @if ($cycleCode)
                        <span class="badge" data-cycle="{{ strtolower($cycleCode) }}">{{ $cycleName }}</span>
                        @endif
                        @if ($year)
                        <span class="badge" data-type="year">{{ $year }}</span>
                        @endif
                    </div>
                    <h1 id="detail-title">{{ $title }}</h1>
                </div>
            </div>
        </header>

        {{-- ── BODY ─────────────────────────────────────────── --}}
        <div class="container">
            <div class="project-detail-body">

                {{-- Main column --}}
                <div class="project-detail-main">

                    {{-- Description --}}
                    <section class="project-detail-section" aria-labelledby="section-description">
                        <h2 id="section-description">{{ __('Sobre el proyecto') }}</h2>
                        <p class="project-detail-description">{{ $desc }}</p>
                    </section>

                    {{-- Gallery --}}
                    @if ($project->media->count())
                    <section class="project-detail-section" aria-labelledby="section-gallery">
                        <h2 id="section-gallery">{{ __('Galería') }}</h2>
                        <figure class="project-detail-gallery">
                            <div class="carousel project-detail-carousel" id="detail-carousel"
                                role="region"
                                aria-label="{{ __('Galería de imágenes del proyecto') }}"
                                data-images="{{ json_encode($project->media->map(fn ($m) => ['src' => $m->path, 'alt' => $m->alt_text])->values()) }}"
                            >
                                <div class="carousel-track"></div>

                                <button class="carousel-btn" data-direction="prev" aria-label="{{ __('Imagen anterior') }}">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                        <path d="M12 4L6 10l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="carousel-btn" data-direction="next" aria-label="{{ __('Imagen siguiente') }}">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                        <path d="M8 4l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </button>

                                <div class="carousel-dots" role="tablist" aria-label="{{ __('Seleccionar imagen') }}"></div>
                            </div>
                            <figcaption class="sr-only">{{ __('Galería de capturas del proyecto') }}</figcaption>
                        </figure>
                    </section>
                    @endif

                </div>

                {{-- Sidebar --}}
                <aside class="project-detail-sidebar" aria-label="{{ __('Información del proyecto') }}">

                    <div class="project-detail-meta-card">
                        <h3>{{ __('Información') }}</h3>
                        <dl class="project-detail-meta">

                            <dt>{{ __('Alumno/a') }}</dt>
                            <dd>{{ $project->students->pluck('name')->join(', ') ?: '—' }}</dd>

                            <dt>{{ __('Ciclo') }}</dt>
                            <dd>
                                @if ($cycleCode)
                                <span class="badge" data-cycle="{{ strtolower($cycleCode) }}">
                                    {{ $cycleName }}
                                </span>
                                @else
                                —
                                @endif
                            </dd>

                            <dt>{{ __('Año') }}</dt>
                            <dd>{{ $year ?? '—' }}</dd>

                            @if ($project->live_url)
                            <dt>{{ __('Demo') }}</dt>
                            <dd>
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="btn" data-variant="primary" data-size="sm">
                                    {{ __('Ver demo') }} ↗
                                </a>
                            </dd>
                            @endif

                            @if ($project->repo_url)
                            <dt>{{ __('Repositorio') }}</dt>
                            <dd>
                                <a href="{{ $project->repo_url }}" target="_blank" rel="noopener noreferrer" class="btn" data-variant="ghost" data-size="sm">
                                    {{ __('Ver código') }} ↗
                                </a>
                            </dd>
                            @endif

                        </dl>
                    </div>

                    {{-- Tags --}}
                    @if ($project->tags->count())
                    <div class="project-detail-tags">
                        <h3>{{ __('Etiquetas') }}</h3>
                        <div class="project-detail-tags-list">
                            @foreach ($project->tags as $tag)
                            <a href="{{ route('projects', ['tag' => $tag->slug]) }}" class="badge" data-type="tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Back --}}
                    <a href="{{ route('projects') }}" class="btn" data-variant="ghost">
                        ← {{ __('Volver a proyectos') }}
                    </a>

                </aside>

            </div>
        </div>

    </article>

</x-layouts.app>
