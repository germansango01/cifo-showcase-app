<x-layouts.guest :title="__('admin.auth.login_title')">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-login text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">{{ __('admin.auth.login_title') }}</h1>
            <p class="text-sm opacity-60">{{ __('admin.auth.login_sub') }}</p>
        </div>
    </div>

    <div x-data="loginForm('{{ route('login') }}', '{{ route('dashboard') }}')">
        <form @submit.prevent="submit" novalidate>
            @csrf

            <div class="flex flex-col gap-4">
                {{-- Email --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        {{ __('admin.auth.email') }} <span class="text-error">*</span>
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

                {{-- Password --}}
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        {{ __('admin.auth.password') }} <span class="text-error">*</span>
                    </legend>
                    <label class="input input-bordered w-full flex items-center gap-2"
                        :class="form.invalid('password') && 'input-error'">
                        <i class="icofont-lock opacity-60"></i>
                        <input type="password" name="password" autocomplete="current-password" placeholder="••••••••"
                            class="grow" x-model="form.password" @blur="validateField('password')"
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
                        <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm"
                            x-model="form.remember" />
                        <span class="label-text text-sm">{{ __('admin.auth.remember') }}</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                        {{ __('admin.auth.forgot') }}
                    </a>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block" :disabled="form.processing">
                    <span x-show="!form.processing" class="flex items-center gap-2">
                        <i class="icofont-login"></i> {{ __('admin.auth.login_btn') }}
                    </span>
                    <span x-show="form.processing" class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>

    <div class="divider text-xs opacity-50 mt-4">{{ __('admin.auth.new_user') }}</div>
    <a href="{{ route('register') }}" class="btn btn-outline btn-block">
        <i class="icofont-ui-user"></i> {{ __('admin.auth.register_link') }}
    </a>
</x-layouts.guest>
