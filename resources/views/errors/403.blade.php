<x-layouts.error title="Acceso denegado">

    <svg viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <circle cx="140" cy="100" r="90" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.08" />
        <circle cx="140" cy="100" r="68" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.06" />
        <path d="M140 36 L188 56 L188 100 C188 128 166 150 140 160 C114 150 92 128 92 100 L92 56 Z"
            fill="white" stroke="oklch(46.9% 0.152 301.7)" stroke-width="2.5" />
        <path d="M140 46 L180 63 L180 100 C180 124 162 143 140 152 C118 143 100 124 100 100 L100 63 Z"
            fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.12" />
        <rect x="122" y="96" width="36" height="28" rx="5" fill="oklch(46.9% 0.152 301.7)" />
        <path d="M128 96 L128 88 C128 80 152 80 152 88 L152 96" stroke="oklch(46.9% 0.152 301.7)"
            stroke-width="4" stroke-linecap="round" fill="none" />
        <circle cx="140" cy="110" r="4" fill="white" />
        <rect x="138" y="112" width="4" height="6" rx="2" fill="white" />
        <circle cx="70" cy="70" r="4" fill="oklch(74.1% 0.131 82.1)" />
        <circle cx="60" cy="86" r="2.5" fill="oklch(74.1% 0.131 82.1)" opacity="0.7" />
        <circle cx="78" cy="52" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.5" />
        <circle cx="210" cy="60" r="3.5" fill="oklch(74.1% 0.131 82.1)" />
        <circle cx="220" cy="78" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.6" />
    </svg>

    <p class="error-code">403</p>
    <h1 class="error-title">Acceso denegado</h1>
    <p class="error-body">
        No tienes permiso para acceder a este recurso. Si crees que es un error, contacta con el administrador.
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
