<x-layouts.guest :title="__('admin.auth.two_factor_title')">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-mobile-phone text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">{{ __('admin.auth.two_factor_title') }}</h1>
            <p class="text-sm opacity-60">{{ __('admin.auth.two_factor_sub') }}</p>
        </div>
    </div>

    <div x-data="{ useRecovery: false }">

        {{-- Code mode --}}
        <div x-show="! useRecovery">
            <p class="text-sm text-base-content/70 mb-4">
                {{ __('admin.auth.two_factor_body') }}
            </p>

            <form method="POST" action="/two-factor-challenge">
                @csrf

                <div class="flex flex-col gap-4">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend">
                            {{ __('admin.auth.auth_code') }} <span class="text-error">*</span>
                        </legend>
                        <label
                            class="input input-bordered w-full flex items-center gap-2
                                      @error('code') input-error @enderror">
                            <i class="icofont-mobile-phone opacity-60"></i>
                            <input type="text" name="code" id="code" inputmode="numeric"
                                autocomplete="one-time-code" placeholder="000000" maxlength="6" required
                                class="grow tracking-widest font-mono text-center"
                                aria-invalid="{{ $errors->has('code') ? 'true' : 'false' }}"
                                aria-describedby="code-help" autofocus />
                        </label>
                        <p id="code-help" class="fieldset-label">
                            @error('code')
                                <span class="text-error flex items-center gap-1">
                                    <i class="icofont-warning-alt"></i> {{ $message }}
                                </span>
                            @enderror
                        </p>
                    </fieldset>

                    <x-admin.ui.button type="submit" icon="icofont-check-circled" block>
                        {{ __('admin.auth.verify_code_btn') }}
                    </x-admin.ui.button>
                </div>
            </form>
        </div>

        {{-- Recovery mode --}}
        <div x-show="useRecovery" x-cloak>
            <p class="text-sm text-base-content/70 mb-4">
                {{ __('admin.auth.recovery_body') }}
            </p>

            <form method="POST" action="/two-factor-challenge">
                @csrf

                <div class="flex flex-col gap-4">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend">
                            {{ __('admin.auth.recovery_code') }} <span class="text-error">*</span>
                        </legend>
                        <label
                            class="input input-bordered w-full flex items-center gap-2
                                      @error('recovery_code') input-error @enderror">
                            <i class="icofont-key opacity-60"></i>
                            <input type="text" name="recovery_code" id="recovery_code" autocomplete="one-time-code"
                                placeholder="xxxx-xxxx-xxxx" required class="grow font-mono"
                                aria-invalid="{{ $errors->has('recovery_code') ? 'true' : 'false' }}"
                                aria-describedby="recovery_code-help" />
                        </label>
                        <p id="recovery_code-help" class="fieldset-label">
                            @error('recovery_code')
                                <span class="text-error flex items-center gap-1">
                                    <i class="icofont-warning-alt"></i> {{ $message }}
                                </span>
                            @enderror
                        </p>
                    </fieldset>

                    <x-admin.ui.button type="submit" icon="icofont-check-circled" block>
                        {{ __('admin.auth.verify_recovery_btn') }}
                    </x-admin.ui.button>
                </div>
            </form>
        </div>

        {{-- Toggle --}}
        <div class="text-center mt-4">
            <button type="button" class="text-sm text-primary hover:underline inline-flex items-center gap-1"
                @click="useRecovery = ! useRecovery">
                <i class="icofont-exchange" x-cloak></i>
                <span
                    x-text="useRecovery
                    ? '{{ __('admin.auth.use_auth_code') }}'
                    : '{{ __('admin.auth.use_recovery_code') }}'">
                </span>
            </button>
        </div>

    </div>{{-- /x-data --}}
</x-layouts.guest>
