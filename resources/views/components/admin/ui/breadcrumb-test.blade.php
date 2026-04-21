@props([
    'items' => [],
    {{-- array de ['label' => string, 'href' => string|null] --}},
])

@php
    /**
     * Si no se pasan items, intenta generar el breadcrumb automáticamente
     * a partir de los segmentos de la URL actual.
     * En páginas complejas, pasa los items manualmente para mayor control.
     */
    if (empty($items)) {
        $items = [['label' => 'Dashboard', 'href' => route('dashboard')]];

        $segments = array_filter(request()->segments());
        $labelMap = [
            'users' => 'Usuarios',
            'roles' => 'Roles',
            'permissions' => 'Permisos',
            'profile' => 'Mi perfil',
            'create' => 'Crear',
            'edit' => 'Editar',
            'show' => 'Detalle',
            'dashboard' => 'Dashboard',
        ];

        $path = '';
        foreach ($segments as $i => $segment) {
            $path .= '/' . $segment;
            $isLast = $i === array_key_last($segments);
            $label = $labelMap[$segment] ?? ucfirst($segment);

            // Omitir "dashboard" del auto-breadcrumb (ya está como home)
            if ($segment === 'dashboard') {
                continue;
            }

            // Si es un UUID/número, lo etiquetamos como "Detalle #X"
            if (is_numeric($segment) || strlen($segment) === 36) {
                $label = '#' . substr($segment, 0, 8);
            }

            $items[] = [
                'label' => $label,
                'href' => $isLast ? null : url($path),
            ];
        }
    }
@endphp

<nav aria-label="Migas de pan">
    <div class="breadcrumbs text-sm py-0 max-w-full overflow-hidden">
        <ul class="flex-nowrap">

            {{-- Home siempre primero --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-1 text-base-content/60 hover:text-primary transition-colors"
                    aria-label="Inicio — Dashboard">
                    <i class="icofont-dashboard-web text-base" aria-hidden="true"></i>
                    <span class="sr-only">Inicio</span>
                </a>
            </li>

            {{-- Items del breadcrumb --}}
            @foreach ($items as $index => $item)
                @php $isLast = $loop->last; @endphp

                {{-- Saltar el primer item si es "Dashboard" para no duplicar el home --}}
                @if ($index === 0 && strtolower($item['label']) === 'dashboard')
                    @continue
                @endif

                <li>
                    @if (!$isLast && isset($item['href']))
                        <a href="{{ $item['href'] }}"
                            class="text-base-content/60 hover:text-primary transition-colors truncate max-w-32">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-base-content font-medium truncate max-w-40" aria-current="page">
                            {{ $item['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach

        </ul>
    </div>
</nav>
