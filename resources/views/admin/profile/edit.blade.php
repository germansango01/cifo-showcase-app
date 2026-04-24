<x-layouts.admin :title="__('admin.profile.title')">

    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.profile.title')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.profile.title') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.profile.subtitle') }}</p>
    </div>

    {{-- =====================================================================
         TABS (DaisyUI 5 — radio-based, sin JS)
         ===================================================================== --}}
    <div class="tabs tabs-lift" role="tablist" aria-label="{{ __('admin.profile.title') }}">

        {{-- ---- Tab: Información ----------------------------------------- --}}
        <input type="radio" name="profile_tabs" class="tab" aria-label="{{ __('admin.profile.tab_info') }}" id="tab-info"
            {{ !session('tab') || session('tab') === 'info' ? 'checked' : '' }} />

        <div class="tab-content bg-base-100 border-base-300 rounded-box p-6">

            <form method="POST" action="/user/profile-information" x-data="{
                form: $form('post', '/user/profile-information', {
                    name: '{{ old('name', $user->name) }}',
                    email: '{{ old('email', $user->email) }}',
                })
            }"
                @submit.prevent="form.submit()">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="icofont-ui-user text-primary"></i> {{ __('admin.profile.info') }}
                </h2>

                @if ($errors->updateProfileInformation->any())
                    <x-admin.ui.alert type="error" dismissible class="mb-4">
                        {{ $errors->updateProfileInformation->first() }}
                    </x-admin.ui.alert>
                @endif

                @if (session('status') === 'profile-information-updated')
                    <x-admin.ui.alert type="success" dismissible class="mb-4">
                        {{ __('admin.profile.updated') }}
                    </x-admin.ui.alert>
                @endif

                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.ui.input name="name" :label="__('admin.users.full_name')" icon="icofont-ui-user" :value="$user->name"
                        required x-model="form.name" @change="form.validate('name')" />
                    <x-admin.ui.input name="email" type="email" :label="__('admin.common.email')" icon="icofont-email"
                        :value="$user->email" required x-model="form.email" @change="form.validate('email')" />
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <x-admin.ui.alert type="warning" class="mt-4">
                        {{ __('admin.profile.email_unverified') }}
                        <form method="POST" action="{{ route('verification.send') }}" class="inline">
                            @csrf
                            <button type="submit" class="link link-warning font-medium">
                                {{ __('admin.profile.resend_verification') }}
                            </button>
                        </form>
                    </x-admin.ui.alert>
                @endif

                <div class="flex justify-end mt-6">
                    <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                        {{ __('admin.common.save_changes') }}
                    </x-admin.ui.button>
                </div>
            </form>
        </div>

        {{-- ---- Tab: Contraseña ------------------------------------------ --}}
        <input type="radio" name="profile_tabs" class="tab" aria-label="{{ __('admin.profile.tab_password') }}" id="tab-password"
            {{ session('tab') === 'password' ? 'checked' : '' }} />

        <div class="tab-content bg-base-100 border-base-300 rounded-box p-6">

            <form method="POST" action="/user/password" x-data="{
                form: $form('put', '/user/password', {
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                })
            }" @submit.prevent="form.submit()">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="icofont-lock text-primary"></i> {{ __('admin.profile.password') }}
                </h2>

                @if ($errors->updatePassword->any())
                    <x-admin.ui.alert type="error" dismissible class="mb-4">
                        {{ $errors->updatePassword->first() }}
                    </x-admin.ui.alert>
                @endif

                @if (session('status') === 'password-updated')
                    <x-admin.ui.alert type="success" dismissible class="mb-4">
                        {{ __('admin.profile.password_updated') }}
                    </x-admin.ui.alert>
                @endif

                <div class="grid gap-4 max-w-md">
                    <x-admin.ui.input name="current_password" type="password" :label="__('admin.profile.current_password')"
                        icon="icofont-lock" required autocomplete="current-password" x-model="form.current_password"
                        @change="form.validate('current_password')" />
                    <x-admin.ui.input name="password" type="password" :label="__('admin.profile.new_password')" icon="icofont-lock"
                        required autocomplete="new-password" help="Mínimo 8 caracteres, mayúscula y número."
                        x-model="form.password" @change="form.validate('password')" />
                    <x-admin.ui.input name="password_confirmation" type="password" :label="__('admin.profile.confirm_new_password')"
                        icon="icofont-lock" required autocomplete="new-password" x-model="form.password_confirmation"
                        @change="form.validate('password_confirmation')" />
                </div>

                <div class="flex justify-end mt-6">
                    <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                        {{ __('admin.profile.update_password_btn') }}
                    </x-admin.ui.button>
                </div>
            </form>
        </div>

        {{-- ---- Tab: Autenticación 2FA ----------------------------------- --}}
        <input type="radio" name="profile_tabs" class="tab" aria-label="{{ __('admin.profile.tab_2fa') }}" id="tab-2fa"
            {{ session('tab') === '2fa' ? 'checked' : '' }} />

        <div class="tab-content bg-base-100 border-base-300 rounded-box p-6">

            <h2 class="text-lg font-semibold mb-1 flex items-center gap-2">
                <i class="icofont-shield text-primary"></i> {{ __('admin.profile.two_factor_title') }}
            </h2>
            <p class="text-sm opacity-70 mb-6">
                {{ __('admin.profile.two_factor_sub') }}
            </p>

            @if (session('status') === 'two-factor-authentication-enabled')
                <x-admin.ui.alert type="success" dismissible class="mb-4">
                    {{ __('admin.profile.two_factor_enabled') }}
                </x-admin.ui.alert>
            @endif

            @if (session('status') === 'two-factor-authentication-disabled')
                <x-admin.ui.alert type="info" dismissible class="mb-4">
                    {{ __('admin.profile.two_factor_disabled') }}
                </x-admin.ui.alert>
            @endif

            @if ($user->two_factor_secret)
                {{-- ---- 2FA HABILITADO ----------------------------------- --}}
                <div x-data="{ showCodes: {{ session('status') === 'two-factor-authentication-enabled' ? 'true' : 'false' }} }">

                    <div class="badge badge-success gap-1 mb-6">
                        <i class="icofont-check-circled"></i> {{ __('admin.profile.two_factor_active') }}
                    </div>

                    {{-- QR Code --}}
                    <div class="mb-6">
                        <p class="text-sm font-medium mb-3">
                            {{ __('admin.profile.two_factor_rescan') }}
                        </p>
                        <div class="bg-white p-4 rounded-box inline-block shadow border border-base-300">
                            {!! $user->twoFactorQrCodeSvg() !!}
                        </div>
                        <p class="text-xs opacity-60 mt-2">
                            {{ __('admin.profile.manual_key') }}
                            <code class="font-mono bg-base-200 px-1 rounded text-xs">
                                {{ decrypt($user->two_factor_secret) }}
                            </code>
                        </p>
                    </div>

                    {{-- Recovery codes --}}
                    <div class="mb-6">
                        <button type="button" class="btn btn-ghost btn-sm gap-1" @click="showCodes = !showCodes"
                            :aria-expanded="showCodes.toString()" aria-controls="recovery-codes">
                            <i class="icofont-key"></i>
                            <span
                                x-text="showCodes ? '{{ __('admin.profile.hide_recovery_codes') }}' : '{{ __('admin.profile.show_recovery_codes') }}'"></span>
                            <i class="icofont-caret-down transition-transform"
                                :class="{ 'rotate-180': showCodes }"></i>
                        </button>

                        <div id="recovery-codes" x-show="showCodes" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0" class="mt-3">
                            <x-admin.ui.alert type="warning" class="mb-3">
                                {{ __('admin.profile.recovery_warning') }}
                            </x-admin.ui.alert>
                            <div class="grid grid-cols-2 gap-1 font-mono text-sm bg-base-200 rounded-box p-4 max-w-sm">
                                @foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
                                    <span class="tracking-widest">{{ $code }}</span>
                                @endforeach
                            </div>

                            {{-- Regenerar códigos --}}
                            <form method="POST" action="{{ route('two-factor.recovery-codes') }}" class="mt-3">
                                @csrf
                                <x-admin.ui.button type="submit" variant="warning" size="sm"
                                    icon="icofont-refresh">
                                    {{ __('admin.profile.regenerate_codes') }}
                                </x-admin.ui.button>
                            </form>
                        </div>
                    </div>

                    {{-- Desactivar 2FA --}}
                    <form method="POST" action="{{ route('two-factor.disable') }}" x-data
                        @submit.prevent="
                              if (confirm('{{ __('admin.profile.disable_2fa_confirm') }}')) $el.submit()
                          ">
                        @csrf
                        @method('DELETE')
                        <x-admin.ui.button type="submit" variant="error" outline icon="icofont-close-circled">
                            {{ __('admin.profile.disable_2fa') }}
                        </x-admin.ui.button>
                    </form>
                </div>
            @else
                {{-- ---- 2FA DESHABILITADO -------------------------------- --}}
                <div class="badge badge-error gap-1 mb-6">
                    <i class="icofont-close-circled"></i> {{ __('admin.profile.two_factor_inactive') }}
                </div>

                <p class="text-sm opacity-70 mb-6 max-w-prose">
                    {{ __('admin.profile.two_factor_desc') }}
                </p>

                <form method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <x-admin.ui.button type="submit" icon="icofont-shield">
                        {{ __('admin.profile.enable_2fa') }}
                    </x-admin.ui.button>
                </form>
            @endif

        </div>

        {{-- ---- Tab: Sesiones ------------------------------------------- --}}
        <input type="radio" name="profile_tabs" class="tab" aria-label="{{ __('admin.profile.tab_sessions') }}" id="tab-sessions"
            {{ session('tab') === 'sessions' ? 'checked' : '' }} />

        <div class="tab-content bg-base-100 border-base-300 rounded-box p-6">

            <h2 class="text-lg font-semibold mb-1 flex items-center gap-2">
                <i class="icofont-laptop-alt text-primary"></i> {{ __('admin.profile.sessions') }}
            </h2>
            <p class="text-sm opacity-70 mb-6">
                {{ __('admin.profile.sessions_sub') }}
            </p>

            @if (session('status') === 'other-browser-sessions-terminated')
                <x-admin.ui.alert type="success" dismissible class="mb-4">
                    {{ __('admin.profile.sessions_closed') }}
                </x-admin.ui.alert>
            @endif

            {{-- Lista de sesiones --}}
            @php
                $sessions = collect(
                    config('session.driver') === 'database'
                        ? \Illuminate\Support\Facades\DB::table(config('session.table', 'sessions'))
                            ->where('user_id', auth()->id())
                            ->orderByDesc('last_activity')
                            ->get()
                        : [],
                );
            @endphp

            @if ($sessions->isNotEmpty())
                <ul class="space-y-3 mb-6">
                    @foreach ($sessions as $session)
                        @php
                            $agent = new \Jenssegers\Agent\Agent();
                            $agent->setUserAgent($session->user_agent ?? '');
                            $isCurrentSession = $session->id === request()->session()->getId();
                        @endphp
                        <li class="flex items-start gap-3 p-3 rounded-box border border-base-300 bg-base-200">
                            <i
                                class="{{ $agent->isDesktop() ? 'icofont-laptop-alt' : 'icofont-mobile-phone' }} text-2xl opacity-60 mt-0.5"></i>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-sm">
                                    {{ $agent->platform() }} — {{ $agent->browser() }}
                                    @if ($isCurrentSession)
                                        <span class="badge badge-success badge-xs ml-1">{{ __('admin.profile.session_current') }}</span>
                                    @endif
                                </p>
                                <p class="text-xs opacity-60">
                                    {{ __('admin.profile.session_last_activity') }}
                                    {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <x-admin.ui.alert type="info" class="mb-6">
                    {!! __('admin.profile.sessions_no_driver', ['driver' => config('session.driver')]) !!}
                </x-admin.ui.alert>
            @endif

            {{-- Logout otras sesiones --}}
            <form method="POST" action="{{ route('other-browser-sessions.destroy') }}" x-data
                @submit.prevent="
                      if (confirm('{{ __('admin.profile.close_sessions_confirm') }}')) $el.submit()
                  ">
                @csrf
                @method('DELETE')
                <x-admin.ui.input name="password" type="password" :label="__('admin.profile.confirm_password_label')"
                    icon="icofont-lock" required class="max-w-sm mb-4" />
                <x-admin.ui.button type="submit" variant="error" outline icon="icofont-logout">
                    {{ __('admin.profile.close_other_sessions') }}
                </x-admin.ui.button>
            </form>

        </div>

    </div>{{-- /tabs --}}

</x-layouts.admin>
