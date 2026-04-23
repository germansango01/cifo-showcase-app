<x-layouts.guest title="Nueva contraseña">
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

        <input type="hidden" name="token" value="{{ $request->route('token') }}" />
        <input type="hidden" name="email" value="{{ old('email', $request->email) }}" />

        <div class="flex flex-col gap-4">
            {{-- Mostrar a quién pertenece el reset --}}
            <div class="bg-base-200 rounded-lg px-4 py-3 text-sm flex items-center gap-2">
                <i class="icofont-email opacity-60"></i>
                <span class="opacity-70">{{ old('email', $request->email) }}</span>
            </div>

            <x-admin.ui.input name="password" label="Nueva contraseña" type="password" icon="icofont-lock"
                placeholder="Mínimo 8 caracteres" autocomplete="new-password" />

            <x-admin.ui.input name="password_confirmation" label="Confirmar contraseña" type="password"
                icon="icofont-lock" placeholder="Repite la contraseña" autocomplete="new-password" />

            <x-admin.ui.button type="submit" icon="icofont-check-circled" block>
                Restablecer contraseña
            </x-admin.ui.button>
        </div>
    </form>
</x-layouts.guest>
