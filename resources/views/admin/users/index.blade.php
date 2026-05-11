<x-layouts.admin :title="__('admin.users.title')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.users.title')],
    ]" />

    <x-admin.ui.confirm-delete id="confirm-delete-user" :title-key="'admin.users.delete_modal_title'">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('admin.users.title') }}</h1>
                <p class="text-sm opacity-70">
                    {{ __('admin.users.registered_count', ['count' => $users->total()]) }}
                </p>
            </div>

            @can('users.create')
                <x-admin.ui.button :href="route('users.create')" icon="icofont-plus">
                    {{ __('admin.users.create') }}
                </x-admin.ui.button>
            @endcan
        </div>

        <x-admin.ui.card>

            <x-admin.table.filters :action="route('users.index')" :search-placeholder="__('admin.users.search_placeholder')">
                <x-admin.ui.select name="role" :options="$roles->pluck('name', 'name')->toArray()" :selected="request('role')" :placeholder="__('admin.users.all_roles')" class="w-full"
                    onchange="this.form.submit()" />
            </x-admin.table.filters>

            <x-admin.table.index :items="$users" :columns="[
                ['label' => __('admin.users.col_user'), 'key' => 'name', 'sortable' => true],
                ['label' => __('admin.users.col_email'), 'key' => 'email', 'sortable' => true],
                ['label' => __('admin.users.col_roles'), 'key' => null, 'sortable' => false],
                ['label' => __('admin.users.col_registered'), 'key' => 'created_at', 'sortable' => true],
                ['label' => '', 'key' => null, 'sortable' => false],
            ]">

                @foreach ($users as $user)
                    <tr class="hover">
                        <td>
                            <div class="flex items-center gap-3">
                                <x-admin.ui.avatar :name="$user->name" :src="$user->profile_photo_url ?? null" size="sm" />
                                <div>
                                    <div class="font-medium text-sm">{{ $user->name }}</div>
                                    <div class="text-xs opacity-60">#{{ $user->id }}</div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="text-sm">{{ $user->email }}</span>
                            @if ($user->email_verified_at)
                                <i class="icofont-check-circled text-success text-xs ml-1"></i>
                            @endif
                        </td>

                        <td>
                            <div class="flex flex-wrap gap-1">
                                @forelse($user->roles as $role)
                                    <x-admin.ui.badge
                                        color="{{ match ($role->name) {
                                            'Admin' => 'warning',
                                            'Editor' => 'info',
                                            default => 'ghost',
                                        } }}">
                                        {{ $role->name }}
                                    </x-admin.ui.badge>
                                @empty
                                    <span class="text-xs opacity-50">{{ __('admin.users.no_roles') }}</span>
                                @endforelse
                            </div>
                        </td>

                        <td>
                            <div class="text-sm">{{ $user->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs opacity-50">{{ $user->created_at->diffForHumans() }}</div>
                        </td>

                        <td class="text-right">
                            <div class="flex justify-end gap-1">
                                @can('users.view')
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-eye text-info text-base"></i>
                                    </a>
                                @endcan

                                @can('users.update')
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-ghost btn-xs btn-square">
                                        <i class="icofont-edit text-warning text-base"></i>
                                    </a>
                                @endcan

                                @can('users.delete')
                                    @if (auth()->id() !== $user->id)
                                        <button type="button" class="btn btn-ghost btn-xs btn-square"
                                            @click="deleteName = @js($user->name); deleteUrl = '{{ route('users.destroy', $user) }}'; $nextTick(() => document.getElementById('confirm-delete-user').showModal())">
                                            <i class="icofont-ui-delete text-error text-base"></i>
                                        </button>
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach

                <x-slot name="empty">
                    <x-admin.table.empty class="h-full" icon="icofont-search-1" :message="__('admin.common.no_results')" />
                </x-slot>

                <x-slot name="perPage">
                    <x-admin.table.per-page :current="request('per_page', 10)" />
                </x-slot>

            </x-admin.table.index>

        </x-admin.ui.card>

    </x-admin.ui.confirm-delete>

</x-layouts.admin>
