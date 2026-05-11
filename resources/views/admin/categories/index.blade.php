<x-layouts.admin :title="__('admin.categories.title')">

    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.categories.title')],
    ]" />

    <x-admin.ui.confirm-delete id="confirm-delete-category" :title-key="'admin.categories.delete_modal_title'">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('admin.categories.title') }}</h1>
                <p class="text-sm opacity-70">
                    {{ __('admin.categories.count', ['count' => $categories->total()]) }}
                </p>
            </div>

            @can('categories.create')
                <x-admin.ui.button :href="route('categories.create')" icon="icofont-plus">
                    {{ __('admin.categories.create') }}
                </x-admin.ui.button>
            @endcan
        </div>

        <x-admin.ui.card>

            <x-admin.table.filters :action="route('categories.index')" :search-placeholder="__('admin.categories.search_placeholder')" />

            <x-admin.table.index :items="$categories" :columns="[
                ['label' => __('admin.categories.col_name'), 'key' => null, 'sortable' => false],
                // ['label' => __('admin.categories.col_icon'),    'key' => null,         'sortable' => false],
                ['label' => __('admin.categories.col_courses'), 'key' => null, 'sortable' => false],
                ['label' => __('admin.common.created_at'), 'key' => 'created_at', 'sortable' => true],
                ['label' => '', 'key' => null, 'sortable' => false],
            ]">

                @foreach ($categories as $category)
                    <tr class="hover">
                        <td class="font-medium">{{ $category->name }}</td>

                        {{-- <td>
                            <i class="{{ $category->icon }}" aria-hidden="true"></i>
                            <span class="text-xs opacity-60 ml-1">{{ $category->icon }}</span>
                        </td> --}}

                        <td>
                            <x-admin.ui.badge color="neutral">
                                {{ $category->courses_count }}
                            </x-admin.ui.badge>
                        </td>

                        <td class="text-sm opacity-70">
                            {{ $category->created_at->format('d/m/Y') }}
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('categories.update')
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('categories.delete')
                                    <button type="button" class="btn btn-ghost btn-xs btn-square"
                                        @click="deleteName = @js($category->name); deleteUrl = '{{ route('categories.destroy', $category) }}'; $nextTick(() => document.getElementById('confirm-delete-category').showModal())">
                                        <i class="icofont-ui-delete text-error text-base"></i>
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-slot name="empty">
                    <x-admin.table.empty icon="icofont-listine-dots" :message="__('admin.categories.empty')" />
                </x-slot>

                <x-slot name="perPage">
                    <x-admin.table.per-page :current="request('per_page', 10)" />
                </x-slot>

            </x-admin.table.index>

        </x-admin.ui.card>

    </x-admin.ui.confirm-delete>

</x-layouts.admin>
