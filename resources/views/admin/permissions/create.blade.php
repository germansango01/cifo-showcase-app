<x-layouts.admin :title="__('admin.permissions.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.permissions.title'), 'href' => route('permissions.index')],
        ['label' => __('admin.permissions.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.permissions.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.permissions.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('permissions.store') }}" novalidate x-data="{
            form: $form('post', '{{ route('permissions.store') }}', { name: '' })
        }"
            @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('permissions.index') }}' })">
            @csrf

            <x-admin.ui.input name="name" :label="__('admin.permissions.name')" icon="icofont-key" :placeholder="__('admin.permissions.name_placeholder')" :required="true"
                :help="__('admin.permissions.name_help')" x-model="form.name" @change="form.validate('name')" />

            <div class="flex justify-end gap-2 mt-6">
                <x-admin.ui.button :ghost="true" :href="route('permissions.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.permissions.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>
</x-layouts.admin>
