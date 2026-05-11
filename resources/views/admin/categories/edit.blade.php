<x-layouts.admin :title="__('admin.categories.edit')">

    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.categories.title'), 'href' => route('categories.index')],
        ['label' => $category->getTranslation('name', 'es', false)],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.categories.edit') }}</h1>
        <p class="text-sm opacity-70">
            <code
                class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $category->getTranslation('name', 'es', false) }}</code>
        </p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('categories.update', $category) }}" novalidate x-data="{
            form: $form('patch', '{{ route('categories.update', $category) }}', {
                name: {
                    es: @js($category->getTranslation('name', 'es', false)),
                    ca: @js($category->getTranslation('name', 'ca', false))
                }
            })
        }"
            @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('categories.index') }}' })">
            @csrf
            @method('PATCH')

            <x-admin.ui.translatable-input name="name" :label="__('admin.categories.col_name')" icon="icofont-sub-listing" :required="true"
                :value-es="old('name.es', $category->getTranslation('name', 'es', false))" :value-ca="old('name.ca', $category->getTranslation('name', 'ca', false))" form-var="form" />

            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $category->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $category->updated_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('categories.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.common.save_changes') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>
