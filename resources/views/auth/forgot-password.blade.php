<x-layouts.guest title="Recuperar contraseña">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-key text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Recuperar contraseña</h1>
            <p class="text-sm opacity-60">Te enviaremos un enlace de restablecimiento</p>
        </div>
    </div>

    {{-- Success status --}}
    @if (session('status'))
        <x-admin.ui.alert type="success" class="mb-4">
            {{ session('status') }}
        </x-admin.ui.alert>
    @endif

    <form method="POST" action="/forgot-password">
        @csrf

        <div class="flex flex-col gap-4">
            <x-admin.ui.input
                name="email"
                label="Correo electrónico"
                type="email"
                icon="icofont-email"
                placeholder="correo@ejemplo.com"
                :value="old('email')"
                required
            />

            <x-admin.ui.button type="submit" icon="icofont-email" block>
                Enviar enlace de recuperación
            </x-admin.ui.button>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}"
           class="text-sm text-primary hover:underline inline-flex items-center gap-1">
            <i class="icofont-arrow-left"></i>
            Volver al inicio de sesión
        </a>
    </div>
</x-layouts.guest>
