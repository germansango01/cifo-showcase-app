<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? config('app.name') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:title" content="{{ $title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $description ?? config('app.name') }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('img/og-default.jpg') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <title>{{ isset($title) ? $title . ' — ' . config('app.name') : config('app.name') }}</title>

    {{-- Favicon --}}
    <link rel="icon"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E🟣%3C/text%3E%3C/svg%3E">

    {{-- Front CSS (vanilla — no Tailwind/DaisyUI) --}}
    @vite('resources/css/app.css')

    {{-- Extra head content from pages --}}
    {{ $head ?? '' }}
</head>

<body class="page">

    {{-- Accessibility skip link --}}
    <a href="#main-content" class="skip-link">Saltar al contenido</a>

    {{-- ── Header ────────────────────────────────────── --}}
    <x-front.header />

    {{-- ── Main Content ────────────────────────────────── --}}
    <main id="main-content">
        {{ $slot }}
    </main>

    {{-- ── Footer ─────────────────────────────────────── --}}
    <x-front.footer />

    {{-- ── Mobile nav drawer ──────────────────────────── --}}
    <x-front.mobile-nav />

    {{-- ── Back to top ─────────────────────────────────── --}}
    <button id="back-to-top" class="back-to-top" aria-label="Volver al inicio de la página">

        <i class="icofont-arrow-up"></i>
    </button>

    {{-- Front Scripts --}}
    @vite('resources/js/app.js')

    {{-- Extra scripts from pages --}}
    {{ $scripts ?? '' }}
</body>

</html>
