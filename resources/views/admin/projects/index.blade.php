<x-layouts.admin :title="__('admin.projects.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.projects.title')],
    ]" />

    <div
        x-data="{ deleteId: null, deleteTitle: '' }"
        @keydown.escape.window="const m = document.getElementById('confirm-delete-project'); if (m) m.close()">

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

            {{-- Filtros --}}
            <x-admin.table.filters :action="route('projects.index')" :search-placeholder="__('admin.projects.search_placeholder')">
                <select name="status" class="select select-bordered select-sm">
                    <option value="">{{ __('admin.projects.filter_status_all') }}</option>
                    @foreach (['draft', 'pending', 'published', 'rejected'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>
                            {{ __('admin.projects.status_' . $s) }}
                        </option>
                    @endforeach
                </select>

                <select name="course" class="select select-bordered select-sm">
                    <option value="">{{ __('admin.projects.filter_course_all') }}</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" @selected(request('course') == $course->id)>
                            {{ $course->course_code }} – {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </x-admin.table.filters>

            {{-- Tabla --}}
            <x-admin.table.index :items="$projects" :columns="[
                ['label' => __('admin.projects.col_title'),   'key' => null, 'sortable' => false],
                ['label' => __('admin.projects.col_course'),  'key' => null, 'sortable' => false],
                ['label' => __('admin.projects.col_status'),  'key' => null, 'sortable' => false],
                ['label' => __('admin.projects.col_date'),    'key' => null, 'sortable' => false],
                ['label' => '',                               'key' => null, 'sortable' => false],
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
                                        @click="deleteId = {{ $project->id }}; deleteTitle = @js($project->title); $nextTick(() => document.getElementById('confirm-delete-project').showModal())">
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

            </x-admin.table.index>

        </x-admin.ui.card>

        {{-- Modal eliminar --}}
        @can('projects.delete')
            <x-admin.ui.modal id="confirm-delete-project" :title="__('admin.projects.delete_modal_title')" size="sm">
                <p class="text-sm opacity-80 mb-2">
                    {{ __('admin.projects.delete_confirm') }}
                    <strong x-text="deleteTitle"></strong>?
                </p>
                <p class="text-xs text-error opacity-80">{{ __('admin.common.irreversible') }}</p>

                <x-slot name="actions">
                    <form method="POST" :action="`{{ url('admin/projects') }}/${deleteId}`">
                        @csrf
                        @method('DELETE')
                        <div class="flex gap-2 justify-end">
                            <button type="button" class="btn btn-ghost btn-sm"
                                onclick="document.getElementById('confirm-delete-project').close()">
                                {{ __('admin.common.cancel') }}
                            </button>
                            <x-admin.ui.button type="submit" variant="error" size="sm" icon="icofont-ui-delete">
                                {{ __('admin.common.delete') }}
                            </x-admin.ui.button>
                        </div>
                    </form>
                </x-slot>
            </x-admin.ui.modal>
        @endcan

    </div>{{-- /x-data --}}

</x-layouts.admin>
