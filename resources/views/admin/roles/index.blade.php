<x-layouts.admin :title="'Roles'">
    <x-admin.ui.breadcrumb :items="[['label' => 'Dashboard', 'href' => route('dashboard')], ['label' => 'Roles']]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold">Roles</h1>
            <p class="text-sm opacity-70">{{ $roles->total() }} roles definidos</p>
        </div>
        @can('roles.create')
            <x-admin.ui.button :href="route('roles.create')" icon="icofont-plus">
                Nuevo rol
            </x-admin.ui.button>
        @endcan
    </div>

    <x-admin.ui.card>
        <x-admin.table.index :items="$roles" :columns="['Rol', 'Permisos', 'Usuarios', '']">
            @forelse($roles as $role)
                <tr>
                    <td>
                        <div class="flex items-center gap-2">
                            <i class="icofont-shield text-primary text-lg"></i>
                            <span class="font-medium">{{ $role->name }}</span>
                            @if ($role->name === 'Super Admin')
                                <x-admin.ui.badge type="warning">Sistema</x-admin.ui.badge>
                            @endif
                        </div>
                    </td>
                    <td>
                        <x-admin.ui.badge type="info">
                            {{ $role->permissions_count }} permisos
                        </x-admin.ui.badge>
                    </td>
                    <td>
                        <x-admin.ui.badge type="neutral">
                            {{ $role->users_count }} usuarios
                        </x-admin.ui.badge>
                    </td>
                    <td class="text-right">
                        @if ($role->name !== 'Super Admin')
                            <x-admin.table.actions :edit-url="route('roles.edit', $role)" :delete-url="route('roles.destroy', $role)" :delete-confirm="'¿Eliminar el rol «' .
                                $role->name .
                                '»? Los usuarios que lo tengan asignado lo perderán.'"
                                edit-permission="roles.update" delete-permission="roles.delete" />
                        @else
                            <span class="text-sm opacity-40 italic">Protegido</span>
                        @endif
                    </td>
                </tr>
            @empty
                <x-admin.table.empty message="No hay roles definidos" colspan="4" />
            @endforelse
        </x-admin.table.index>
    </x-admin.ui.card>
</x-layouts.admin>
