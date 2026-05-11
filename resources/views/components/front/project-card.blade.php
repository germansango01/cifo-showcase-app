{{--
 * resources/views/components/front/project-card.blade.php
 *
 * Reusable project card for home featured grid and projects catalog.
 *
 * @prop \App\Models\Project $project
 --}}

@props(['project'])

@php
    $title        = $project->title;
    $desc         = $project->description;
    $year         = $project->project_date?->year;
    $courseCode   = $project->course?->course_code ?? '';
    $courseName   = $project->course?->name ?? $courseCode;
    $categoryName = $project->course?->category?->name ?? '';
    $students     = $project->relationLoaded('students') ? $project->students->pluck('name')->join(', ') : '';
    $featuredMedia = $project->getFeaturedImage();
    $thumbnailUrl  = $featuredMedia?->getUrl('card') ?? asset('images/placeholder.webp');
    $allImages     = $project->relationLoaded('media')
        ? $project->getMedia('images')->map(fn ($m) => $m->getUrl())->values()->all()
        : [$thumbnailUrl];
    $projectJson = json_encode([
        'title'        => $title,
        'description'  => $desc,
        'thumbnail'    => $thumbnailUrl,
        'images'       => $allImages,
        'cycle'        => $courseCode,
        'cycleName'    => $courseName,
        'categoryName' => $categoryName,
        'year'         => $year,
        'students'     => $project->relationLoaded('students') ? $project->students->pluck('name')->all() : [],
        'tags'         => $project->relationLoaded('tags') ? $project->tags->pluck('name')->all() : [],
        'detailUrl'    => route('projects.show', $project->slug),
    ]);
@endphp

<article {{ $attributes->merge(['class' => 'card']) }} data-project-id="{{ $project->id }}"
    data-course="{{ $courseCode }}" data-year="{{ $year }}" data-project="{{ $projectJson }}">
    <div class="card-surface">

        <div class="card-media">
            <img class="card-image" src="{{ $thumbnailUrl }}" alt="{{ __('Captura de pantalla de') }} {{ $title }}"
                width="600" height="400" loading="lazy">
            <button class="card-quick-view" aria-label="{{ __('Vista rápida') }}: {{ $title }}"
                data-open-modal="{{ $project->id }}">
                {{ __('Vista rápida') }}
            </button>
        </div>

        <div class="card-body">
            <div class="card-badges">
                @if ($categoryName)
                    <span class="badge" data-type="category">{{ $categoryName }}</span>
                @endif
                @if ($courseName)
                    <span class="badge" data-cycle="{{ strtolower($courseCode) }}">{{ $courseName }}</span>
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
