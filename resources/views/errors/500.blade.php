<x-layouts.guest title="Error del servidor">

    <div class="flex flex-col items-center text-center py-4">

        {{-- Ilustración SVG — servidor con rayo --}}
        <svg viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg"
             class="w-64 h-auto mb-6" aria-hidden="true">
            <!-- Halo -->
            <circle cx="140" cy="100" r="90" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.08"/>
            <circle cx="140" cy="100" r="68" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.06"/>

            <!-- Servidor (caja) -->
            <rect x="88" y="50" width="104" height="32" rx="6"
                  fill="white" stroke="oklch(46.9% 0.152 301.7)" stroke-width="2"/>
            <rect x="88" y="92" width="104" height="32" rx="6"
                  fill="white" stroke="oklch(46.9% 0.152 301.7)" stroke-width="2"/>
            <rect x="88" y="134" width="104" height="32" rx="6"
                  fill="white" stroke="oklch(46.9% 0.152 301.7)" stroke-width="2"/>
            <!-- LEDs -->
            <circle cx="105" cy="66" r="4" fill="oklch(74.6% 0.181 152.3)"/>
            <circle cx="119" cy="66" r="4" fill="oklch(74.6% 0.181 152.3)"/>
            <circle cx="105" cy="108" r="4" fill="oklch(63.1% 0.194 29.4)"/>
            <circle cx="119" cy="108" r="4" fill="oklch(76.3% 0.163 69.4)"/>
            <circle cx="105" cy="150" r="4" fill="oklch(63.1% 0.194 29.4)"/>
            <circle cx="119" cy="150" r="4" fill="oklch(63.1% 0.194 29.4)"/>
            <!-- Ranuras -->
            <rect x="134" y="62" width="44" height="4" rx="2" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.2"/>
            <rect x="134" y="104" width="44" height="4" rx="2" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.2"/>
            <rect x="134" y="146" width="44" height="4" rx="2" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.2"/>

            <!-- Rayo flotante (dorado) -->
            <path d="M196 44 L182 76 L194 76 L180 112 L210 72 L196 72 Z"
                  fill="oklch(74.1% 0.131 82.1)" stroke="oklch(74.1% 0.131 82.1)"
                  stroke-width="1" stroke-linejoin="round"/>

            <!-- Estrellitas -->
            <circle cx="66" cy="80" r="3.5" fill="oklch(74.1% 0.131 82.1)"/>
            <circle cx="74" cy="60" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.6"/>
            <circle cx="58" cy="96" r="2.5" fill="oklch(74.1% 0.131 82.1)" opacity="0.5"/>
        </svg>

        <p class="text-6xl font-black text-primary mb-2 tabular-nums">500</p>
        <h1 class="text-xl font-bold mb-2">Error interno del servidor</h1>
        <p class="text-sm opacity-60 mb-6 max-w-xs">
            Algo ha fallado en el servidor. Ya estamos trabajando en ello. Vuelve a intentarlo en unos instantes.
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
            <button onclick="location.reload()" class="btn btn-ghost btn-block">
                <i class="icofont-refresh"></i> Reintentar
            </button>
        </div>
    </div>

</x-layouts.guest>
