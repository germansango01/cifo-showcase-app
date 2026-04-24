@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cifo-light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Acceso' }} · CIFO La Violeta</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="min-h-screen antialiased">

    <div
        class="min-h-screen bg-linear-to-br from-neutral via-primary to-accent flex flex-col items-center justify-center p-4 relative overflow-hidden">

        {{-- Círculos decorativos --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-primary/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl pointer-events-none"
            aria-hidden="true"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-secondary/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl pointer-events-none"
            aria-hidden="true"></div>

        {{-- Logo --}}
        <div class="mb-6 z-10">
            <x-admin.sidebar.logo class="justify-center" />
        </div>

        {{-- Card --}}
        <div class="w-full max-w-md z-10">
            <div class="card bg-base-100 shadow-2xl border border-base-300/50">
                <div class="card-body p-8">

                    @if (session('status'))
                        <x-admin.ui.alert type="success" class="mb-4">
                            {{ session('status') }}
                        </x-admin.ui.alert>
                    @endif

                    {{-- Mostramos errores generales que no sean de campos específicos --}}
                    @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
                        <x-admin.ui.alert type="error" class="mb-4">
                            {{ $errors->first() }}
                        </x-admin.ui.alert>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <p class="mt-6 text-primary-content/70 text-xs z-10">
            © {{ date('Y') }} CIFO La Violeta · Todos los derechos reservados
        </p>
    </div>

    {{-- SCRIPTS --}}
    @stack('scripts')
</body>

</html>
