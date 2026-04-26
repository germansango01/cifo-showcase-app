<x-layouts.admin :title="__('admin.tags.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.tags.title'), 'href' => route('tags.index')],
        ['label' => __('admin.tags.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.tags.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.tags.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('tags.store') }}" novalidate x-data="{
            form: $form('post', '{{ route('tags.store') }}', { name: '' })
        }" @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('tags.index') }}' })">
            @csrf

            <x-admin.ui.input
                name="name"
                :label="__('admin.tags.name')"
                icon="icofont-price"
                :placeholder="__('admin.tags.name_placeholder')"
                :required="true"
                x-model="form.name"
                @change="form.validate('name')" />

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('tags.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.tags.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>
