<x-layouts.guest :title="__('admin.auth.verify_title')">
    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-primary/10 text-primary rounded-xl p-3">
            <i class="icofont-email text-2xl"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold leading-tight">{{ __('admin.auth.verify_title') }}</h1>
            <p class="text-sm opacity-60">{{ __('admin.auth.verify_sub') }}</p>
        </div>
    </div>

    {{-- Resend success --}}
    @if (session('status') === 'verification-link-sent')
    <x-admin.ui.alert type="success" dismissible class="mb-4">
        {{ __('admin.auth.verify_resent') }}
    </x-admin.ui.alert>
    @endif

    <div class="prose prose-sm max-w-none mb-6">
        <p class="text-base-content/70">
            {{ __('admin.auth.verify_body') }}
        </p>
    </div>

    {{-- Resend button --}}
    <form method="POST" action="/email/verification-notification" class="mb-3">
        @csrf
        <x-admin.ui.button type="submit" icon="icofont-email" block>
            {{ __('admin.auth.resend_btn') }}
        </x-admin.ui.button>
    </form>

    {{-- Logout --}}
    <form method="POST" action="/logout">
        @csrf
        <x-admin.ui.button type="submit" variant="neutral" ghost block>
            <i class="icofont-logout"></i>
            {{ __('admin.nav.logout') }}
        </x-admin.ui.button>
    </form>
</x-layouts.guest>
