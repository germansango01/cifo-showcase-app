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

    {{-- Session errors --}}
    @if ($errors->has('email') && ! $errors->has('email'))
        {{-- handled below --}}
    @endif

    @if (session('status'))
        <x-admin.ui.alert type="info" class="mb-4">
            {{ session('status') }}
        </x-admin.ui.alert>
    @endif

    <form method="POST" action="/login"
          x-data="{
              form: $form('post', '/login', {
                  email: '',
                  password: '',
                  remember: false,
              })
          }"
          @submit.prevent="form.submit()">
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
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="correo@ejemplo.com"
                        autocomplete="email"
                        required
                        class="grow"
                        x-model="form.email"
                        @change="form.validate('email')"
                        :aria-invalid="form.invalid('email') ? 'true' : 'false'"
                        aria-describedby="email-help"
                    />
                </label>
                <p id="email-help" class="fieldset-label">
                    <span class="text-error flex items-center gap-1"
                          x-show="form.invalid('email')" x-cloak>
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
                <label class="input input-bordered w-full flex items-center gap-2"
                       :class="form.invalid('password') ? 'input-error' : ''">
                    <i class="icofont-lock opacity-60"></i>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                        class="grow"
                        x-model="form.password"
                        @change="form.validate('password')"
                        :aria-invalid="form.invalid('password') ? 'true' : 'false'"
                        aria-describedby="password-help"
                    />
                </label>
                <p id="password-help" class="fieldset-label">
                    <span class="text-error flex items-center gap-1"
                          x-show="form.invalid('password')" x-cloak>
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

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between">
                <label class="label cursor-pointer gap-2">
                    <input type="checkbox" name="remember" id="remember"
                           class="checkbox checkbox-primary checkbox-sm"
                           x-model="form.remember" />
                    <span class="label-text text-sm">Recordarme</span>
                </label>
                <a href="{{ route('password.request') }}"
                   class="text-sm text-primary hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            {{-- Submit --}}
            <x-admin.ui.button type="submit" icon="icofont-login" block
                               x-bind:loading="form.processing">
                Iniciar sesión
            </x-admin.ui.button>
        </div>
    </form>

    {{-- Register link --}}
    <div class="divider text-xs opacity-50 mt-4">¿Nuevo en CIFO?</div>
    <a href="{{ route('register') }}"
       class="btn btn-outline btn-block">
        <i class="icofont-ui-user"></i>
        Crear una cuenta
    </a>
</x-layouts.guest>
