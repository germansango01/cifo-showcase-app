<x-layouts.admin :title="__('admin.categories.edit')">

<x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.categories.title'), 'href' => route('categories.index')],
        ['label' => __('admin.categories.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.categories.edit') }}</h1>
        {{-- <p class="text-sm opacity-70">{{ __('admin.categories.edit_sub') }}</p> --}}
<p class="text-sm opacity-70">
    <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $category->getTranslation('name', 'es', false) }}</code>
</p>
        
    </div>

    <x-admin.ui.card class="max-w-lg">

        <form method="POST" action="{{ route('categories.update', $category) }}" novalidate>
            @csrf @method('PATCH')

            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.categories.icon') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-1 gap-3">
                    {{-- <fieldset class="fieldset w-full"> --}}

            <x-admin.ui.input
                name="icon"
                label="Icon"
                icon="icofont-ui-image"
                :value="$category->icon"
                required />


                {{-- @error('icon')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                    </fieldset> --}}
                </div>
            </div>

            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.categories.name_es') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-2 gap-3">
                    <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend>
                    <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">CA</span></legend>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    {{-- <fieldset class="fieldset w-full"> --}}

            <x-admin.ui.input
                name="name[es]"
                {{-- label="Name (ES)" --}}
                icon="icofont-ui-image"
                :value="old('name.es', $category->getTranslation('name','es'))"
                required />

            <x-admin.ui.input
                name="name[ca]"
                {{-- label="Name (CA)" --}}
                icon="icofont-ui-image"
                :value="old('name.ca', $category->getTranslation('name','ca'))"
                required />

             </div>
            </div>

             <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $category->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $category->updated_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <x-admin.ui.button variant="ghost" :href="route('categories.index')">
                    Cancel
                </x-admin.ui.button>

                <x-admin.ui.button type="submit">
                    Save
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>