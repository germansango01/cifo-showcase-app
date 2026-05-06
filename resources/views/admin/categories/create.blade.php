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

        <form method="POST" action="{{ route('categories.store') }}" novalidate>
            @csrf

            {{-- name[es] / name[ca] --}}
            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.categories.col_name') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-2 gap-3">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend>
                        <label class="input input-bordered w-full flex items-center gap-2 @error('name.es') input-error @enderror">
                            <i class="icofont-sub-listing opacity-60"></i>
                            <input type="text" name="name[es]" id="name_es"
                                value="{{ old('name.es') }}"
                                placeholder="{{ __('admin.categories.name_placeholder') }}"
                                required class="grow" />
                        </label>
                        @error('name.es')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                    </fieldset>

                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">CA</span></legend>
                        <label class="input input-bordered w-full flex items-center gap-2 @error('name.ca') input-error @enderror">
                            <i class="icofont-sub-listing opacity-60"></i>
                            <input type="text" name="name[ca]" id="name_ca"
                                value="{{ old('name.ca') }}"
                                placeholder="{{ __('admin.categories.name_placeholder') }}"
                                required class="grow" />
                        </label>
                        @error('name.ca')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('categories.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.categories.create_btn') }}
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>