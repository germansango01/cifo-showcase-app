<x-layouts.admin :title="__('admin.roles.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.roles.title')],
    ]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ __('admin.roles.title') }}</h1>
            <p class="text-sm opacity-70">{{ __('admin.roles.count', ['count' => $roles->total()]) }}</p>
        </div>
        @can('roles.create')
            <x-admin.ui.button :href="route('roles.create')" icon="icofont-plus">
                {{ __('admin.roles.create') }}
            </x-admin.ui.button>
        @endcan
    </div>

    <x-admin.ui.card>
        <x-admin.table.index :items="$roles" :columns="[__('admin.roles.col_role'), __('admin.roles.col_perms'), __('admin.roles.col_users'), '']">
            @forelse($roles as $role)
                <tr class="hover">
                    <td>
                        <div class="flex items-center gap-2">
                            <i class="icofont-shield text-primary text-lg"></i>
                            <span class="font-medium">{{ $role->name }}</span>
                            @if ($role->name === 'Super Admin')
                                <x-admin.ui.badge color="warning">{{ __('admin.common.system') }}</x-admin.ui.badge>
                            @endif
                        </div>
                    </td>
                    <td>
                        <x-admin.ui.badge color="info">
                            {{ __('admin.roles.perm_count', ['count' => $role->permissions_count]) }}
                        </x-admin.ui.badge>
                    </td>
                    <td>
                        <x-admin.ui.badge color="neutral">
                            {{ __('admin.roles.user_count', ['count' => $role->users_count]) }}
                        </x-admin.ui.badge>
                    </td>
                    <td class="text-right">
                        @if ($role->name !== 'Super Admin')
                            <div class="flex items-center gap-1 justify-end">
                                @can('roles.update')
                                    <div class="tooltip tooltip-left" data-tip="{{ __('admin.common.edit') }}">
                                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-ghost btn-xs btn-square">
                                            <i class="icofont-edit text-base text-warning"></i>
                                        </a>
                                    </div>
                                @endcan
                                @can('roles.delete')
                                    <div class="tooltip tooltip-left" data-tip="{{ __('admin.common.delete') }}">
                                        <button type="button" class="btn btn-ghost btn-xs btn-square"
                                            onclick="document.getElementById('del-role-{{ $role->id }}').showModal()">
                                            <i class="icofont-ui-delete text-base text-error"></i>
                                        </button>
                                    </div>
                                    <dialog id="del-role-{{ $role->id }}" class="modal modal-bottom sm:modal-middle">
                                        <div class="modal-box">
                                            <h3 class="font-bold text-lg flex items-center gap-2">
                                                <i class="icofont-warning-alt text-warning text-2xl"></i>
                                                {{ __('admin.common.confirm_delete') }}
                                            </h3>
                                            <p class="py-4 text-base-content/70">
                                                {{ __('admin.roles.delete_confirm', ['name' => $role->name]) }}
                                            </p>
                                            <div class="modal-action gap-2">
                                                <form method="dialog">
                                                    <button class="btn btn-ghost">{{ __('admin.common.cancel') }}</button>
                                                </form>
                                                <form method="POST" action="{{ route('roles.destroy', $role) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-error gap-2">
                                                        <i class="icofont-ui-delete"></i>
                                                        {{ __('admin.common.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <form method="dialog" class="modal-backdrop">
                                            <button>{{ __('admin.common.close') }}</button>
                                        </form>
                                    </dialog>
                                @endcan
                            </div>
                        @else
                            <span class="text-sm opacity-40 italic">{{ __('admin.common.protected') }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <x-admin.table.empty message="{{ __('admin.roles.empty') }}" colspan="4" />
            @endforelse
        </x-admin.table.index>
    </x-admin.ui.card>
</x-layouts.admin>
