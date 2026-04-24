<x-layouts.guest :title="__('admin.auth.register_title')">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-ui-user text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">{{ __('admin.auth.register_title') }}</h1>
            <p class="text-sm opacity-60">{{ __('admin.auth.register_sub') }}</p>
        </div>
    </div>

    <div x-data="registerForm('{{ route('register') }}', '{{ route('dashboard') }}')">
        <form @submit.prevent="submit" novalidate>
            @csrf

            <div class="flex flex-col gap-4">
                {{-- Name --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        {{ __('admin.auth.name') }} <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('name') && 'input-error'">
                        <i class="icofont-ui-user opacity-60"></i>
                        <input type="text" name="name" autocomplete="name" placeholder="Tu nombre" class="grow" x-model="form.name" @blur="validateField('name')" :aria-invalid="form.invalid('name')" />
                    </label>
                    <p class="fieldset-label">
                        <span class="text-error flex items-center gap-1" x-show="form.invalid('name')" x-cloak x-transition>
                            <i class="icofont-warning-alt"></i>
                            <span x-text="form.errors.name"></span>
                        </span>
                    </p>
                </fieldset>

                {{-- Email --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        {{ __('admin.auth.email') }} <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('email') && 'input-error'">
                        <i class="icofont-email opacity-60"></i>
                        <input type="email" name="email" autocomplete="email" placeholder="correo@ejemplo.com" class="grow" x-model="form.email" @blur="validateField('email')" :aria-invalid="form.invalid('email')" />
                    </label>
                    <p class="fieldset-label">
                        <span class="text-error flex items-center gap-1" x-show="form.invalid('email')" x-cloak x-transition>
                            <i class="icofont-warning-alt"></i>
                            <span x-text="form.errors.email"></span>
                        </span>
                    </p>
                </fieldset>

                {{-- Password --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        {{ __('admin.auth.password') }} <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('password') && 'input-error'">
                        <i class="icofont-lock opacity-60"></i>
                        <input type="password" name="password" autocomplete="new-password" placeholder="Mínimo 8 caracteres" class="grow" x-model="form.password" @blur="validateField('password')" :aria-invalid="form.invalid('password')" />
                    </label>
                    <p class="fieldset-label">
                        <span class="text-error flex items-center gap-1" x-show="form.invalid('password')" x-cloak x-transition>
                            <i class="icofont-warning-alt"></i>
                            <span x-text="form.errors.password"></span>
                        </span>
                    </p>
                </fieldset>

                {{-- Password confirmation --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        {{ __('admin.auth.password_confirm') }} <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2" :class="form.invalid('password_confirmation') && 'input-error'">
                        <i class="icofont-lock opacity-60"></i>
                        <input type="password" name="password_confirmation" autocomplete="new-password" placeholder="Repite la contraseña" class="grow" x-model="form.password_confirmation" @blur="validateField('password_confirmation')" :aria-invalid="form.invalid('password_confirmation')" />
                    </label>
                    <p class="fieldset-label">
                        <span class="text-error flex items-center gap-1" x-show="form.invalid('password_confirmation')" x-cloak x-transition>
                            <i class="icofont-warning-alt"></i>
                            <span x-text="form.errors.password_confirmation"></span>
                        </span>
                    </p>
                </fieldset>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block" :disabled="form.processing">
                    <span x-show="!form.processing" class="flex items-center gap-2">
                        <i class="icofont-check-circled"></i> {{ __('admin.auth.register_btn') }}
                    </span>
                    <span x-show="form.processing" class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>

    <div class="divider text-xs opacity-50 mt-4">{{ __('admin.auth.has_account') }}</div>
    <a href="{{ route('login') }}" class="btn btn-outline btn-block">
        <i class="icofont-login"></i> {{ __('admin.auth.login_btn') }}
    </a>
</x-layouts.guest>
