<x-layouts.admin :title="__('admin.tags.edit') . ' · ' . $tag->getTranslation('name', 'es', false)">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.tags.title'), 'href' => route('tags.index')],
        ['label' => $tag->getTranslation('name', 'es', false)],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.tags.edit') }}</h1>
        <p class="text-sm opacity-70">
            <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $tag->getTranslation('slug', 'es', false) }}</code>
        </p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('tags.update', $tag) }}" novalidate>
            @csrf
            @method('PATCH')

            {{-- name[es] / name[ca] --}}
            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.tags.name') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-2 gap-3">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend>
                        <label class="input input-bordered w-full flex items-center gap-2 @error('name.es') input-error @enderror">
                            <i class="icofont-price opacity-60"></i>
                            <input type="text" name="name[es]" id="name_es"
                                value="{{ old('name.es', $tag->getTranslation('name', 'es', false)) }}"
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
                            <i class="icofont-price opacity-60"></i>
                            <input type="text" name="name[ca]" id="name_ca"
                                value="{{ old('name.ca', $tag->getTranslation('name', 'ca', false)) }}"
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

            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $tag->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $tag->updated_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('tags.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.common.save_changes') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>
