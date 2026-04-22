<x-layouts.guest title="Verificar correo electrónico">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-email text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Verifica tu correo</h1>
            <p class="text-sm opacity-60">Un paso más para acceder</p>
        </div>
    </div>

    {{-- Resend success --}}
    @if (session('status') === 'verification-link-sent')
    <x-admin.ui.alert type="success" dismissible class="mb-4">
        Hemos enviado un nuevo enlace de verificación a tu dirección de correo.
    </x-admin.ui.alert>
    @endif

    <div class="prose prose-sm max-w-none mb-6">
        <p class="text-base-content/70">
            Gracias por registrarte. Antes de continuar, verifica tu dirección de correo
            haciendo clic en el enlace que te hemos enviado. Si no lo recibiste, solicita uno nuevo.
        </p>
    </div>

    {{-- Resend button --}}
    <form method="POST" action="/email/verification-notification" class="mb-3">
        @csrf
        <x-admin.ui.button type="submit" icon="icofont-email" block>
            Reenviar correo de verificación
        </x-admin.ui.button>
    </form>

    {{-- Logout --}}
    <form method="POST" action="/logout">
        @csrf
        <x-admin.ui.button type="submit" variant="neutral" ghost block>
            <i class="icofont-logout"></i>
            Cerrar sesión
        </x-admin.ui.button>
    </form>
</x-layouts.guest>
