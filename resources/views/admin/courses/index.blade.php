<x-layouts.admin :title="__('admin.courses.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.courses.title')],
    ]" />

    <x-admin.ui.confirm-delete id="confirm-delete-course" :title-key="'admin.courses.delete_modal_title'">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('admin.courses.title') }}</h1>
                <p class="text-sm opacity-70">
                    {{ __('admin.courses.count', ['count' => $courses->total()]) }}
                </p>
            </div>

            @can('courses.create')
                <x-admin.ui.button :href="route('courses.create')" icon="icofont-plus">
                    {{ __('admin.courses.create') }}
                </x-admin.ui.button>
            @endcan
        </div>

        <x-admin.ui.card>

            <x-admin.table.filters :action="route('courses.index')" :search-placeholder="__('admin.courses.search_placeholder')">
                <x-admin.ui.select name="category" :options="$categories->pluck('name', 'id')->toArray()" :selected="request('category')" :placeholder="__('admin.courses.category_placeholder')"
                    onchange="this.form.submit()" />
            </x-admin.table.filters>

            <x-admin.table.index :items="$courses" :columns="[
                ['label' => __('admin.courses.col_code'), 'key' => 'course_code', 'sortable' => true],
                ['label' => __('admin.courses.col_name'), 'key' => null, 'sortable' => false],
                ['label' => __('admin.courses.col_category'), 'key' => null, 'sortable' => false],
                ['label' => __('admin.courses.col_projects'), 'key' => null, 'sortable' => false],
                ['label' => __('admin.common.created_at'), 'key' => 'created_at', 'sortable' => true],
                ['label' => '', 'key' => null, 'sortable' => false],
            ]">

                @foreach ($courses as $course)
                    <tr class="hover">
                        <td>
                            <code
                                class="text-xs font-mono bg-base-200 px-2 py-0.5 rounded">{{ $course->course_code }}</code>
                        </td>

                        <td>
                            <span class="font-medium text-sm">{{ $course->name }}</span>
                        </td>

                        <td>
                            @if ($course->category)
                                <x-admin.ui.badge color="primary">
                                    {{ $course->category->name }}
                                </x-admin.ui.badge>
                            @else
                                <span class="text-xs opacity-40">—</span>
                            @endif
                        </td>

                        <td>
                            <x-admin.ui.badge color="neutral">
                                {{ $course->projects_count }}
                            </x-admin.ui.badge>
                        </td>

                        <td class="text-sm opacity-70">
                            {{ $course->created_at->format('d/m/Y') }}
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('courses.update')
                                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('courses.delete')
                                    <button type="button" class="btn btn-ghost btn-xs btn-square"
                                        @click="deleteName = @js($course->course_code . ' – ' . $course->name); deleteUrl = '{{ route('courses.destroy', $course) }}'; $nextTick(() => document.getElementById('confirm-delete-course').showModal())">
                                        <i class="icofont-ui-delete text-error text-base"></i>
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-slot name="empty">
                    <x-admin.table.empty icon="icofont-book-alt" :message="__('admin.courses.empty')" />
                </x-slot>

                <x-slot name="perPage">
                    <x-admin.table.per-page :current="request('per_page', 10)" />
                </x-slot>

            </x-admin.table.index>

        </x-admin.ui.card>

    </x-admin.ui.confirm-delete>

</x-layouts.admin>
