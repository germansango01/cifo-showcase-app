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
        <x-admin.table.index :items="$roles" :columns="[
            __('admin.roles.col_role'),
            __('admin.roles.col_perms'),
            __('admin.roles.col_users'),
            '',
        ]">
            @forelse($roles as $role)
                <tr>
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
                            <x-admin.table.actions :edit-url="route('roles.edit', $role)" :delete-url="route('roles.destroy', $role)"
                                :delete-confirm="__('admin.roles.delete_confirm', ['name' => $role->name])"
                                edit-permission="roles.update" delete-permission="roles.delete" />
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
