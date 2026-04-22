<x-layouts.guest title="Recuperar contraseña">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-key text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Recuperar contraseña</h1>
            <p class="text-sm opacity-60">Te enviaremos un enlace de restablecimiento</p>
        </div>
    </div>

    <div x-data="forgotPasswordForm">
        {{-- Success dinámico (XHR) --}}
        <template x-if="status">
            <x-admin.ui.alert type="success" class="mb-4">
                <span x-text="status"></span>
            </x-admin.ui.alert>
        </template>

        {{-- Success de sesión (fallback) --}}
        @if (session('status'))
            <x-admin.ui.alert type="success" class="mb-4">
                {{ session('status') }}
            </x-admin.ui.alert>
        @endif

        <form @submit.prevent="submit" novalidate>
            @csrf

            <div class="flex flex-col gap-4">
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        Correo electrónico <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2"
                        :class="form.invalid('email') && 'input-error'">
                        <i class="icofont-email opacity-60"></i>
                        <input type="email" name="email" autocomplete="email" placeholder="correo@ejemplo.com"
                            class="grow" x-model="form.email" @blur="validateField('email')"
                            :aria-invalid="form.invalid('email')" />
                    </label>
                    <p class="fieldset-label">
                        <span class="text-error flex items-center gap-1" x-show="form.invalid('email')" x-cloak
                            x-transition>
                            <i class="icofont-warning-alt"></i>
                            <span x-text="form.errors.email"></span>
                        </span>
                    </p>
                </fieldset>

                <button type="submit" class="btn btn-primary btn-block" :disabled="form.processing">
                    <span x-show="!form.processing" class="flex items-center gap-2">
                        <i class="icofont-email"></i> Enviar enlace de recuperación
                    </span>
                    <span x-show="form.processing" class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-sm text-primary hover:underline inline-flex items-center gap-1">
            <i class="icofont-arrow-left"></i> Volver al inicio de sesión
        </a>
    </div>
</x-layouts.guest>
