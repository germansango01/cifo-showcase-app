<x-layouts.admin :title="__('admin.courses.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.courses.title')],
    ]" />

    <div
        x-data="{ deleteId: null, deleteName: '' }"
        @keydown.escape.window="const m = document.getElementById('confirm-delete-course'); if (m) m.close()">

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

            {{-- Filtros --}}
            <x-admin.table.filters :action="route('courses.index')" :search-placeholder="__('admin.courses.search_placeholder')">
                <select name="category" class="select select-bordered">
                    <option value="">{{ __('admin.courses.category_placeholder') }}</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>
                            {{ $cat->{'name_' . app()->getLocale()} ?? $cat->name_es }}
                        </option>
                    @endforeach
                </select>
            </x-admin.table.filters>

            {{-- Tabla --}}
            <x-admin.table.index :items="$courses" :columns="[
                ['label' => __('admin.courses.col_code'),     'key' => null, 'sortable' => false],
                ['label' => __('admin.courses.col_name'),     'key' => null, 'sortable' => false],
                ['label' => __('admin.courses.col_category'), 'key' => null, 'sortable' => false],
                ['label' => __('admin.courses.col_projects'), 'key' => null, 'sortable' => false],
                ['label' => '',                               'key' => null, 'sortable' => false],
            ]">

                @foreach ($courses as $course)
                    <tr class="hover">
                        <td>
                            <code class="text-xs font-mono bg-base-200 px-2 py-0.5 rounded">{{ $course->course_code }}</code>
                        </td>

                        <td>
                            <span class="font-medium text-sm">{{ $course->name }}</span>
                        </td>

                        <td>
                            @if ($course->category)
                                <x-admin.ui.badge color="primary">
                                    {{ $course->category->{'name_' . app()->getLocale()} ?? $course->category->name_es }}
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

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('courses.update')
                                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('courses.delete')
                                    <button type="button" class="btn btn-ghost btn-xs btn-square"
                                        @click="deleteId = {{ $course->id }}; deleteName = @js($course->course_code . ' – ' . $course->name); $nextTick(() => document.getElementById('confirm-delete-course').showModal())">
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

            </x-admin.table.index>

        </x-admin.ui.card>

        {{-- Modal eliminar --}}
        @can('courses.delete')
            <x-admin.ui.modal id="confirm-delete-course" :title="__('admin.courses.delete_modal_title')" size="sm">
                <p class="text-sm opacity-80 mb-2">
                    {{ __('admin.courses.delete_confirm') }}
                    <strong x-text="deleteName"></strong>?
                </p>

                <p class="text-xs text-error opacity-80">
                    {{ __('admin.common.irreversible') }}
                </p>

                <x-slot name="actions">
                    <form method="POST" :action="`{{ url('admin/courses') }}/${deleteId}`">
                        @csrf
                        @method('DELETE')

                        <div class="flex gap-2 justify-end">
                            <button type="button" class="btn btn-ghost btn-sm"
                                onclick="document.getElementById('confirm-delete-course').close()">
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
