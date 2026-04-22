<x-layouts.guest title="Confirmar contraseña">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-shield text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Confirma tu contraseña</h1>
            <p class="text-sm opacity-60">Por seguridad, verifica tu identidad para continuar</p>
        </div>
    </div>

    <p class="text-sm text-base-content/70 mb-6">
        Estás accediendo a una zona segura. Introduce tu contraseña actual para confirmar que eres tú.
    </p>

    <div x-data="confirmPasswordForm">
        <form @submit.prevent="submit" novalidate>
            @csrf

            <div class="flex flex-col gap-4">
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        Contraseña <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2"
                        :class="form.invalid('password') && 'input-error'">
                        <i class="icofont-lock opacity-60"></i>
                        <input type="password" name="password" autocomplete="current-password"
                            placeholder="Tu contraseña actual" class="grow" x-model="form.password"
                            @blur="validateField('password')" :aria-invalid="form.invalid('password')" />
                    </label>
                    <p class="fieldset-label">
                        <span class="text-error flex items-center gap-1" x-show="form.invalid('password')" x-cloak
                            x-transition>
                            <i class="icofont-warning-alt"></i>
                            <span x-text="form.errors.password"></span>
                        </span>
                    </p>
                </fieldset>

                <button type="submit" class="btn btn-primary btn-block" :disabled="form.processing">
                    <span x-show="!form.processing" class="flex items-center gap-2">
                        <i class="icofont-shield"></i> Confirmar contraseña
                    </span>
                    <span x-show="form.processing" class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
</x-layouts.guest>
