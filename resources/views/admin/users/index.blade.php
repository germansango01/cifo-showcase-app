<x-layouts.admin :title="__('admin.users.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.users.title')],
    ]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ __('admin.users.title') }}</h1>
            <p class="text-sm opacity-70">{{ __('admin.users.registered_count', ['count' => $users->total()]) }}</p>
        </div>
        @can('users.create')
            <x-admin.ui.button :href="route('users.create')" icon="icofont-plus">
                {{ __('admin.users.create') }}
            </x-admin.ui.button>
        @endcan
    </div>

    <x-admin.ui.card>
        <x-admin.table.filters :action="route('users.index')">
            <div class="flex flex-col sm:flex-row gap-3 w-full">
                <label class="input input-bordered flex items-center gap-2 flex-1">
                    <i class="icofont-search-1 opacity-60"></i>
                    <input type="search" name="search" value="{{ request('search') }}"
                        placeholder="{{ __('admin.users.search_placeholder') }}" class="grow"
                        aria-label="{{ __('admin.users.search_placeholder') }}" />
                </label>

                <select name="role" class="select select-bordered w-full sm:w-48"
                    aria-label="{{ __('admin.common.filter') }}">
                    <option value="">{{ __('admin.users.all_roles') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @selected(request('role') === $role->name)>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </x-admin.table.filters>

        <x-admin.table.index :items="$users" :columns="[
            __('admin.users.col_user'),
            __('admin.users.col_email'),
            __('admin.users.col_roles'),
            __('admin.users.col_registered'),
            '',
        ]">
            @forelse($users as $user)
                <tr class="hover">
                    <td>
                        <div class="flex items-center gap-3">
                            <x-admin.ui.avatar :name="$user->name" :src="$user->profile_photo_url ?? null" size="sm" />
                            <div>
                                <div class="font-medium">{{ $user->name }}</div>
                                <div class="text-xs opacity-60">#{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-sm">{{ $user->email }}</span>
                        @if ($user->email_verified_at)
                            <i class="icofont-check-circled text-success text-xs ml-1"
                                title="{{ __('admin.users.email_verified_title') }}"></i>
                        @else
                            <i class="icofont-warning-alt text-warning text-xs ml-1"
                                title="{{ __('admin.users.email_not_verified_title') }}"></i>
                        @endif
                    </td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @forelse($user->roles as $role)
                                <x-admin.ui.badge :label="$role->name"
                                    color="{{ match ($role->name) {
                                        'Super Admin' => 'error',
                                        'Admin' => 'warning',
                                        'Editor' => 'info',
                                        default => 'neutral',
                                    } }}" />
                            @empty
                                <span class="text-xs opacity-50">{{ __('admin.users.no_roles') }}</span>
                            @endforelse
                        </div>
                    </td>
                    <td>
                        <span class="text-sm">{{ $user->created_at->format('d/m/Y') }}</span>
                        <div class="text-xs opacity-50">{{ $user->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="text-right">
                        <x-admin.table.actions>
                            @can('users.view')
                                <x-admin.ui.button :href="route('users.show', $user)" variant="ghost" size="xs" icon="icofont-eye"
                                    aria-label="{{ __('admin.common.view') }} {{ $user->name }}">{{ __('admin.common.view') }}</x-admin.ui.button>
                            @endcan

                            @can('users.update')
                                <x-admin.ui.button :href="route('users.edit', $user)" variant="ghost" size="xs" icon="icofont-edit"
                                    aria-label="{{ __('admin.common.edit') }} {{ $user->name }}">{{ __('admin.common.edit') }}</x-admin.ui.button>
                            @endcan

                            @can('users.delete')
                                @if (auth()->id() !== $user->id)
                                    <button type="button" class="btn btn-ghost btn-xs text-error"
                                        aria-label="{{ __('admin.users.delete_btn') }} {{ $user->name }}"
                                        @click="deleteId = {{ $user->id }}; deleteName = '{{ addslashes($user->name) }}'; $refs.deleteModal.showModal()">
                                        <i class="icofont-ui-delete"></i> {{ __('admin.common.delete') }}
                                    </button>
                                @endif
                            @endcan
                        </x-admin.table.actions>
                    </td>
                </tr>
            @empty
                <x-admin.table.empty colspan="5" icon="icofont-users"
                    message="{{ __('admin.common.no_results') }}" />
            @endforelse
        </x-admin.table.index>
    </x-admin.ui.card>

    {{-- Modal confirmación delete — único, reutilizado para todas las filas --}}
    @can('users.delete')
        <div x-data="{ deleteId: null, deleteName: '' }" @keydown.escape.window="$refs.deleteModal.close()">
            <x-admin.ui.modal id="confirm-delete-user" :title="__('admin.users.delete_modal_title')" size="sm">
                <p class="text-sm opacity-80 mb-2">
                    {{ __('admin.users.delete_confirm_prefix') }}
                    <strong x-text="deleteName" class="text-base-content"></strong>?
                </p>
                <p class="text-xs text-error opacity-80">{{ __('admin.common.irreversible') }}</p>

                <x-slot name="actions">
                    <form method="POST" x-bind:action="`{{ url('admin/users') }}/${deleteId}`">
                        @csrf
                        @method('DELETE')
                        <div class="flex gap-2 justify-end">
                            <button type="button" class="btn btn-ghost btn-sm"
                                onclick="confirm-delete-user.close()">{{ __('admin.common.cancel') }}</button>
                            <x-admin.ui.button type="submit" variant="error" size="sm"
                                icon="icofont-ui-delete">{{ __('admin.common.delete') }}</x-admin.ui.button>
                        </div>
                    </form>
                </x-slot>
            </x-admin.ui.modal>

            {{-- Trigger oculto para abrir el modal desde los botones de la tabla --}}
            <span x-ref="deleteModal" x-init="$watch('deleteId', v => v && document.getElementById('confirm-delete-user').showModal())"></span>
        </div>
    @endcan
</x-layouts.admin>
