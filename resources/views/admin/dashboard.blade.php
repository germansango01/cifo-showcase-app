<x-layouts.admin :title="__('admin.nav.dashboard')">

    {{-- ── Breadcrumb ────────────────────────────────────────────────────── --}}
    <x-admin.ui.breadcrumb :items="[['label' => __('admin.nav.dashboard')]]" />

    {{-- ── Saludo dinámico ──────────────────────────────────────────────── --}}
    @php
        $hour = now()->hour;
        $greeting = match (true) {
            $hour >= 6 && $hour < 14 => __('admin.dashboard.greeting_morning'),
            $hour >= 14 && $hour < 21 => __('admin.dashboard.greeting_afternoon'),
            default => __('admin.dashboard.greeting_evening'),
        };
    @endphp

    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            {{ $greeting }}, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-sm opacity-60">
            {{ now()->translatedFormat('l, j \d\e F \d\e Y') }}
        </p>
    </div>

    {{-- ── Fila de 4 stat-cards ─────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        @foreach ($stats as $stat)
            <x-admin.ui.stat :label="$stat['label']" :value="$stat['value']" :icon="$stat['icon']" :color="$stat['color']" :trend="$stat['trend']"
                :trend-label="$stat['trend_label']" />
        @endforeach
    </div>

    {{-- ── Grid 2 columnas: actividad reciente + distribución por rol ───── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

        {{-- Actividad reciente --}}
        <x-admin.ui.card>
            <x-slot:header>
                <span class="flex items-center gap-2 font-semibold">
                    <i class="icofont-history text-primary"></i>
                    {{ __('admin.dashboard.recent_activity') }}
                </span>
            </x-slot:header>

            @if ($recentUsers->isEmpty())
                <x-admin.table.empty-state message="{{ __('admin.dashboard.no_users') }}" />
            @else
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>{{ __('admin.dashboard.col_user') }}</th>
                                <th>{{ __('admin.dashboard.col_role') }}</th>
                                <th>{{ __('admin.dashboard.col_registered') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentUsers as $user)
                                <tr class="hover">
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="avatar placeholder">
                                                <div
                                                    class="bg-primary/10 text-primary rounded-full w-8 text-xs font-bold grid place-items-center">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-medium leading-tight">{{ $user->name }}</p>
                                                <p class="text-xs opacity-60">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @forelse ($user->roles as $role)
                                            <x-admin.ui.badge color="primary" size="sm">
                                                {{ $role->name }}
                                            </x-admin.ui.badge>
                                        @empty
                                            <x-admin.ui.badge color="neutral"
                                                size="sm">{{ __('admin.dashboard.no_role') }}
                                            </x-admin.ui.badge>
                                        @endforelse
                                    </td>
                                    <td class="text-xs opacity-60 whitespace-nowrap">
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @can('users.view')
                    <div class="mt-3 text-right">
                        <x-admin.ui.button :href="route('users.index')" variant="ghost" size="sm"
                            icon-right="icofont-arrow-right">
                            {{ __('admin.dashboard.view_all') }}
                        </x-admin.ui.button>
                    </div>
                @endcan
            @endif
        </x-admin.ui.card>

        {{-- Distribución por rol --}}
        <x-admin.ui.card>
            <x-slot:header>
                <span class="flex items-center gap-2 font-semibold">
                    <i class="icofont-shield text-secondary"></i>
                    {{ __('admin.dashboard.role_distribution') }}
                </span>
            </x-slot:header>

            @if ($roleDistribution->isEmpty())
                <x-admin.table.empty-state message="{{ __('admin.dashboard.no_roles') }}" />
            @else
                @php $total = $roleDistribution->sum(); @endphp
                <ul class="space-y-3">
                    @foreach ($roleDistribution as $roleName => $count)
                        @php $pct = $total > 0 ? round(($count / $total) * 100) : 0; @endphp
                        <li>
                            <div class="flex items-center justify-between mb-1">
                                <span class="flex items-center gap-2 text-sm font-medium">
                                    <i class="icofont-shield text-primary opacity-70"></i>
                                    {{ $roleName }}
                                </span>
                                <x-admin.ui.badge color="primary">
                                    {{ $count }} {{ Str::plural('usuario', $count) }}
                                </x-admin.ui.badge>
                            </div>
                            <div class="w-full bg-base-300 rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full transition-all duration-500"
                                    style="width: {{ $pct }}%"
                                    aria-label="{{ $roleName }}: {{ $pct }}%"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                @can('roles.view')
                    <div class="mt-4 text-right">
                        <x-admin.ui.button :href="route('roles.index')" variant="ghost" size="sm"
                            icon-right="icofont-arrow-right">
                            {{ __('admin.dashboard.manage_roles') }}
                        </x-admin.ui.button>
                    </div>
                @endcan
            @endif
        </x-admin.ui.card>

    </div>

    {{-- ── Quick actions ─────────────────────────────────────────────────── --}}
    @canany(['users.create', 'roles.create', 'permissions.view'])
        <div class="mb-2">
            <h2 class="text-base font-semibold opacity-70">{{ __('admin.dashboard.quick_actions') }}</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            @can('users.create')
                <x-admin.ui.card class="hover:shadow-md transition-shadow cursor-pointer group">
                    <a href="{{ route('users.create') }}" class="flex flex-col items-center gap-3 py-2">
                        <span
                            class="w-12 h-12 rounded-xl bg-primary/10 text-primary grid place-items-center group-hover:bg-primary group-hover:text-primary-content transition-colors">
                            <i class="icofont-plus text-2xl"></i>
                        </span>
                        <span class="text-sm font-medium text-center">{{ __('admin.dashboard.create_user') }}</span>
                    </a>
                </x-admin.ui.card>
            @endcan

            @can('roles.create')
                <x-admin.ui.card class="hover:shadow-md transition-shadow cursor-pointer group">
                    <a href="{{ route('roles.create') }}" class="flex flex-col items-center gap-3 py-2">
                        <span
                            class="w-12 h-12 rounded-xl bg-secondary/10 text-secondary grid place-items-center group-hover:bg-secondary group-hover:text-secondary-content transition-colors">
                            <i class="icofont-shield text-2xl"></i>
                        </span>
                        <span class="text-sm font-medium text-center">{{ __('admin.dashboard.create_role') }}</span>
                    </a>
                </x-admin.ui.card>
            @endcan

            @can('permissions.view')
                <x-admin.ui.card class="hover:shadow-md transition-shadow cursor-pointer group">
                    <a href="{{ route('permissions.index') }}" class="flex flex-col items-center gap-3 py-2">
                        <span
                            class="w-12 h-12 rounded-xl bg-accent/10 text-accent grid place-items-center group-hover:bg-accent group-hover:text-accent-content transition-colors">
                            <i class="icofont-key text-2xl"></i>
                        </span>
                        <span class="text-sm font-medium text-center">{{ __('admin.dashboard.view_permissions') }}</span>
                    </a>
                </x-admin.ui.card>
            @endcan

            {{-- Mi perfil — siempre visible para usuarios autenticados --}}
            <x-admin.ui.card class="hover:shadow-md transition-shadow cursor-pointer group">
                <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-3 py-2">
                    <span
                        class="w-12 h-12 rounded-xl bg-neutral/10 text-neutral dark:text-neutral-content grid place-items-center group-hover:bg-neutral group-hover:text-neutral-content transition-colors">
                        <i class="icofont-settings text-2xl"></i>
                    </span>
                    <span class="text-sm font-medium text-center">{{ __('admin.nav.profile') }}</span>
                </a>
            </x-admin.ui.card>

        </div>
    @else
        {{-- Usuario sin permisos de admin: solo "Mi perfil" --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <x-admin.ui.card class="hover:shadow-md transition-shadow cursor-pointer group">
                <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-3 py-2">
                    <span
                        class="w-12 h-12 rounded-xl bg-neutral/10 text-neutral dark:text-neutral-content grid place-items-center group-hover:bg-neutral group-hover:text-neutral-content transition-colors">
                        <i class="icofont-settings text-2xl"></i>
                    </span>
                    <span class="text-sm font-medium text-center">{{ __('admin.nav.profile') }}</span>
                </a>
            </x-admin.ui.card>
        </div>
    @endcanany

</x-layouts.admin>
