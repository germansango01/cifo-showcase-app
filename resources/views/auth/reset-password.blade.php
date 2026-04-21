<x-layouts.guest title="Nueva contraseña">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-lock text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Nueva contraseña</h1>
            <p class="text-sm opacity-60">Elige una contraseña segura para tu cuenta</p>
        </div>
    </div>

    <form method="POST" action="/reset-password">
        @csrf

        {{-- Hidden fields --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}" />

        <div class="flex flex-col gap-4">
            <x-admin.ui.input name="email" label="Correo electrónico" type="email" icon="icofont-email" placeholder="correo@ejemplo.com" :value="old('email', $request->email)" required />

            <x-admin.ui.input name="password" label="Nueva contraseña" type="password" icon="icofont-lock" placeholder="Mínimo 8 caracteres" required />

            <x-admin.ui.input name="password_confirmation" label="Confirmar contraseña" type="password" icon="icofont-lock" placeholder="Repite la contraseña" required />

            <x-admin.ui.button type="submit" icon="icofont-check-circled" block>
                Restablecer contraseña
            </x-admin.ui.button>
        </div>
    </form>
</x-layouts.guest>
