<x-layouts.admin :title="__('admin.common.view') . ' · ' . $project->getTranslation('title', 'es', false)">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.projects.title'), 'href' => route('admin.projects.index')],
        ['label' => $project->getTranslation('title', 'es', false)],
    ]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ $project->title }}</h1>
            <p class="text-sm opacity-70 mt-0.5">
                <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $project->getTranslation('slug', 'es', false) }}</code>
            </p>
        </div>
        <div class="flex gap-2 flex-shrink-0">
            @can('projects.update')
                <x-admin.ui.button :href="route('admin.projects.edit', $project)" variant="warning" size="sm" icon="icofont-edit">
                    {{ __('admin.common.edit') }}
                </x-admin.ui.button>
            @endcan
            <x-admin.ui.button :href="route('admin.projects.index')" variant="neutral" size="sm" :ghost="true">
                {{ __('admin.common.back') }}
            </x-admin.ui.button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── Left column (2/3) ── --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Gallery --}}
            @if ($project->getMedia('images')->isNotEmpty())
                <x-admin.ui.card>
                    <h2 class="text-base font-semibold mb-3">{{ __('admin.projects.images') }}</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                        @foreach ($project->getMedia('images') as $media)
                            @php $isFeatured = (bool) $media->getCustomProperty('is_featured'); @endphp
                            <div class="relative rounded-lg overflow-hidden aspect-video border-2 {{ $isFeatured ? 'border-warning' : 'border-base-300' }}">
                                <img src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}"
                                    class="w-full h-full object-cover" loading="lazy" />
                                @if ($isFeatured)
                                    <span class="absolute top-1 left-1 badge badge-warning badge-xs gap-1">
                                        <i class="icofont-star text-xs"></i>
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </x-admin.ui.card>
            @endif

            {{-- Descriptions --}}
            <x-admin.ui.card>
                <h2 class="text-base font-semibold mb-3">{{ __('admin.projects.description') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide opacity-50 mb-1">ES</p>
                        <div class="prose prose-sm max-w-none opacity-80">
                            {!! nl2br(e($project->getTranslation('description', 'es', false) ?? '—')) !!}
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide opacity-50 mb-1">CA</p>
                        <div class="prose prose-sm max-w-none opacity-80">
                            {!! nl2br(e($project->getTranslation('description', 'ca', false) ?? '—')) !!}
                        </div>
                    </div>
                </div>
            </x-admin.ui.card>

            {{-- Files --}}
            @if ($project->files->isNotEmpty())
                <x-admin.ui.card>
                    <h2 class="text-base font-semibold mb-3">{{ __('admin.projects.section_files') }}</h2>
                    <ul class="space-y-2">
                        @foreach ($project->files as $file)
                            <li class="flex items-center gap-3 text-sm">
                                <x-admin.ui.badge color="neutral" size="sm">{{ $file->type }}</x-admin.ui.badge>
                                <a href="{{ $file->url }}" target="_blank" rel="noopener noreferrer"
                                    class="link link-primary truncate">{{ $file->url }}</a>
                                @if ($file->label)
                                    <span class="opacity-50 text-xs truncate">{{ $file->label }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </x-admin.ui.card>
            @endif

        </div>

        {{-- ── Right column (1/3) ── --}}
        <div class="space-y-6">

            {{-- Metadata --}}
            <x-admin.ui.card>
                <h2 class="text-base font-semibold mb-3">{{ __('admin.projects.section_metadata') }}</h2>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between gap-2">
                        <dt class="opacity-60">{{ __('admin.projects.status') }}</dt>
                        <dd>
                            @php
                                $statusColor = match($project->status) {
                                    'published' => 'success',
                                    'pending'   => 'warning',
                                    'rejected'  => 'error',
                                    default     => 'neutral',
                                };
                            @endphp
                            <x-admin.ui.badge :color="$statusColor">
                                {{ __('admin.projects.status_' . $project->status) }}
                            </x-admin.ui.badge>
                        </dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="opacity-60">{{ __('admin.projects.featured') }}</dt>
                        <dd>
                            @if ($project->featured)
                                <i class="icofont-star text-warning"></i>
                            @else
                                <span class="opacity-40">—</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="opacity-60">{{ __('admin.projects.course') }}</dt>
                        <dd class="font-medium">
                            @if ($project->course)
                                <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">
                                    {{ $project->course->course_code }}
                                </code>
                                <span class="ml-1 text-xs opacity-70">{{ $project->course->name }}</span>
                            @else
                                <span class="opacity-40">—</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between gap-2">
                        <dt class="opacity-60">{{ __('admin.projects.date') }}</dt>
                        <dd>{{ $project->project_date->format('m/Y') }}</dd>
                    </div>
                    @if ($project->repo_url)
                        <div class="flex justify-between gap-2">
                            <dt class="opacity-60">{{ __('admin.projects.repo_url') }}</dt>
                            <dd><a href="{{ $project->repo_url }}" target="_blank" rel="noopener noreferrer"
                                class="link link-primary text-xs truncate max-w-[140px] block">
                                {{ $project->repo_url }}
                            </a></dd>
                        </div>
                    @endif
                    @if ($project->live_url)
                        <div class="flex justify-between gap-2">
                            <dt class="opacity-60">{{ __('admin.projects.live_url') }}</dt>
                            <dd><a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                                class="link link-primary text-xs truncate max-w-[140px] block">
                                {{ $project->live_url }}
                            </a></dd>
                        </div>
                    @endif
                </dl>
            </x-admin.ui.card>

            {{-- Tags --}}
            <x-admin.ui.card>
                <h2 class="text-base font-semibold mb-3">{{ __('admin.projects.tags') }}</h2>
                @if ($project->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach ($project->tags as $tag)
                            <x-admin.ui.badge color="primary">{{ $tag->name }}</x-admin.ui.badge>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm opacity-40">—</p>
                @endif
            </x-admin.ui.card>

            {{-- Students --}}
            <x-admin.ui.card>
                <h2 class="text-base font-semibold mb-3">{{ __('admin.projects.students') }}</h2>
                @if ($project->students->isNotEmpty())
                    <ul class="space-y-1.5">
                        @foreach ($project->students as $student)
                            <li class="flex items-center gap-2 text-sm">
                                <x-admin.ui.avatar :name="$student->name" size="sm" />
                                <div>
                                    <p class="font-medium leading-none">{{ $student->name }}</p>
                                    @if ($student->email)
                                        <p class="text-xs opacity-50">{{ $student->email }}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm opacity-40">{{ __('admin.projects.no_students') }}</p>
                @endif
            </x-admin.ui.card>

            {{-- Timestamps --}}
            <div class="flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-40 px-1">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $project->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $project->updated_at->format('d/m/Y H:i') }}</span>
            </div>

        </div>
    </div>

</x-layouts.admin>
