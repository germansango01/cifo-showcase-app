<x-layouts.admin :title="__('admin.tags.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.tags.title')],
    ]" />

    <div
        x-data="{ deleteId: null, deleteName: '' }"
        @keydown.escape.window="const m = document.getElementById('confirm-delete-tag'); if (m) m.close()">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('admin.tags.title') }}</h1>
                <p class="text-sm opacity-70">
                    {{ __('admin.tags.count', ['count' => $tags->total()]) }}
                </p>
            </div>

            @can('tags.create')
                <x-admin.ui.button :href="route('tags.create')" icon="icofont-plus">
                    {{ __('admin.tags.create') }}
                </x-admin.ui.button>
            @endcan
        </div>

        <x-admin.ui.card>

            {{-- Filtros --}}
            <x-admin.table.filters :action="route('tags.index')" :search-placeholder="__('admin.tags.search_placeholder')" />

            {{-- Tabla --}}
            <x-admin.table.index :items="$tags" :columns="[
                ['label' => __('admin.tags.col_name'), 'key' => 'name', 'sortable' => false],
                ['label' => __('admin.tags.col_slug'), 'key' => null, 'sortable' => false],
                ['label' => __('admin.tags.col_projects'), 'key' => null, 'sortable' => false],
                ['label' => '', 'key' => null, 'sortable' => false],
            ]">

                @foreach ($tags as $tag)
                    <tr class="hover">
                        <td>
                            <span class="font-medium text-sm">{{ $tag->name }}</span>
                        </td>

                        <td>
                            <code class="text-xs opacity-60 bg-base-200 px-2 py-0.5 rounded">{{ $tag->slug }}</code>
                        </td>

                        <td>
                            <x-admin.ui.badge color="neutral">
                                {{ $tag->projects_count }}
                            </x-admin.ui.badge>
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('tags.update')
                                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('tags.delete')
                                    <button type="button" class="btn btn-ghost btn-xs btn-square"
                                        @click="deleteId = {{ $tag->id }}; deleteName = @js($tag->name); $nextTick(() => document.getElementById('confirm-delete-tag').showModal())">
                                        <i class="icofont-ui-delete text-error text-base"></i>
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-slot name="empty">
                    <x-admin.table.empty icon="icofont-price" :message="__('admin.tags.empty')" />
                </x-slot>

            </x-admin.table.index>

        </x-admin.ui.card>

        {{-- Modal eliminar --}}
        @can('tags.delete')
            <x-admin.ui.modal id="confirm-delete-tag" :title="__('admin.tags.delete_modal_title')" size="sm">
                <p class="text-sm opacity-80 mb-2">
                    {{ __('admin.tags.delete_confirm') }}
                    <strong x-text="deleteName"></strong>?
                </p>

                <p class="text-xs text-error opacity-80">
                    {{ __('admin.common.irreversible') }}
                </p>

                <x-slot name="actions">
                    <form method="POST" :action="`{{ url('admin/tags') }}/${deleteId}`">
                        @csrf
                        @method('DELETE')

                        <div class="flex gap-2 justify-end">
                            <button type="button" class="btn btn-ghost btn-sm"
                                onclick="document.getElementById('confirm-delete-tag').close()">
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
