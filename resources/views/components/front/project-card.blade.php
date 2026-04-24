{{--
 * resources/views/components/front/project-card.blade.php
 *
 * Reusable project card for home featured grid and projects catalog.
 *
 * @prop \App\Models\Project $project
 --}}

@props(['project'])

@php
    $locale = app()->getLocale();
    $title = $locale === 'ca' ? $project->title_ca : $project->title_es;
    $desc = $locale === 'ca' ? $project->description_ca : $project->description_es;
    $year = $project->project_date?->year;
    $cycleCode = $project->course?->course_code ?? '';
    $cycleName = $project->course?->category?->{'name_' . $locale} ?? $cycleCode;
    $students = $project->relationLoaded('students') ? $project->students->pluck('name')->join(', ') : '';
    $projectJson = json_encode([
        'title' => $title,
        'description' => $desc,
        'thumbnail' => $project->thumbnail,
        'cycle' => $cycleCode,
        'cycleName' => $cycleName,
        'year' => $year,
        'students' => $project->relationLoaded('students') ? $project->students->pluck('name')->all() : [],
        'tags' => $project->relationLoaded('tags') ? $project->tags->pluck('name')->all() : [],
        'detailUrl' => route('projects.show', $project->slug),
    ]);
@endphp

<article class="card" data-project-id="{{ $project->id }}" data-course="{{ $cycleCode }}"
    data-year="{{ $year }}" data-project="{{ $projectJson }}">
    <div class="card-surface">

        <div class="card-media">
            <img class="card-image" src="{{ $project->thumbnail }}"
                alt="{{ __('Captura de pantalla de') }} {{ $title }}" width="600" height="400"
                loading="lazy">
            <button class="card-quick-view" aria-label="{{ __('Vista rápida') }}: {{ $title }}"
                data-open-modal="{{ $project->id }}">
                {{ __('Vista rápida') }}
            </button>
        </div>

        <div class="card-body">
            <div class="card-badges">
                @if ($cycleName)
                    <span class="badge" data-cycle="{{ strtolower($cycleCode) }}">{{ $cycleName }}</span>
                @endif
                @if ($year)
                    <span class="badge" data-type="year">{{ $year }}</span>
                @endif
            </div>
            <h3 class="card-title">{{ $title }}</h3>
            <p class="card-description">{{ $desc }}</p>
            <footer>
                <span class="card-student">{{ $students }}</span>
            </footer>
        </div>

    </div>
</article>
