<x-layouts.admin :title="__('admin.categories.title')">

    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.categories.title')],
    ]" />

    <div x-data="{ deleteId: null, deleteName: '' }"
         @keydown.escape.window="document.getElementById('confirm-delete-category')?.close()">

        <div class="flex justify-between items-center mb-6">
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

            <x-admin.table.filters :action="route('categories.index')" />

            <x-admin.table.index :items="$categories" :columns="[
                ['label' => __('admin.categories.name'), 'sortable' => false],
                ['label' => __('admin.categories.icon'), 'sortable' => false],
                ['label' => '', 'sortable' => false],
            ]">

                @foreach ($categories as $category)
                    <tr>
                        <td class="font-medium">{{ $category->name }}</td>

                        <td>
                            <i class="{{ $category->icon }}"></i>
                            <span class="text-xs opacity-60">{{ $category->icon }}</span>
                        </td>

                        <td class="text-right">
                            @can('categories.update')
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="btn btn-ghost btn-xs">
                                    <i class="icofont-edit"></i>
                                </a>
                            @endcan

                            @can('categories.delete')
                                <button class="btn btn-ghost btn-xs"
                                    @click="deleteId = {{ $category->id }};
                                            deleteName = @js($category->name);
                                            document.getElementById('confirm-delete-category').showModal()">
                                    <i class="icofont-ui-delete text-error"></i>
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </x-admin.table.index>

        </x-admin.ui.card>

        @can('categories.delete')
            <x-admin.ui.modal id="confirm-delete-category" title="Delete Category">
                <p class="text-sm mb-3">
                    {{ __('admin.common.delete_confirm') }}
                    <strong x-text="deleteName"></strong>?
                </p>

                <form method="POST" :action="`/admin/categories/${deleteId}`">
                    @csrf @method('DELETE')

                    <div class="flex justify-end gap-2">
                        <button type="button" class="btn btn-ghost btn-sm"
                                onclick="document.getElementById('confirm-delete-category').close()">
                            Cancel
                        </button>

                        <x-admin.ui.button variant="error" type="submit">
                            Delete
                        </x-admin.ui.button>
                    </div>
                </form>
            </x-admin.ui.modal>
        @endcan

    </div>

</x-layouts.admin>