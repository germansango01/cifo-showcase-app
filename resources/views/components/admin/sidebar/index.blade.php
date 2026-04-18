<aside class="bg-neutral text-neutral-content min-h-full w-72 flex flex-col">

    {{-- Logo --}}
    <div class="p-4 pb-2">
        <x-admin.sidebar.logo />
    </div>

    {{-- Divider --}}
    <div class="divider divider-neutral my-0 px-4 opacity-20"></div>

    {{-- Navegación principal --}}
    <nav class="flex-1 overflow-y-auto p-4" aria-label="Menú principal">
        <ul class="menu menu-sm w-full gap-0.5 p-0">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}" @class([
                    'flex items-center gap-3 rounded-lg px-3 py-2.5 transition-colors',
                    'bg-primary text-primary-content font-semibold' => request()->routeIs(
                        'dashboard'),
                    'hover:bg-neutral-content/10' => !request()->routeIs('dashboard'),
                ])>
                    <i class="icofont-dashboard-web text-lg w-5 text-center" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Sección Administración --}}
            @canany(['users.view', 'roles.view', 'permissions.view'])
                <li
                    class="menu-title mt-4 mb-1 px-3 text-xs font-semibold uppercase tracking-widest text-neutral-content/50">
                    Administración
                </li>

                {{-- Usuarios --}}
                @can('users.view')
                    <li>
                        <details @class(['open' => request()->routeIs('users.*')])>
                            <summary @class([
                                'flex items-center gap-3 rounded-lg px-3 py-2.5 cursor-pointer transition-colors list-none',
                                'bg-primary/10 text-primary font-medium' => request()->routeIs('users.*'),
                                'hover:bg-neutral-content/10' => !request()->routeIs('users.*'),
                            ])>
                                <i class="icofont-users text-lg w-5 text-center" aria-hidden="true"></i>
                                <span class="flex-1">Usuarios</span>
                                <i class="icofont-caret-down text-sm opacity-60" aria-hidden="true"></i>
                            </summary>
                            <ul class="pl-9 mt-0.5 space-y-0.5">
                                <li>
                                    <a href="{{ route('users.index') }}" @class([
                                        'block px-3 py-2 rounded-lg text-sm transition-colors',
                                        'bg-primary/10 text-primary font-medium' => request()->routeIs(
                                            'users.index'),
                                        'hover:bg-neutral-content/10' => !request()->routeIs('users.index'),
                                    ])>
                                        Listado
                                    </a>
                                </li>
                                @can('users.create')
                                    <li>
                                        <a href="{{ route('users.create') }}" @class([
                                            'block px-3 py-2 rounded-lg text-sm transition-colors',
                                            'bg-primary/10 text-primary font-medium' => request()->routeIs(
                                                'users.create'),
                                            'hover:bg-neutral-content/10' => !request()->routeIs('users.create'),
                                        ])>
                                            Crear nuevo
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </details>
                    </li>
                @endcan

                {{-- Roles y Permisos --}}
                @canany(['roles.view', 'permissions.view'])
                    <li>
                        <details @class(['open' => request()->routeIs('roles.*', 'permissions.*')])>
                            <summary @class([
                                'flex items-center gap-3 rounded-lg px-3 py-2.5 cursor-pointer transition-colors list-none',
                                'bg-primary/10 text-primary font-medium' => request()->routeIs(
                                    'roles.*',
                                    'permissions.*'),
                                'hover:bg-neutral-content/10' => !request()->routeIs(
                                    'roles.*',
                                    'permissions.*'),
                            ])>
                                <i class="icofont-shield text-lg w-5 text-center" aria-hidden="true"></i>
                                <span class="flex-1">Accesos</span>
                                <i class="icofont-caret-down text-sm opacity-60" aria-hidden="true"></i>
                            </summary>
                            <ul class="pl-9 mt-0.5 space-y-0.5">
                                @can('roles.view')
                                    <li>
                                        <a href="{{ route('roles.index') }}" @class([
                                            'block px-3 py-2 rounded-lg text-sm transition-colors',
                                            'bg-primary/10 text-primary font-medium' => request()->routeIs('roles.*'),
                                            'hover:bg-neutral-content/10' => !request()->routeIs('roles.*'),
                                        ])>
                                            Roles
                                        </a>
                                    </li>
                                @endcan
                                @can('permissions.view')
                                    <li>
                                        <a href="{{ route('permissions.index') }}" @class([
                                            'block px-3 py-2 rounded-lg text-sm transition-colors',
                                            'bg-primary/10 text-primary font-medium' => request()->routeIs(
                                                'permissions.*'),
                                            'hover:bg-neutral-content/10' => !request()->routeIs('permissions.*'),
                                        ])>
                                            Permisos
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </details>
                    </li>
                @endcanany
            @endcanany

            {{-- Sección Cuenta --}}
            <li
                class="menu-title mt-4 mb-1 px-3 text-xs font-semibold uppercase tracking-widest text-neutral-content/50">
                Cuenta
            </li>

            <li>
                <a href="{{ route('profile.edit') }}" @class([
                    'flex items-center gap-3 rounded-lg px-3 py-2.5 transition-colors',
                    'bg-primary text-primary-content font-semibold' => request()->routeIs(
                        'profile.*'),
                    'hover:bg-neutral-content/10' => !request()->routeIs('profile.*'),
                ])>
                    <i class="icofont-settings text-lg w-5 text-center" aria-hidden="true"></i>
                    <span>Mi perfil</span>
                </a>
            </li>

        </ul>
    </nav>

    {{-- Usuario en la parte inferior --}}
    @auth
        <div class="p-4 border-t border-neutral-content/10">
            <div class="flex items-center gap-3">
                <div class="avatar avatar-placeholder">
                    <div
                        class="bg-primary text-primary-content rounded-full w-9 h-9 flex items-center justify-center text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs opacity-60 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-xs btn-circle opacity-60 hover:opacity-100"
                        aria-label="Cerrar sesión" title="Cerrar sesión">
                        <i class="icofont-logout text-base" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    @endauth

</aside>
