<x-layouts.admin :title="__('admin.projects.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.projects.title')],
    ]" />

    <x-admin.ui.confirm-delete id="confirm-delete-project" :title-key="'admin.projects.delete_modal_title'" name-var="deleteTitle">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('admin.projects.title') }}</h1>
                <p class="text-sm opacity-70">
                    {{ __('admin.projects.count', ['count' => $projects->total()]) }}
                </p>
            </div>

            @can('projects.create')
                <x-admin.ui.button :href="route('projects.create')" icon="icofont-plus">
                    {{ __('admin.projects.create') }}
                </x-admin.ui.button>
            @endcan
        </div>

        <x-admin.ui.card>

            <x-admin.table.filters :action="route('projects.index')" :search-placeholder="__('admin.projects.search_placeholder')">
                <x-admin.ui.select
                    name="status"
                    :options="collect(['draft', 'pending', 'published', 'rejected'])->mapWithKeys(fn ($s) => [$s => __('admin.projects.status_' . $s)])->toArray()"
                    :selected="request('status')"
                    :placeholder="__('admin.projects.filter_status_all')"
                    onchange="this.form.submit()" />

                <x-admin.ui.select
                    name="course"
                    :options="$courses->mapWithKeys(fn ($c) => [$c->id => $c->course_code . ' – ' . $c->name])->toArray()"
                    :selected="request('course')"
                    :placeholder="__('admin.projects.filter_course_all')"
                    onchange="this.form.submit()" />
            </x-admin.table.filters>

            <x-admin.table.index :items="$projects" :columns="[
                ['label' => __('admin.projects.col_title'),  'key' => null,           'sortable' => false],
                ['label' => __('admin.projects.col_course'), 'key' => null,           'sortable' => false],
                ['label' => __('admin.projects.col_status'), 'key' => 'status',       'sortable' => true],
                ['label' => __('admin.projects.col_date'),   'key' => 'project_date', 'sortable' => true],
                ['label' => '',                              'key' => null,           'sortable' => false],
            ]">

                @foreach ($projects as $project)
                    @php
                        $statusColor = match($project->status) {
                            'published' => 'success',
                            'pending'   => 'warning',
                            'rejected'  => 'error',
                            default     => 'neutral',
                        };
                    @endphp
                    <tr class="hover">
                        <td>
                            <div class="flex items-center gap-2">
                                @if ($project->featured)
                                    <i class="icofont-star text-warning text-sm" title="{{ __('admin.projects.featured') }}"></i>
                                @endif
                                <span class="font-medium text-sm">{{ $project->title }}</span>
                            </div>
                        </td>

                        <td>
                            @if ($project->course)
                                <code class="text-xs font-mono bg-base-200 px-2 py-0.5 rounded">
                                    {{ $project->course->course_code }}
                                </code>
                            @else
                                <span class="text-xs opacity-40">—</span>
                            @endif
                        </td>

                        <td>
                            <x-admin.ui.badge :color="$statusColor">
                                {{ __('admin.projects.status_' . $project->status) }}
                            </x-admin.ui.badge>
                        </td>

                        <td class="text-sm opacity-70">
                            {{ $project->project_date->format('d/m/Y') }}
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('projects.update')
                                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('projects.delete')
                                    <button type="button" class="btn btn-ghost btn-xs btn-square"
                                        @click="deleteTitle = @js($project->title); deleteUrl = '{{ route('projects.destroy', $project) }}'; $nextTick(() => document.getElementById('confirm-delete-project').showModal())">
                                        <i class="icofont-ui-delete text-error text-base"></i>
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-slot name="empty">
                    <x-admin.table.empty icon="icofont-image" :message="__('admin.projects.empty')" />
                </x-slot>

                <x-slot name="perPage">
                    <x-admin.table.per-page :current="request('per_page', 10)" />
                </x-slot>

            </x-admin.table.index>

        </x-admin.ui.card>

    </x-admin.ui.confirm-delete>

</x-layouts.admin>
