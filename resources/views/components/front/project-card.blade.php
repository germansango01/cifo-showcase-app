{{--
 * resources/views/components/front/project-card.blade.php
 *
 * Reusable project card for home featured grid and projects catalog.
 *
 * @prop \App\Models\Project $project
 --}}

@props(['project'])

<article class="card" data-project-id="{{ $project->id }}" data-course="{{ $project->cycle }}" data-year="{{ $project->year }}" data-professor="{{ Str::slug($project->professor->name ?? '') }}">
    <div class="card-surface">

        <div class="card-media">
            <img class="card-image" src="{{ $project->thumbnail_url }}" alt="{{ __('Captura de pantalla de') }} {{ $project->title }}" width="600" height="400" loading="lazy">
            <button class="card-quick-view" aria-label="{{ __('Vista rápida') }}: {{ $project->title }}" data-open-modal="{{ $project->id }}">
                {{ __('Vista rápida') }}
            </button>
        </div>

        <div class="card-body">
            <div class="card-badges">
                <span class="badge" data-cycle="{{ strtolower($project->cycle) }}">{{ $project->cycle }}</span>
                <span class="badge" data-type="year">{{ $project->year }}</span>
            </div>
            <h3 class="card-title">{{ $project->title }}</h3>
            <p class="card-description">{{ $project->short_description }}</p>
            <footer>
                <span class="card-student">{{ $project->student->name ?? '' }}</span>
                <span class="card-professor">Prof. {{ $project->professor->name ?? '' }}</span>
            </footer>
        </div>

    </div>
</article>
