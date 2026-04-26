<x-layouts.error title="Página no encontrada">

    <svg viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <circle cx="140" cy="100" r="90" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.08" />
        <circle cx="140" cy="100" r="68" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.07" />
        <rect x="88" y="44" width="104" height="124" rx="10" fill="white"
            stroke="oklch(46.9% 0.152 301.7)" stroke-width="2.5" />
        <rect x="88" y="44" width="104" height="30" rx="10" fill="oklch(46.9% 0.152 301.7)"
            fill-opacity="0.15" />
        <rect x="104" y="94" width="72" height="6" rx="3" fill="oklch(46.9% 0.152 301.7)"
            fill-opacity="0.2" />
        <rect x="104" y="108" width="52" height="6" rx="3" fill="oklch(46.9% 0.152 301.7)"
            fill-opacity="0.15" />
        <rect x="104" y="122" width="64" height="6" rx="3" fill="oklch(46.9% 0.152 301.7)"
            fill-opacity="0.15" />
        <circle cx="178" cy="148" r="28" fill="oklch(46.9% 0.152 301.7)" />
        <text x="178" y="156" text-anchor="middle" font-family="system-ui, sans-serif" font-size="28"
            font-weight="700" fill="white">?</text>
        <circle cx="68" cy="62" r="4" fill="oklch(74.1% 0.131 82.1)" />
        <circle cx="76" cy="42" r="2.5" fill="oklch(74.1% 0.131 82.1)" opacity="0.7" />
        <circle cx="56" cy="48" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.5" />
        <circle cx="212" cy="52" r="3.5" fill="oklch(74.1% 0.131 82.1)" />
        <circle cx="224" cy="66" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.6" />
    </svg>

    <p class="error-code">404</p>
    <h1 class="error-title">Página no encontrada</h1>
    <p class="error-body">
        La página que buscas no existe, ha sido movida o no tienes permiso para verla.
    </p>

    <div class="error-buttons">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Ir al Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
        @endauth
        <button type="button" onclick="history.back()" class="btn btn-ghost">Volver atrás</button>
    </div>

</x-layouts.error>
