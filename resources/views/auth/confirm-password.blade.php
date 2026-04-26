<x-layouts.guest :title="__('admin.auth.confirm_title')">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-shield text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">{{ __('admin.auth.confirm_title') }}</h1>
            <p class="text-sm opacity-60">{{ __('admin.auth.confirm_sub') }}</p>
        </div>
    </div>

    <p class="text-sm text-base-content/70 mb-6">
        {{ __('admin.auth.confirm_body') }}
    </p>

    <div x-data="confirmPasswordForm('{{ route('password.confirm') }}')">
        <form @submit.prevent="submit" novalidate>
            @csrf

            <div class="flex flex-col gap-4">
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">
                        {{ __('admin.auth.password') }} <span class="text-error">*</span>
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
                        <i class="icofont-shield"></i> {{ __('admin.auth.confirm_btn') }}
                    </span>
                    <span x-show="form.processing" class="loading loading-spinner loading-sm"></span>
                </button>
            </div>
        </form>
    </div>
</x-layouts.guest>
