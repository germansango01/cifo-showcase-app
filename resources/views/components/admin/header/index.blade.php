<header class="navbar bg-base-100 border-b border-base-300 sticky top-0 z-30 gap-2 px-4">

    {{-- Toggle sidebar (solo móvil) --}}
    <div class="flex-none lg:hidden">
        <label for="sidebar-toggle" class="btn btn-ghost btn-sm btn-square" aria-label="Abrir menú lateral">
            <i class="icofont-navigation-menu text-xl" aria-hidden="true"></i>
        </label>
    </div>

    {{-- Breadcrumb (ocupa el espacio central) --}}
    <div class="flex-1 min-w-0 overflow-hidden">
        <x-admin.ui.breadcrumb />
    </div>

    {{-- Acciones del header --}}
    <div class="flex-none flex items-center gap-1">

        {{-- Toggle de tema --}}
        <x-admin.header.theme-toggle />

        {{-- Notificaciones --}}
        <x-admin.header.notifications />

        {{-- Menú de perfil --}}
        <x-admin.header.profile-menu />

    </div>

</header>
