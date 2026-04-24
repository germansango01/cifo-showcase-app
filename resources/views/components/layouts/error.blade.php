@props(['title' => 'Error'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · CIFO La Violeta</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-primary: oklch(46.9% 0.152 301.7);
            --color-secondary: oklch(74.1% 0.131 82.1);
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100dvh;
            display: grid;
            place-items: center;
            background: #f8f7fc;
            color: #1a1625;
            padding: 1.5rem;
        }

        .error-card {
            max-width: 480px;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .error-card svg {
            width: 16rem;
            height: auto;
            margin-bottom: 1.5rem;
        }

        .error-code {
            font-size: 3.75rem;
            font-weight: 900;
            color: var(--color-primary);
            line-height: 1;
            margin-bottom: 0.5rem;
            font-variant-numeric: tabular-nums;
        }

        .error-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .error-body {
            font-size: 0.875rem;
            opacity: 0.6;
            margin-bottom: 1.5rem;
            max-width: 22rem;
            line-height: 1.5;
        }

        .error-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }

        @media (min-width: 640px) {
            .error-buttons { flex-direction: row; }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: opacity 0.15s;
            flex: 1;
        }

        .btn:hover { opacity: 0.85; }

        .btn-primary {
            background: var(--color-primary);
            color: #fff;
        }

        .btn-ghost {
            background: transparent;
            color: var(--color-primary);
            border: 1.5px solid var(--color-primary);
        }
    </style>
</head>
<body>
    <div class="error-card">
        {{ $slot }}
    </div>
</body>
</html>
