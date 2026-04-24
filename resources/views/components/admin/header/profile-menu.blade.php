{{-- Menú de perfil: avatar + dropdown DaisyUI (pure CSS, sin Alpine necesario) --}}

<div class="dropdown dropdown-end">

    {{-- Trigger: avatar con nombre --}}
    <div tabindex="0" role="button" class="btn btn-ghost btn-sm flex items-center gap-2 px-2 h-10 rounded-lg"
        aria-label="{{ __('admin.nav.profile') }}" aria-haspopup="true">
        {{-- Avatar con inicial --}}
        <div class="avatar avatar-placeholder">
            <div class="bg-primary text-primary-content rounded-full w-7 h-7 flex items-center justify-center">
                <span class="text-xs font-bold select-none">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </span>
            </div>
        </div>

        {{-- Nombre (oculto en pantallas muy pequeñas) --}}
        <span class="hidden sm:block text-sm font-medium max-w-28 truncate">
            {{ auth()->user()->name ?? 'Usuario' }}
        </span>

        <i class="icofont-caret-down text-xs opacity-60" aria-hidden="true"></i>
    </div>

    {{-- Panel desplegable --}}
    <ul tabindex="0"
        class="dropdown-content mt-2 z-50 menu menu-sm bg-base-100 border border-base-300 shadow-xl rounded-xl w-56 p-1"
        role="menu">
        {{-- Info del usuario --}}
        <li class="px-3 py-2 mb-1 border-b border-base-300">
            <div class="flex flex-col gap-0.5">
                <span class="font-semibold text-sm text-base-content truncate">
                    {{ auth()->user()->name ?? 'Usuario' }}
                </span>
                <span class="text-xs text-base-content/60 truncate">
                    {{ auth()->user()->email ?? '' }}
                </span>
                @if (auth()->user()->roles->isNotEmpty())
                    <div class="flex flex-wrap gap-1 mt-1">
                        @foreach (auth()->user()->roles->take(2) as $role)
                            <span class="badge badge-primary badge-sm">{{ $role->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </li>

        {{-- Links de navegación --}}
        <li role="none">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 rounded-lg" role="menuitem">
                <i class="icofont-ui-user text-base" aria-hidden="true"></i>
                {{ __('admin.nav.profile') }}
            </a>
        </li>
        <li role="none">
            <a href="{{ route('profile.edit') }}#password" class="flex items-center gap-2 rounded-lg" role="menuitem">
                <i class="icofont-lock text-base" aria-hidden="true"></i>
                {{ __('admin.profile.password') }}
            </a>
        </li>
        <li role="none">
            <a href="{{ route('profile.edit') }}#two-factor" class="flex items-center gap-2 rounded-lg" role="menuitem">
                <i class="icofont-shield text-base" aria-hidden="true"></i>
                {{ __('admin.profile.two_factor') }}
            </a>
        </li>

        <li class="border-t border-base-300 mt-1 pt-1" role="none">
            <form method="POST" action="{{ route('logout') }}" class="flex">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 w-full cursor-pointer rounded-lg text-error hover:bg-error/10"
                    role="menuitem">
                    <i class="icofont-logout text-base" aria-hidden="true"></i>
                    {{ __('admin.nav.logout') }}
                </button>
            </form>
        </li>
    </ul>
</div>
