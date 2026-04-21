<x-layouts.guest title="Crear cuenta">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-ui-user text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">Crear cuenta</h1>
            <p class="text-sm opacity-60">Únete a CIFO La Violeta</p>
        </div>
    </div>

    <form method="POST" action="/register" x-data="{
              form: $form('post', '/register', {
                  name: '',
                  email: '',
                  password: '',
                  password_confirmation: '',
              })
          }" @submit.prevent="form.submit()">
        @csrf

        <div class="flex flex-col gap-4">
            {{-- Name --}}
            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend">
                    Nombre completo <span class="text-error">*</span>
                </legend>
                <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('name') ? 'input-error' : ''">
                    <i class="icofont-ui-user opacity-60"></i>
                    <input type="text" name="name" id="name" placeholder="Tu nombre" autocomplete="name" required class="grow" x-model="form.name" @change="form.validate('name')" :aria-invalid="form.invalid('name') ? 'true' : 'false'" aria-describedby="name-help" />
                </label>
                <p id="name-help" class="fieldset-label">
                    <span class="text-error flex items-center gap-1" x-show="form.invalid('name')" x-cloak>
                        <i class="icofont-warning-alt"></i>
                        <span x-text="form.errors.name"></span>
                    </span>
                    @error('name')
                    <span class="text-error flex items-center gap-1">
                        <i class="icofont-warning-alt"></i> {{ $message }}
                    </span>
                    @enderror
                </p>
            </fieldset>

            {{-- Email --}}
            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend">
                    Correo electrónico <span class="text-error">*</span>
                </legend>
                <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('email') ? 'input-error' : ''">
                    <i class="icofont-email opacity-60"></i>
                    <input type="email" name="email" id="email" placeholder="correo@ejemplo.com" autocomplete="email" required class="grow" x-model="form.email" @change="form.validate('email')" :aria-invalid="form.invalid('email') ? 'true' : 'false'" aria-describedby="email-help" />
                </label>
                <p id="email-help" class="fieldset-label">
                    <span class="text-error flex items-center gap-1" x-show="form.invalid('email')" x-cloak>
                        <i class="icofont-warning-alt"></i>
                        <span x-text="form.errors.email"></span>
                    </span>
                    @error('email')
                    <span class="text-error flex items-center gap-1">
                        <i class="icofont-warning-alt"></i> {{ $message }}
                    </span>
                    @enderror
                </p>
            </fieldset>

            {{-- Password --}}
            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend">
                    Contraseña <span class="text-error">*</span>
                </legend>
                <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('password') ? 'input-error' : ''">
                    <i class="icofont-lock opacity-60"></i>
                    <input type="password" name="password" id="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required class="grow" x-model="form.password" @change="form.validate('password')" :aria-invalid="form.invalid('password') ? 'true' : 'false'" aria-describedby="password-help" />
                </label>
                <p id="password-help" class="fieldset-label">
                    <span class="text-error flex items-center gap-1" x-show="form.invalid('password')" x-cloak>
                        <i class="icofont-warning-alt"></i>
                        <span x-text="form.errors.password"></span>
                    </span>
                    @error('password')
                    <span class="text-error flex items-center gap-1">
                        <i class="icofont-warning-alt"></i> {{ $message }}
                    </span>
                    @enderror
                </p>
            </fieldset>

            {{-- Password confirmation --}}
            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend">
                    Confirmar contraseña <span class="text-error">*</span>
                </legend>
                <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('password_confirmation') ? 'input-error' : ''">
                    <i class="icofont-lock opacity-60"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repite la contraseña" autocomplete="new-password" required class="grow" x-model="form.password_confirmation" @change="form.validate('password_confirmation')" :aria-invalid="form.invalid('password_confirmation') ? 'true' : 'false'" aria-describedby="password_confirmation-help" />
                </label>
                <p id="password_confirmation-help" class="fieldset-label">
                    <span class="text-error flex items-center gap-1" x-show="form.invalid('password_confirmation')" x-cloak>
                        <i class="icofont-warning-alt"></i>
                        <span x-text="form.errors.password_confirmation"></span>
                    </span>
                    @error('password_confirmation')
                    <span class="text-error flex items-center gap-1">
                        <i class="icofont-warning-alt"></i> {{ $message }}
                    </span>
                    @enderror
                </p>
            </fieldset>

            {{-- Submit --}}
            <x-admin.ui.button type="submit" icon="icofont-check-circled" block x-bind:loading="form.processing">
                Crear cuenta
            </x-admin.ui.button>
        </div>
    </form>

    {{-- Login link --}}
    <div class="divider text-xs opacity-50 mt-4">¿Ya tienes cuenta?</div>
    <a href="{{ route('login') }}" class="btn btn-outline btn-block">
        <i class="icofont-login"></i>
        Iniciar sesión
    </a>
</x-layouts.guest>
