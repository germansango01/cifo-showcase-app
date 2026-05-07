<x-layouts.admin :title="__('admin.categories.create')">

    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.categories.title'), 'href' => route('categories.index')],
        ['label' => __('admin.categories.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.categories.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.categories.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('categories.store') }}" novalidate
            x-data="{
                form: $form('post', '{{ route('categories.store') }}', {
                    name: { es: '', ca: '' }
                })
            }"
            @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('categories.index') }}' })">
            @csrf

            <x-admin.ui.translatable-input name="name" :label="__('admin.categories.col_name')"
                icon="icofont-sub-listing" :placeholder="__('admin.categories.name_placeholder')"
                :required="true" form-var="form" />

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('categories.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.categories.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>
