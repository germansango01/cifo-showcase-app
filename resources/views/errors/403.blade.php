<x-layouts.guest title="Acceso denegado">

    <div class="flex flex-col items-center text-center py-4">

        {{-- Ilustración SVG — escudo bloqueado --}}
        <svg viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg"
             class="w-64 h-auto mb-6" aria-hidden="true">
            <!-- Halo de fondo -->
            <circle cx="140" cy="100" r="90" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.08"/>
            <circle cx="140" cy="100" r="68" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.06"/>

            <!-- Escudo -->
            <path d="M140 36 L188 56 L188 100 C188 128 166 150 140 160 C114 150 92 128 92 100 L92 56 Z"
                  fill="white" stroke="oklch(46.9% 0.152 301.7)" stroke-width="2.5"/>
            <path d="M140 46 L180 63 L180 100 C180 124 162 143 140 152 C118 143 100 124 100 100 L100 63 Z"
                  fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.12"/>

            <!-- Candado en el centro del escudo -->
            <rect x="122" y="96" width="36" height="28" rx="5"
                  fill="oklch(46.9% 0.152 301.7)"/>
            <path d="M128 96 L128 88 C128 80 152 80 152 88 L152 96"
                  stroke="oklch(46.9% 0.152 301.7)" stroke-width="4" stroke-linecap="round" fill="none"/>
            <circle cx="140" cy="110" r="4" fill="white"/>
            <rect x="138" y="112" width="4" height="6" rx="2" fill="white"/>

            <!-- Estrellitas doradas -->
            <circle cx="70" cy="70" r="4" fill="oklch(74.1% 0.131 82.1)"/>
            <circle cx="60" cy="86" r="2.5" fill="oklch(74.1% 0.131 82.1)" opacity="0.7"/>
            <circle cx="78" cy="52" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.5"/>
            <circle cx="210" cy="60" r="3.5" fill="oklch(74.1% 0.131 82.1)"/>
            <circle cx="220" cy="78" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.6"/>
        </svg>

        <p class="text-6xl font-black text-primary mb-2 tabular-nums">403</p>
        <h1 class="text-xl font-bold mb-2">Acceso denegado</h1>
        <p class="text-sm opacity-60 mb-6 max-w-xs">
            No tienes permiso para acceder a este recurso. Si crees que es un error, contacta con el administrador.
        </p>

        <div class="flex flex-col sm:flex-row gap-2 w-full">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-block">
                    <i class="icofont-dashboard-web"></i> Ir al Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-block">
                    <i class="icofont-login"></i> Iniciar sesión
                </a>
            @endauth
            <button onclick="history.back()" class="btn btn-ghost btn-block">
                <i class="icofont-arrow-left"></i> Volver atrás
            </button>
        </div>
    </div>

</x-layouts.guest>
