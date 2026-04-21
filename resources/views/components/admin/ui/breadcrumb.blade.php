@props(['items'])

<div {{ $attributes->merge(['class' => 'breadcrumbs text-sm mb-4']) }}>
    <ul>
        {{-- Home --}}
        <li>
            <a href="{{ route('dashboard') }}" aria-label="Dashboard">
                <i class="icofont-dashboard-web text-base"></i>
            </a>
        </li>

        @foreach ($items as $item)
            @php
                $label = is_array($item) ? $item['label'] ?? $item[0] : $item;
                $href = is_array($item) ? $item['href'] ?? ($item[1] ?? null) : null;
                $isLast = $loop->last;
            @endphp

            <li>
                @if ($href && !$isLast)
                    <a href="{{ $href }}" class="hover:text-primary transition-colors">{{ $label }}</a>
                @else
                    <span class="{{ $isLast ? 'text-base-content/60' : '' }}">{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
