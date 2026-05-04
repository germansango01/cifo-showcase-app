<x-layouts.admin :title="__('admin.teachers.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.teachers.title')],
    ]" />

    <x-admin.ui.confirm-delete id="confirm-delete-teacher" :title-key="'admin.teachers.delete_modal_title'">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('admin.teachers.title') }}</h1>
                <p class="text-sm opacity-70">
                    {{ __('admin.teachers.count', ['count' => $teachers->total()]) }}
                </p>
            </div>

            @can('teachers.create')
                <x-admin.ui.button :href="route('teachers.create')" icon="icofont-plus">
                    {{ __('admin.teachers.create') }}
                </x-admin.ui.button>
            @endcan
        </div>

        <x-admin.ui.card>

            <x-admin.table.filters :action="route('teachers.index')" :search-placeholder="__('admin.teachers.search_placeholder')" />

            <x-admin.table.index :items="$teachers" :columns="[
                ['label' => __('admin.teachers.col_name'),    'key' => 'name',       'sortable' => true],
                ['label' => __('admin.teachers.col_email'),   'key' => 'email',      'sortable' => true],
                ['label' => __('admin.teachers.col_courses'), 'key' => null,         'sortable' => false],
                ['label' => __('admin.common.created_at'),    'key' => 'created_at', 'sortable' => true],
                ['label' => '',                               'key' => null,         'sortable' => false],
            ]">

                @foreach ($teachers as $teacher)
                    <tr class="hover">
                        <td>
                            <div class="font-medium text-sm">{{ $teacher->name }}</div>
                        </td>

                        <td>
                            <span class="text-sm">{{ $teacher->email }}</span>
                        </td>

                        <td>
                            <x-admin.ui.badge color="neutral">
                                {{ $teacher->courses_count }}
                            </x-admin.ui.badge>
                        </td>

                        <td class="text-sm opacity-70">
                            {{ $teacher->created_at->format('d/m/Y') }}
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('teachers.update')
                                    <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('teachers.delete')
                                    <button type="button" class="btn btn-ghost btn-xs btn-square"
                                        @click="deleteName = @js($teacher->name); deleteUrl = '{{ route('teachers.destroy', $teacher) }}'; $nextTick(() => document.getElementById('confirm-delete-teacher').showModal())">
                                        <i class="icofont-ui-delete text-error text-base"></i>
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-slot name="empty">
                    <x-admin.table.empty icon="icofont-teacher" :message="__('admin.teachers.empty')" />
                </x-slot>

                <x-slot name="perPage">
                    <x-admin.table.per-page :current="request('per_page', 10)" />
                </x-slot>

            </x-admin.table.index>

        </x-admin.ui.card>

    </x-admin.ui.confirm-delete>

</x-layouts.admin>
