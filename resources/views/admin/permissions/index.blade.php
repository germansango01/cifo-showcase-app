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
        <div class="flex items-center gap-3">
            <x-admin.ui.badge color="neutral">
                {{ $permissions->flatten()->count() }} {{ __('admin.nav.permissions') }} · {{ $totalRoles }}
                {{ __('admin.nav.roles') }}
            </x-admin.ui.badge>
            @can('permissions.create')
                <x-admin.ui.button :href="route('permissions.create')" icon="icofont-plus">
                    {{ __('admin.permissions.create') }}
                </x-admin.ui.button>
            @endcan
        </div>
    </div>

    <div class="space-y-3">
        @forelse ($permissions as $module => $modulePerms)
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
                                    <th class="text-right">{{ __('admin.common.actions') }}</th>
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
                                                    <x-admin.ui.badge color="primary">{{ $role->name }}</x-admin.ui.badge>
                                                @empty
                                                    <span class="text-sm opacity-40 italic">{{ __('admin.permissions.unassigned') }}</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="flex items-center gap-1 justify-end">
                                                @can('permissions.update')
                                                    <div class="tooltip tooltip-left" data-tip="{{ __('admin.common.edit') }}">
                                                        <a href="{{ route('permissions.edit', $permission) }}"
                                                            class="btn btn-ghost btn-xs btn-square">
                                                            <i class="icofont-edit text-base text-warning"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('permissions.delete')
                                                    <div class="tooltip tooltip-left" data-tip="{{ __('admin.common.delete') }}">
                                                        <button type="button" class="btn btn-ghost btn-xs btn-square"
                                                            onclick="document.getElementById('del-perm-{{ $permission->id }}').showModal()">
                                                            <i class="icofont-ui-delete text-base text-error"></i>
                                                        </button>
                                                    </div>
                                                    <dialog id="del-perm-{{ $permission->id }}" class="modal modal-bottom sm:modal-middle">
                                                        <div class="modal-box">
                                                            <h3 class="font-bold text-lg flex items-center gap-2">
                                                                <i class="icofont-warning-alt text-warning text-2xl"></i>
                                                                {{ __('admin.common.confirm_delete') }}
                                                            </h3>
                                                            <p class="py-4 text-base-content/70">
                                                                {{ __('admin.permissions.delete_confirm', ['name' => $permission->name]) }}
                                                            </p>
                                                            <div class="modal-action gap-2">
                                                                <form method="dialog">
                                                                    <button class="btn btn-ghost">{{ __('admin.common.cancel') }}</button>
                                                                </form>
                                                                <form method="POST" action="{{ route('permissions.destroy', $permission) }}">
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </details>
        @empty
            <x-admin.ui.empty-state icon="icofont-key" :message="__('admin.permissions.empty')" />
        @endforelse
    </div>
</x-layouts.admin>
