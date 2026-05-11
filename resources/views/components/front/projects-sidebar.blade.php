@props([
    'categories'     => collect(),
    'courses'        => collect(),
    'tags'           => collect(),
    'recentProjects' => collect(),
    'activeType'     => null,
    'activeModel'    => null,
])

@php
    $currentRoute  = Route::currentRouteName();
    $routeParams   = request()->route()?->parameters() ?? [];
    $searchAction  = $currentRoute ? route($currentRoute, $routeParams) : route('projects');
@endphp

<aside class="projects-sidebar" aria-label="{{ __('front.projects.sidebar_title') }}">

    {{-- Search --}}
    <div class="sidebar-section">
        <form method="GET" action="{{ $searchAction }}" role="search" class="sidebar-search-form">
            <label for="sidebar-search" class="visually-hidden">{{ __('front.projects.sidebar_search_placeholder') }}</label>
            <div class="sidebar-search-wrap">
                <input
                    id="sidebar-search"
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="{{ __('front.projects.sidebar_search_placeholder') }}"
                    class="sidebar-search-input"
                    autocomplete="off"
                >
                <button type="submit" class="sidebar-search-btn" aria-label="{{ __('front.projects.sidebar_search_placeholder') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </button>
            </div>
        </form>
    </div>

    {{-- All projects --}}
    <div class="sidebar-section">
        <a href="{{ route('projects') }}"
           class="sidebar-all-link{{ $activeType === null && !request('q') ? ' is-active' : '' }}"
           @if($activeType === null && !request('q')) aria-current="page" @endif>
            {{ __('front.projects.sidebar_all') }}
        </a>
    </div>

    {{-- Categories --}}
    @if($categories->isNotEmpty())
        <div class="sidebar-section">
            <h3 class="sidebar-section-title">{{ __('front.projects.sidebar_categories') }}</h3>
            <ul class="sidebar-list" role="list">
                @foreach($categories as $cat)
                    @php $isActive = $activeType === 'category' && $activeModel?->id === $cat->id; @endphp
                    <li>
                        <a href="{{ route('projects.category', ['category' => $cat->slug]) }}"
                           class="sidebar-link{{ $isActive ? ' is-active' : '' }}"
                           @if($isActive) aria-current="page" @endif>
                            <span class="sidebar-link-label">{{ $cat->name }}</span>
                            @if($cat->projects_count > 0)
                                <span class="sidebar-count" aria-hidden="true">{{ $cat->projects_count }}</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Courses --}}
    @if($courses->isNotEmpty())
        <div class="sidebar-section">
            <h3 class="sidebar-section-title">{{ __('front.projects.sidebar_courses') }}</h3>
            <ul class="sidebar-list" role="list">
                @foreach($courses as $course)
                    @php $isActive = $activeType === 'course' && $activeModel?->id === $course->id; @endphp
                    <li>
                        <a href="{{ route('projects.course', ['course' => $course->course_code]) }}"
                           class="sidebar-link{{ $isActive ? ' is-active' : '' }}"
                           @if($isActive) aria-current="page" @endif>
                            <span class="sidebar-link-label">{{ $course->name }}</span>
                            @if($course->projects_count > 0)
                                <span class="sidebar-count" aria-hidden="true">{{ $course->projects_count }}</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Recent projects --}}
    @if($recentProjects->isNotEmpty())
        <div class="sidebar-section">
            <h3 class="sidebar-section-title">{{ __('front.projects.sidebar_recent') }}</h3>
            <ul class="sidebar-recent-list" role="list">
                @foreach($recentProjects as $recent)
                    <li class="sidebar-recent-item">
                        <a href="{{ route('projects.show', ['project' => $recent->slug]) }}"
                           class="sidebar-recent-link">
                            <span class="sidebar-recent-title">{{ $recent->title }}</span>
                            <time class="sidebar-recent-date" datetime="{{ $recent->project_date->toDateString() }}">
                                {{ $recent->project_date->format('m/Y') }}
                            </time>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tags --}}
    @if($tags->isNotEmpty())
        <div class="sidebar-section">
            <h3 class="sidebar-section-title">{{ __('front.projects.sidebar_tags') }}</h3>
            <div class="sidebar-tags" role="list">
                @foreach($tags as $tag)
                    @php $isActive = $activeType === 'tag' && $activeModel?->id === $tag->id; @endphp
                    <a href="{{ route('projects.tag', ['tag' => $tag->slug]) }}"
                       class="badge sidebar-tag{{ $isActive ? ' is-active' : '' }}"
                       data-type="tag"
                       role="listitem"
                       @if($isActive) aria-current="page" @endif>
                        {{ $tag->name }}
                        @if($tag->projects_count > 0)
                            <span class="sidebar-tag-count" aria-hidden="true">({{ $tag->projects_count }})</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</aside>
