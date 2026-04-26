@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cifo-light" x-data="{ theme: localStorage.getItem('cifo-theme') || 'cifo-light' }"
    x-init="$el.setAttribute('data-theme', theme)" :data-theme="theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }} · CIFO La Violeta</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="bg-base-200 text-base-content antialiased">

    <div class="drawer lg:drawer-open">
        <input id="sidebar-toggle" type="checkbox" class="drawer-toggle" />

        {{-- Contenido principal --}}
        <div class="drawer-content flex flex-col min-h-screen">

            {{-- Header --}}
            <x-admin.header />

            {{-- Flash alerts --}}
            <div class="px-4 lg:px-6 pt-4 max-w-7xl w-full mx-auto space-y-2">
                @if (session('success'))
                    <x-admin.ui.alert type="success" :dismissible="true">
                        {{ session('success') }}
                    </x-admin.ui.alert>
                @endif
                @if (session('error'))
                    <x-admin.ui.alert type="error" :dismissible="true">
                        {{ session('error') }}
                    </x-admin.ui.alert>
                @endif
                @if (session('warning'))
                    <x-admin.ui.alert type="warning" :dismissible="true">
                        {{ session('warning') }}
                    </x-admin.ui.alert>
                @endif
                @if (session('info'))
                    <x-admin.ui.alert type="info" :dismissible="true">
                        {{ session('info') }}
                    </x-admin.ui.alert>
                @endif
            </div>

            {{-- Contenido de la página --}}
            <main class="flex-1 p-4 lg:p-6 max-w-7xl w-full mx-auto">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="footer footer-center p-4 text-base-content/50 text-xs border-t border-base-300">
                <p>© {{ date('Y') }} CIFO La Violeta · Todos los derechos reservados</p>
            </footer>
        </div>

        {{-- Sidebar (overlay en móvil, fijo en desktop) --}}
        <div class="drawer-side z-40">
            <label for="sidebar-toggle" aria-label="Cerrar menú lateral" class="drawer-overlay"></label>
            <x-admin.sidebar />
        </div>
    </div>

    {{-- Toast de notificaciones global --}}
    {{-- <x-admin.ui.toast /> --}}

</body>

</html>
