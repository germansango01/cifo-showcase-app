<x-layouts.guest title="Confirmar contraseña">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-shield text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Confirma tu contraseña</h1>
            <p class="text-sm opacity-60">Por seguridad, verifica tu identidad para continuar</p>
        </div>
    </div>

    <div class="prose prose-sm max-w-none mb-6">
        <p class="text-base-content/70">
            Estás accediendo a una zona segura. Introduce tu contraseña actual para confirmar
            que eres tú.
        </p>
    </div>

    <form method="POST" action="/user/confirm-password">
        @csrf

        <div class="flex flex-col gap-4">
            <x-admin.ui.input
                name="password"
                label="Contraseña"
                type="password"
                icon="icofont-lock"
                placeholder="Tu contraseña actual"
                autocomplete="current-password"
                required
            />

            <x-admin.ui.button type="submit" icon="icofont-shield" block>
                Confirmar contraseña
            </x-admin.ui.button>
        </div>
    </form>
</x-layouts.guest>
