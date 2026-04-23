{{--
 * resources/views/front/projects.blade.php
 * Projects catalog — filter toolbar + paginated grid.
 --}}

<x-layouts.app :title="__('Proyectos')" :description="__('Catálogo completo de proyectos finales — CIFO La Violeta. Filtra por año, ciclo formativo o docente.')">

    {{-- ── PAGE HEADER ─────────────────────────────────── --}}
    <section class="projects-header" aria-labelledby="projects-page-title">
        <div class="container projects-header-inner">
            <h1 id="projects-page-title" class="reveal">{{ __('Proyectos finales') }}</h1>
            <p class="reveal">
                {{ __('Explora el catálogo completo de proyectos desarrollados por los alumnos del CIFO La Violeta. Usa los filtros para encontrar por año, ciclo formativo o docente.') }}
            </p>
        </div>
    </section>

    {{-- ── FILTER TOOLBAR ───────────────────────────────── --}}
    <section class="filter-toolbar" aria-label="{{ __('Filtros de proyectos') }}">
        <div class="container">
            <form class="filter-toolbar-inner" method="GET" action="{{ route('projects') }}">

                {{-- Año --}}
                <div class="filter-select-wrap">
                    <label for="filter-year" class="sr-only">{{ __('Filtrar por año') }}</label>
                    <select id="filter-year" name="year" aria-label="{{ __('Filtrar por año') }}">
                        <option value="">{{ __('Todos los años') }}</option>
                        @foreach ($years as $year)
                        <option value="{{ $year }}" @selected(request('year')==$year)>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Ciclo --}}
                <div class="filter-select-wrap">
                    <label for="filter-cycle" class="sr-only">{{ __('Filtrar por ciclo') }}</label>
                    <select id="filter-cycle" name="cycle" aria-label="{{ __('Filtrar por ciclo') }}">
                        <option value="">{{ __('Todos los ciclos') }}</option>
                        <option value="DAW" @selected(request('cycle')==='DAW' )>DAW — {{ __('Desarrollo Web') }}</option>
                        <option value="DAM" @selected(request('cycle')==='DAM' )>DAM — {{ __('Desarrollo Multiplataforma') }}</option>
                        <option value="ASIR" @selected(request('cycle')==='ASIR' )>ASIR — {{ __('Administración de Sistemas') }}</option>
                        <option value="SMX" @selected(request('cycle')==='SMX' )>SMX — {{ __('Microinformática') }}</option>
                    </select>
                </div>

                {{-- Docente --}}
                <div class="filter-select-wrap">
                    <label for="filter-professor" class="sr-only">{{ __('Filtrar por docente') }}</label>
                    <select id="filter-professor" name="professor" aria-label="{{ __('Filtrar por docente') }}">
                        <option value="">{{ __('Todos los docentes') }}</option>
                        @foreach ($professors as $professor)
                        <option value="{{ Str::slug($professor->name) }}" @selected(request('professor')===Str::slug($professor->name))>
                            {{ $professor->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Reset --}}
                <a href="{{ route('projects') }}" class="filter-reset" role="button" aria-label="{{ __('Restablecer todos los filtros') }}">
                    ✕ {{ __('Limpiar filtros') }}
                </a>

                {{-- Count --}}
                <span class="filter-count" aria-live="polite" aria-atomic="true">
                    <strong>{{ $projects->total() }}</strong> {{ __('proyectos') }}
                </span>

            </form>
        </div>
    </section>

    {{-- ── PROJECTS GRID ────────────────────────────────── --}}
    <section class="projects-content" aria-labelledby="projects-page-title">
        <div class="container">

            <div class="projects-grid stagger">
                @forelse ($projects as $project)
                <div class="grid-item" data-course="{{ $project->cycle }}" data-year="{{ $project->year }}" data-professor="{{ Str::slug($project->professor->name ?? '') }}">
                    <x-front.project-card :project="$project" />
                </div>
                @empty
                <div class="projects-empty">
                    <p>{{ __('No se encontraron proyectos con los filtros seleccionados.') }}</p>
                    <a href="{{ route('projects') }}" class="btn" data-variant="ghost">
                        {{ __('Ver todos') }}
                    </a>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($projects->hasPages())
            <nav class="pagination-wrapper" aria-label="{{ __('Paginación de proyectos') }}">
                {{ $projects->withQueryString()->links('components.front.pagination') }}
            </nav>
            @endif

        </div>
    </section>

    {{-- Quick-view modal --}}
    <x-front.project-modal />

</x-layouts.app>
