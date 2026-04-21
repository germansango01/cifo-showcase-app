{{--
    Theme toggle: DaisyUI theme-controller (pure CSS) + Alpine para persistir en localStorage.
    Alterna entre cifo-light (día) y cifo-dark (noche).
    Requiere que el <html> tenga x-data con la variable theme (definida en layouts/app.blade.php).
--}}

<label class="btn btn-ghost btn-sm btn-square swap swap-rotate" aria-label="Cambiar tema"
    title="Cambiar tema claro / oscuro" x-data>
    {{-- Input de DaisyUI theme-controller --}}
    <input type="checkbox" class="theme-controller sr-only" value="cifo-dark"
        x-on:change="
            const newTheme = $event.target.checked ? 'cifo-dark' : 'cifo-light';
            $root.closest('[data-theme]')?.setAttribute('data-theme', newTheme);
            localStorage.setItem('cifo-theme', newTheme);
        "
        x-init="const saved = localStorage.getItem('cifo-theme');
        if (saved === 'cifo-dark') {
            $el.checked = true;
            $el.closest('[data-theme]')?.setAttribute('data-theme', 'cifo-dark');
        }" aria-label="Activar tema oscuro" />

    {{-- Icono Sol (tema claro activo) --}}
    <i class="swap-off icofont-sun-alt text-xl text-secondary" aria-hidden="true"></i>

    {{-- Icono Luna (tema oscuro activo) --}}
    <i class="swap-on icofont-moon text-xl text-secondary" aria-hidden="true"></i>
</label>
