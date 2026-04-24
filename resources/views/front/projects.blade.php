{{--
 * resources/views/front/projects.blade.php
 * Projects catalog — filter toolbar + paginated grid.
 --}}

<x-layouts.app :title="__('front.projects.page_title')" :description="__('front.projects.page_desc')">

    {{-- ── PAGE HEADER ─────────────────────────────────── --}}
    <section class="projects-header" aria-labelledby="projects-page-title">
        <div class="container projects-header-inner">
            <h1 id="projects-page-title" class="reveal">{{ __('front.projects.header_title') }}</h1>
            <p class="reveal">
                {{ __('front.projects.header_desc') }}
            </p>
        </div>
    </section>

    {{-- ── FILTER TOOLBAR ───────────────────────────────── --}}
    <section class="filter-toolbar" aria-label="{{ __('front.projects.filter_aria') }}">
        <div class="container">
            <form class="filter-toolbar-inner" method="GET" action="{{ route('projects') }}">

                {{-- Año --}}
                <div class="filter-select-wrap">
                    <label for="filter-year" class="sr-only">{{ __('front.projects.filter_year_aria') }}</label>
                    <select id="filter-year" name="year" aria-label="{{ __('front.projects.filter_year_aria') }}">
                        <option value="">{{ __('front.projects.filter_year_all') }}</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" @selected(request('year') == $year)>{{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ciclo --}}
                <div class="filter-select-wrap">
                    <label for="filter-cycle" class="sr-only">{{ __('front.projects.filter_cycle_aria') }}</label>
                    <select id="filter-cycle" name="cycle" aria-label="{{ __('front.projects.filter_cycle_aria') }}">
                        <option value="">{{ __('front.projects.filter_cycle_all') }}</option>
                        <option value="DAW" @selected(request('cycle') === 'DAW')>DAW —
                            {{ __('front.projects.filter_cycle_daw') }}</option>
                        <option value="DAM" @selected(request('cycle') === 'DAM')>DAM —
                            {{ __('front.projects.filter_cycle_dam') }}</option>
                        <option value="ASIR" @selected(request('cycle') === 'ASIR')>ASIR —
                            {{ __('front.projects.filter_cycle_asir') }}</option>
                        <option value="SMX" @selected(request('cycle') === 'SMX')>SMX —
                            {{ __('front.projects.filter_cycle_smx') }}</option>
                    </select>
                </div>

                {{-- Docente --}}
                <div class="filter-select-wrap">
                    <label for="filter-professor"
                        class="sr-only">{{ __('front.projects.filter_teacher_aria') }}</label>
                    <select id="filter-professor" name="professor"
                        aria-label="{{ __('front.projects.filter_teacher_aria') }}">
                        <option value="">{{ __('front.projects.filter_teacher_all') }}</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ Str::slug($teacher->name) }}" @selected(request('professor') === Str::slug($teacher->name))>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Reset --}}
                <a href="{{ route('projects') }}" class="filter-reset" role="button"
                    aria-label="{{ __('front.projects.filter_reset_aria') }}">
                    ✕ {{ __('front.projects.filter_reset') }}
                </a>

                {{-- Count --}}
                <span class="filter-count" aria-live="polite" aria-atomic="true">
                    <strong>{{ $projects->total() }}</strong> {{ __('front.projects.filter_count') }}
                </span>

            </form>
        </div>
    </section>

    {{-- ── PROJECTS GRID ────────────────────────────────── --}}
    <section class="projects-content" aria-labelledby="projects-page-title">
        <div class="container">

            <div class="projects-grid stagger">
                @forelse ($projects as $project)
                    <div class="grid-item" data-course="{{ $project->course?->course_code ?? '' }}"
                        data-year="{{ $project->project_date?->year ?? '' }}">
                        <x-front.project-card :project="$project" />
                    </div>
                @empty
                    <div class="projects-empty">
                        <p>{{ __('front.projects.empty') }}</p>
                        <a href="{{ route('projects') }}" class="btn" data-variant="ghost">
                            {{ __('front.projects.empty_view_all') }}
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($projects->hasPages())
                <nav class="pagination-wrapper" aria-label="{{ __('front.projects.pagination_aria') }}">
                    {{ $projects->withQueryString()->links('components.front.pagination') }}
                </nav>
            @endif

        </div>
    </section>

    {{-- Quick-view modal --}}
    <x-front.project-modal />

</x-layouts.app>
