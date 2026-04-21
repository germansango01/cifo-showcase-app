<x-layouts.guest title="Iniciar sesión">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-login text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Iniciar sesión</h1>
            <p class="text-sm opacity-60">Accede a tu cuenta de CIFO</p>
        </div>
    </div>

    {{-- Formulario con Precognition --}}
    <div x-data="loginForm">
        <form @submit.prevent="submit">
            @csrf

            <div class="flex flex-col gap-4">
                {{-- Email --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        Correo electrónico <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2"
                        :class="form.invalid('email') ? 'input-error' : ''">
                        <i class="icofont-email opacity-60"></i>
                        <input type="email" id="email" placeholder="correo@ejemplo.com" autocomplete="email"
                            required class="grow" x-model="form.email" @change="form.validate('email')"
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

                {{-- Password --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        Contraseña <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2"
                        :class="form.invalid('password') ? 'input-error' : ''">
                        <i class="icofont-lock opacity-60"></i>
                        <input type="password" id="password" placeholder="••••••••" autocomplete="current-password"
                            required class="grow" x-model="form.password" @change="form.validate('password')"
                            :aria-invalid="form.invalid('password')" />
                    </label>
                    <p class="fieldset-label">
                        <span class="text-error flex items-center gap-1" x-show="form.invalid('password')" x-cloak
                            x-transition>
                            <i class="icofont-warning-alt"></i>
                            <span x-text="form.errors.password"></span>
                        </span>
                    </p>
                </fieldset>

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="label cursor-pointer gap-2">
                        <input type="checkbox" id="remember" class="checkbox checkbox-primary checkbox-sm"
                            x-model="form.remember" />
                        <span class="label-text text-sm">Recordarme</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block" :disabled="form.processing">
                    <span x-show="!form.processing" class="flex items-center gap-2">
                        <i class="icofont-login"></i>
                        Iniciar sesión
                    </span>
                    <span x-show="form.processing" class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>

    {{-- Register link --}}
    <div class="divider text-xs opacity-50 mt-4">¿Nuevo en CIFO?</div>
    <a href="{{ route('register') }}" class="btn btn-outline btn-block">
        <i class="icofont-ui-user"></i>
        Crear una cuenta
    </a>
</x-layouts.guest>
