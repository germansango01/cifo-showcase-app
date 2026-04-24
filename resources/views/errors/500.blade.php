<x-layouts.error title="Error del servidor">

    <svg viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <circle cx="140" cy="100" r="90" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.08" />
        <circle cx="140" cy="100" r="68" fill="oklch(46.9% 0.152 301.7)" fill-opacity="0.06" />
        <rect x="88" y="50" width="104" height="32" rx="6" fill="white"
            stroke="oklch(46.9% 0.152 301.7)" stroke-width="2" />
        <rect x="88" y="92" width="104" height="32" rx="6" fill="white"
            stroke="oklch(46.9% 0.152 301.7)" stroke-width="2" />
        <rect x="88" y="134" width="104" height="32" rx="6" fill="white"
            stroke="oklch(46.9% 0.152 301.7)" stroke-width="2" />
        <circle cx="105" cy="66" r="4" fill="oklch(74.6% 0.181 152.3)" />
        <circle cx="119" cy="66" r="4" fill="oklch(74.6% 0.181 152.3)" />
        <circle cx="105" cy="108" r="4" fill="oklch(63.1% 0.194 29.4)" />
        <circle cx="119" cy="108" r="4" fill="oklch(76.3% 0.163 69.4)" />
        <circle cx="105" cy="150" r="4" fill="oklch(63.1% 0.194 29.4)" />
        <circle cx="119" cy="150" r="4" fill="oklch(63.1% 0.194 29.4)" />
        <rect x="134" y="62" width="44" height="4" rx="2" fill="oklch(46.9% 0.152 301.7)"
            fill-opacity="0.2" />
        <rect x="134" y="104" width="44" height="4" rx="2" fill="oklch(46.9% 0.152 301.7)"
            fill-opacity="0.2" />
        <rect x="134" y="146" width="44" height="4" rx="2" fill="oklch(46.9% 0.152 301.7)"
            fill-opacity="0.2" />
        <path d="M196 44 L182 76 L194 76 L180 112 L210 72 L196 72 Z" fill="oklch(74.1% 0.131 82.1)"
            stroke="oklch(74.1% 0.131 82.1)" stroke-width="1" stroke-linejoin="round" />
        <circle cx="66" cy="80" r="3.5" fill="oklch(74.1% 0.131 82.1)" />
        <circle cx="74" cy="60" r="2" fill="oklch(74.1% 0.131 82.1)" opacity="0.6" />
        <circle cx="58" cy="96" r="2.5" fill="oklch(74.1% 0.131 82.1)" opacity="0.5" />
    </svg>

    <p class="error-code">500</p>
    <h1 class="error-title">Error interno del servidor</h1>
    <p class="error-body">
        Algo ha fallado en el servidor. Ya estamos trabajando en ello. Vuelve a intentarlo en unos instantes.
    </p>

    <div class="error-buttons">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Ir al Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
        @endauth
        <button type="button" onclick="location.reload()" class="btn btn-ghost">Reintentar</button>
    </div>

</x-layouts.error>
