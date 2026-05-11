@php
    $contextTitle = match($activeType) {
        'category' => __('front.projects.context_by_category', ['name' => $activeModel?->name]),
        'course'   => __('front.projects.context_by_course',   ['name' => $activeModel?->name]),
        'tag'      => __('front.projects.context_by_tag',      ['name' => $activeModel?->name]),
        default    => __('front.projects.context_all'),
    };
    $hasFilters = $activeType !== null || request()->filled('q');
@endphp

<x-layouts.app :title="__('front.projects.page_title')" :description="__('front.projects.page_desc')">

    {{-- ── PAGE HEADER ─────────────────────────────────── --}}
    <section class="projects-header" aria-labelledby="projects-page-title">
        <div class="container projects-header-inner">
            <h1 id="projects-page-title" class="reveal">{{ __('front.projects.header_title') }}</h1>
            <p class="reveal">{{ __('front.projects.header_desc') }}</p>
        </div>
    </section>

    {{-- ── MAIN LAYOUT: content + sidebar ─────────────── --}}
    <div class="container projects-layout">

        {{-- Main content (DOM-first for mobile) --}}
        <main class="projects-main" aria-labelledby="projects-context-title">

            {{-- Toolbar: context title + count + optional reset --}}
            <div class="projects-toolbar">
                <h2 id="projects-context-title" class="projects-context-title">{{ $contextTitle }}</h2>

                <div class="projects-toolbar-meta">
                    <span class="projects-count" aria-live="polite" aria-atomic="true">
                        <strong>{{ $projects->total() }}</strong> {{ __('front.projects.filter_count') }}
                    </span>

                    @if($hasFilters)
                        <a href="{{ route('projects') }}"
                           class="btn" data-variant="ghost" data-size="sm"
                           aria-label="{{ __('front.projects.filter_reset_aria') }}">
                            {{ __('front.projects.filter_reset') }}
                        </a>
                    @endif
                </div>
            </div>

            {{-- Grid --}}
            <div class="projects-grid stagger">
                @forelse ($projects as $project)
                    <x-front.project-card :project="$project" />
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
                <div class="pagination-wrapper" aria-label="{{ __('front.projects.pagination_aria') }}">
                    {{ $projects->withQueryString()->links('components.front.pagination') }}
                </div>
            @endif

        </main>

        {{-- Sidebar (after main in DOM for mobile-first; CSS places it right on desktop) --}}
        <div class="projects-aside">
            <x-front.projects-sidebar
                :categories="$categories"
                :courses="$courses"
                :tags="$tags"
                :recentProjects="$recentProjects"
                :activeType="$activeType"
                :activeModel="$activeModel"
            />
        </div>

    </div>

    {{-- Quick-view modal --}}
    <x-front.project-modal />

</x-layouts.app>
