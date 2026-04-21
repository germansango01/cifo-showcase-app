@props(['class' => ''])

<a href="{{ route('dashboard') }}"
    class="flex items-center gap-3 p-2 rounded-xl hover:bg-neutral-content/10 transition-colors group {{ $class }}"
    aria-label="CIFO La Violeta — Ir al dashboard">
    {{-- Isotipo: cuadrado con iniciales --}}
    <div
        class="shrink-0 w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg group-hover:bg-primary/80 transition-colors">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" aria-hidden="true">
            {{-- Flor/violeta estilizada --}}
            <circle cx="20" cy="20" r="5" fill="white" opacity="0.95" />
            <circle cx="20" cy="10" r="4" fill="white" opacity="0.75" />
            <circle cx="20" cy="30" r="4" fill="white" opacity="0.75" />
            <circle cx="10" cy="20" r="4" fill="white" opacity="0.75" />
            <circle cx="30" cy="20" r="4" fill="white" opacity="0.75" />
            <circle cx="13" cy="13" r="3" fill="white" opacity="0.50" />
            <circle cx="27" cy="13" r="3" fill="white" opacity="0.50" />
            <circle cx="13" cy="27" r="3" fill="white" opacity="0.50" />
            <circle cx="27" cy="27" r="3" fill="white" opacity="0.50" />
        </svg>
    </div>

    {{-- Texto del logo --}}
    <div class="flex flex-col leading-tight">
        <span class="font-bold text-base text-neutral-content tracking-tight">CIFO</span>
        <span class="text-xs text-secondary font-medium tracking-wide uppercase">La Violeta</span>
    </div>
</a>
