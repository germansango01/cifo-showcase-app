{{--
 * resources/views/front/project-detail.blade.php
 * Individual project detail page.
 *
 * @var \App\Models\Project $project
 --}}

<x-layouts.app :title="$project->title" :description="$project->short_description" ogType="article" :ogImage="$project->thumbnail_url">

    <article class="project-detail" aria-labelledby="detail-title">

        {{-- ── BREADCRUMB ────────────────────────────────── --}}
        <nav class="breadcrumb" aria-label="{{ __('Ruta de navegación') }}">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                    <li aria-hidden="true"><span class="breadcrumb-sep">›</span></li>
                    <li><a href="{{ route('projects') }}">{{ __('Proyectos') }}</a></li>
                    <li aria-hidden="true"><span class="breadcrumb-sep">›</span></li>
                    <li><span class="breadcrumb-current" aria-current="page">{{ $project->title }}</span></li>
                </ol>
            </div>
        </nav>

        {{-- ── HERO IMAGE ─────────────────────────────────── --}}
        <header class="project-detail-hero">
            <figure>
                <img src="{{ $project->thumbnail_url }}" alt="{{ __('Imagen principal de') }} {{ $project->title }}" width="1200" height="800">
            </figure>

            <div class="project-detail-hero-overlay">
                <div class="container">
                    <div class="project-detail-hero-badges">
                        <span class="badge" data-cycle="{{ strtolower($project->cycle) }}">{{ $project->cycle }}</span>
                        <span class="badge" data-type="year">{{ $project->year }}</span>
                    </div>
                    <h1 id="detail-title">{{ $project->title }}</h1>
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
                        <p class="project-detail-description">{{ $project->description }}</p>
                    </section>

                    {{-- Gallery --}}
                    @if ($project->images->count())
                    <section class="project-detail-section" aria-labelledby="section-gallery">
                        <h2 id="section-gallery">{{ __('Galería') }}</h2>
                        <figure class="project-detail-gallery">
                            <div class="carousel project-detail-carousel" id="detail-carousel" role="region" aria-label="{{ __('Galería de imágenes del proyecto') }}" data-images="{{ json_encode($project->images->map(fn($img) => ['src' => $img->url, 'alt' => $img->alt])) }}">

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

                    {{-- Technologies --}}
                    @if ($project->technologies->count())
                    <section class="project-detail-section" aria-labelledby="section-tech">
                        <h2 id="section-tech">{{ __('Tecnologías utilizadas') }}</h2>
                        <div class="project-detail-tech-grid">
                            @foreach ($project->technologies as $tech)
                            <div class="tech-item">
                                @if ($tech->icon_url)
                                <img src="{{ $tech->icon_url }}" alt="{{ $tech->name }}" width="32" height="32" loading="lazy">
                                @endif
                                <span>{{ $tech->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                </div>

                {{-- Sidebar --}}
                <aside class="project-detail-sidebar" aria-label="{{ __('Información del proyecto') }}">

                    <div class="project-detail-meta-card">
                        <h3>{{ __('Información') }}</h3>
                        <dl class="project-detail-meta">
                            <dt>{{ __('Alumno/a') }}</dt>
                            <dd>{{ $project->student->name ?? '—' }}</dd>

                            <dt>{{ __('Docente') }}</dt>
                            <dd>{{ $project->professor->name ?? '—' }}</dd>

                            <dt>{{ __('Ciclo') }}</dt>
                            <dd>
                                <span class="badge" data-cycle="{{ strtolower($project->cycle) }}">
                                    {{ $project->cycle }}
                                </span>
                            </dd>

                            <dt>{{ __('Año') }}</dt>
                            <dd>{{ $project->year }}</dd>

                            @if ($project->demo_url)
                            <dt>{{ __('Demo') }}</dt>
                            <dd>
                                <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn" data-variant="primary" data-size="sm">
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
