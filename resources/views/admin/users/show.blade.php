<x-layouts.admin :title="$user->name">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.users.title'), 'href' => route('users.index')],
        ['label' => $user->name],
    ]" />

    {{-- Cabecera --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <div class="flex items-center gap-4">
            <x-admin.ui.avatar :name="$user->name" :src="$user->profile_photo_url ?? null" size="lg" />
            <div>
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <p class="text-sm opacity-60 flex items-center gap-1">
                    <i class="icofont-email"></i> {{ $user->email }}
                    @if ($user->email_verified_at)
                        <span class="badge badge-success badge-xs">{{ __('admin.common.verified') }}</span>
                    @else
                        <span class="badge badge-warning badge-xs">{{ __('admin.common.not_verified') }}</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="flex gap-2 flex-wrap">
            <x-admin.ui.button :href="route('users.index')" variant="ghost" icon="icofont-arrow-left">
                {{ __('admin.common.back') }}
            </x-admin.ui.button>
            @can('users.update')
                <x-admin.ui.button :href="route('users.edit', $user)" icon="icofont-edit">
                    {{ __('admin.common.edit') }}
                </x-admin.ui.button>
            @endcan
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Columna principal --}}
        <div class="lg:col-span-2 flex flex-col gap-6">

            {{-- Datos del usuario --}}
            <x-admin.ui.card>
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="icofont-ui-user text-primary"></i> {{ __('admin.users.general_info') }}
                </h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                    <div>
                        <dt class="opacity-50 mb-0.5">{{ __('admin.common.id') }}</dt>
                        <dd class="font-medium">#{{ $user->id }}</dd>
                    </div>
                    <div>
                        <dt class="opacity-50 mb-0.5">{{ __('admin.common.name') }}</dt>
                        <dd class="font-medium">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="opacity-50 mb-0.5">{{ __('admin.common.email') }}</dt>
                        <dd class="font-medium break-all">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="opacity-50 mb-0.5">{{ __('admin.common.email_verified') }}</dt>
                        <dd>
                            @if ($user->email_verified_at)
                                <span class="text-success flex items-center gap-1">
                                    <i class="icofont-check-circled"></i>
                                    {{ $user->email_verified_at->format('d/m/Y') }}
                                </span>
                            @else
                                <span class="text-warning flex items-center gap-1">
                                    <i class="icofont-warning-alt"></i> {{ __('admin.common.pending') }}
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="opacity-50 mb-0.5">{{ __('admin.common.created_at') }}</dt>
                        <dd class="font-medium">
                            {{ $user->created_at->format('d/m/Y H:i') }}
                            <span class="opacity-50 text-xs">({{ $user->created_at->diffForHumans() }})</span>
                        </dd>
                    </div>
                    <div>
                        <dt class="opacity-50 mb-0.5">{{ __('admin.common.updated_at') }}</dt>
                        <dd class="font-medium">
                            {{ $user->updated_at->format('d/m/Y H:i') }}
                        </dd>
                    </div>
                </dl>
            </x-admin.ui.card>

            {{-- Permisos heredados --}}
            <x-admin.ui.card>
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="icofont-key text-primary"></i> {{ __('admin.users.inherited_permissions') }}
                    <span class="badge badge-ghost badge-sm ml-auto">{{ $user->getAllPermissions()->count() }}</span>
                </h2>

                @if ($user->getAllPermissions()->isEmpty())
                    <p class="text-sm opacity-50 flex items-center gap-2 py-4">
                        <i class="icofont-info-circle"></i>
                        {{ __('admin.users.no_permissions') }}
                    </p>
                @else
                    @php $permsByGroup = $user->getAllPermissions()->groupBy(fn($p) => explode('.', $p->name)[0]); @endphp
                    <div class="flex flex-col gap-4">
                        @foreach ($permsByGroup as $module => $permissions)
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide opacity-50 mb-2">
                                    {{ $module }}
                                </p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($permissions as $permission)
                                        <span class="badge badge-outline badge-sm font-mono">
                                            <i class="icofont-key text-xs mr-1"></i>
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-admin.ui.card>
        </div>

        {{-- Columna lateral --}}
        <div class="flex flex-col gap-6">

            {{-- Roles --}}
            <x-admin.ui.card>
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="icofont-shield text-primary"></i> {{ __('admin.nav.roles') }}
                    <span class="badge badge-ghost badge-sm ml-auto">{{ $user->roles->count() }}</span>
                </h2>

                @if ($user->roles->isEmpty())
                    <p class="text-sm opacity-50 flex items-center gap-2">
                        <i class="icofont-info-circle"></i> {{ __('admin.users.no_roles_assigned') }}
                    </p>
                @else
                    <div class="flex flex-col gap-2">
                        @foreach ($user->roles as $role)
                            <div class="flex items-center justify-between p-2 rounded-lg bg-base-200">
                                <span class="text-sm font-medium">{{ $role->name }}</span>
                                <x-admin.ui.badge :label="$role->name"
                                    color="{{ match ($role->name) {
                                        'Super Admin' => 'error',
                                        'Admin' => 'warning',
                                        'Editor' => 'info',
                                        default => 'neutral',
                                    } }}" />
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-admin.ui.card>

            {{-- Acciones peligrosas --}}
            @canany(['users.update', 'users.delete'])
                <x-admin.ui.card>
                    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2 text-error">
                        <i class="icofont-warning-alt"></i> {{ __('admin.users.danger_zone') }}
                    </h2>

                    <div class="flex flex-col gap-2">
                        @can('users.update')
                            <x-admin.ui.button :href="route('users.edit', $user)" variant="warning" icon="icofont-edit" :block="true"
                                :outline="true">
                                {{ __('admin.users.edit_btn') }}
                            </x-admin.ui.button>
                        @endcan

                        @can('users.delete')
                            @if (auth()->id() !== $user->id)
                                <button type="button" class="btn btn-error btn-outline btn-block"
                                    onclick="confirm-delete-show.showModal()"
                                    aria-label="{{ __('admin.users.delete_btn') }} {{ $user->name }}">
                                    <i class="icofont-ui-delete"></i> {{ __('admin.users.delete_btn') }}
                                </button>
                            @endif
                        @endcan
                    </div>
                </x-admin.ui.card>
            @endcanany
        </div>
    </div>

    {{-- Modal confirmación delete --}}
    @can('users.delete')
        @if (auth()->id() !== $user->id)
            <x-admin.ui.modal id="confirm-delete-show" :title="__('admin.users.delete_modal_title')" size="sm">
                <p class="text-sm opacity-80 mb-1">
                    {{ __('admin.users.delete_confirm_short') }} <strong>{{ $user->name }}</strong>?
                </p>
                <p class="text-xs text-error">{{ __('admin.common.irreversible') }}</p>

                <x-slot name="actions">
                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <div class="flex gap-2 justify-end">
                            <button type="button" class="btn btn-ghost btn-sm"
                                onclick="confirm-delete-show.close()">{{ __('admin.common.cancel') }}</button>
                            <x-admin.ui.button type="submit" variant="error" size="sm"
                                icon="icofont-ui-delete">{{ __('admin.common.delete') }}</x-admin.ui.button>
                        </div>
                    </form>
                </x-slot>
            </x-admin.ui.modal>
        @endif
    @endcan
</x-layouts.admin>
