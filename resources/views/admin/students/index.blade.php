<x-layouts.admin :title="__('admin.students.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.students.title')],
    ]" />

    <x-admin.ui.confirm-delete id="confirm-delete-student" :title-key="'admin.students.delete_modal_title'">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('admin.students.title') }}</h1>
                <p class="text-sm opacity-70">
                    {{ __('admin.students.count', ['count' => $students->total()]) }}
                </p>
            </div>

            @can('students.create')
                <x-admin.ui.button :href="route('students.create')" icon="icofont-plus">
                    {{ __('admin.students.create') }}
                </x-admin.ui.button>
            @endcan
        </div>

        <x-admin.ui.card>

            <x-admin.table.filters :action="route('students.index')" :search-placeholder="__('admin.students.search_placeholder')" />

            <x-admin.table.index :items="$students" :columns="[
                ['label' => __('admin.students.col_name'),     'key' => 'name',       'sortable' => true],
                ['label' => __('admin.students.col_email'),    'key' => 'email',      'sortable' => true],
                ['label' => __('admin.students.col_projects'), 'key' => null,         'sortable' => false],
                ['label' => __('admin.common.created_at'),     'key' => 'created_at', 'sortable' => true],
                ['label' => '',                                'key' => null,         'sortable' => false],
            ]">

                @foreach ($students as $student)
                    <tr class="hover">
                        <td>
                            <div class="font-medium text-sm">{{ $student->name }}</div>
                        </td>

                        <td>
                            <span class="text-sm">{{ $student->email }}</span>
                        </td>

                        <td>
                            <x-admin.ui.badge color="neutral">
                                {{ $student->projects_count }}
                            </x-admin.ui.badge>
                        </td>

                        <td class="text-sm opacity-70">
                            {{ $student->created_at->format('d/m/Y') }}
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('students.update')
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('students.delete')
                                    <button type="button" class="btn btn-ghost btn-xs btn-square"
                                        @click="deleteName = @js($student->name); deleteUrl = '{{ route('students.destroy', $student) }}'; $nextTick(() => document.getElementById('confirm-delete-student').showModal())">
                                        <i class="icofont-ui-delete text-error text-base"></i>
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-slot name="empty">
                    <x-admin.table.empty icon="icofont-student-alt" :message="__('admin.students.empty')" />
                </x-slot>

                <x-slot name="perPage">
                    <x-admin.table.per-page :current="request('per_page', 10)" />
                </x-slot>

            </x-admin.table.index>

        </x-admin.ui.card>

    </x-admin.ui.confirm-delete>

</x-layouts.admin>
