<x-layouts.guest title="Acceso denegado">
    <div class="text-center py-8">
        <i class="icofont-close-circled text-error text-6xl mb-4 block"></i>
        <h1 class="text-3xl font-bold mb-2">403 — Sin permiso</h1>
        <p class="opacity-70 mb-6">No tienes autorización para acceder a esta sección.</p>
        <x-admin.ui.button :href="route('dashboard')" icon="icofont-dashboard-web">
            Volver al dashboard
        </x-admin.ui.button>
    </div>
</x-layouts.guest>
