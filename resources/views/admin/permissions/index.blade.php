<x-layouts.admin :title="__('admin.permissions.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.nav.permissions')],
    ]" />

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ __('admin.permissions.title') }}</h1>
            <p class="text-sm opacity-70">{{ __('admin.permissions.subtitle') }}</p>
        </div>
        <x-admin.ui.badge color="neutral">
            {{ $permissions->flatten()->count() }} {{ __('admin.nav.permissions') }} · {{ $totalRoles }}
            {{ __('admin.nav.roles') }}
        </x-admin.ui.badge>
    </div>

    <x-admin.ui.alert type="info" class="mb-6">
        Los permisos son inmutables desde la interfaz. Para añadir o modificar permisos, actualiza el seeder y ejecuta
        <code class="font-mono text-xs bg-base-300 px-1 py-0.5 rounded">php artisan db:seed
            --class=RolesAndPermissionsSeeder</code>.
    </x-admin.ui.alert>

    <div class="space-y-3">
        @foreach ($permissions as $module => $modulePerms)
            <details class="collapse collapse-arrow bg-base-100 border border-base-300 rounded-xl" open>
                <summary
                    class="collapse-title text-base font-semibold capitalize flex items-center gap-2 cursor-pointer select-none">
                    <i class="icofont-key text-primary text-lg"></i>
                    {{ $module }}
                    <x-admin.ui.badge color="neutral" class="ml-auto mr-6">
                        {{ trans_choice('admin.permissions.perm_count', $modulePerms->count(), ['count' => $modulePerms->count()]) }}
                    </x-admin.ui.badge>
                </summary>

                <div class="collapse-content pt-0">
                    <div class="overflow-x-auto">
                        <table class="table table-sm">
                            <thead>
                                <tr class="text-xs uppercase opacity-60">
                                    <th>{{ __('admin.permissions.col_perm') }}</th>
                                    <th>{{ __('admin.permissions.col_action') }}</th>
                                    <th>{{ __('admin.permissions.col_roles') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modulePerms as $permission)
                                    <tr class="hover:bg-base-200">
                                        <td>
                                            <code class="font-mono text-sm text-accent">{{ $permission->name }}</code>
                                        </td>
                                        <td>
                                            @php $action = explode('.', $permission->name)[1] ?? '—'; @endphp
                                            <x-admin.ui.badge
                                                color="{{ match ($action) {
                                                    'view' => 'info',
                                                    'create' => 'success',
                                                    'update' => 'warning',
                                                    'delete' => 'error',
                                                    'assign-roles' => 'accent',
                                                    default => 'neutral',
                                                } }}">
                                                {{ $action }}
                                            </x-admin.ui.badge>
                                        </td>
                                        <td>
                                            <div class="flex flex-wrap gap-1">
                                                @forelse($permission->roles as $role)
                                                    <x-admin.ui.badge
                                                        color="primary">{{ $role->name }}</x-admin.ui.badge>
                                                @empty
                                                    <span
                                                        class="text-sm opacity-40 italic">{{ __('admin.permissions.unassigned') }}</span>
                                                @endforelse
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </details>
        @endforeach
    </div>
</x-layouts.admin>
