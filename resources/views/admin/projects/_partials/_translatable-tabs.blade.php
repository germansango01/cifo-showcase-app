{{--
    Translatable fields — two-column layout (ES | CA).
    Variables expected in scope:
      $model      — Eloquent model with HasTranslations, or null (create)
      $titleEs    — old('title.es', ...) string
      $titleCa    — old('title.ca', ...) string
      $descEs     — old('description.es', ...) HTML string
      $descCa     — old('description.ca', ...) HTML string
--}}

@php
    $titleEs ??= old('title.es', $model?->getTranslation('title', 'es', false) ?? '');
    $titleCa ??= old('title.ca', $model?->getTranslation('title', 'ca', false) ?? '');
    $descEs  ??= old('description.es', $model?->getTranslation('description', 'es', false) ?? '');
    $descCa  ??= old('description.ca', $model?->getTranslation('description', 'ca', false) ?? '');

    $hasEsError = $errors->hasAny(['title.es', 'description.es']);
    $hasCaError = $errors->hasAny(['title.ca', 'description.ca']);
@endphp

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    {{-- ES column --}}
    <div class="border border-base-300 rounded-btn p-4 bg-base-100 space-y-4">
        <div class="flex items-center gap-2 pb-2 border-b border-base-200">
            <span class="font-semibold text-sm uppercase tracking-wide">ES</span>
            @if ($hasEsError)
                <span class="badge badge-xs badge-error">!</span>
            @endif
        </div>

        <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">
                {{ __('admin.projects.title_field') }} <span class="text-error">*</span>
            </legend>
            <label class="input input-bordered w-full flex items-center gap-2 @error('title.es') input-error @enderror">
                <i class="icofont-heading opacity-60"></i>
                <input type="text" name="title[es]" id="title_es"
                    value="{{ $titleEs }}" required class="grow" />
            </label>
            @error('title.es')
                <p class="fieldset-label text-error flex items-center gap-1">
                    <i class="icofont-warning-alt"></i> {{ $message }}
                </p>
            @enderror
        </fieldset>

        <x-admin.ui.rich-editor
            name="description[es]"
            id="description_es"
            :value="$descEs"
            :label="__('admin.projects.description')"
            :rows="8" />
    </div>

    {{-- CA column --}}
    <div class="border border-base-300 rounded-btn p-4 bg-base-100 space-y-4">
        <div class="flex items-center gap-2 pb-2 border-b border-base-200">
            <span class="font-semibold text-sm uppercase tracking-wide">CA</span>
            @if ($hasCaError)
                <span class="badge badge-xs badge-error">!</span>
            @endif
        </div>

        <fieldset class="fieldset w-full">
            <legend class="fieldset-legend">
                {{ __('admin.projects.title_field') }} <span class="text-error">*</span>
            </legend>
            <label class="input input-bordered w-full flex items-center gap-2 @error('title.ca') input-error @enderror">
                <i class="icofont-heading opacity-60"></i>
                <input type="text" name="title[ca]" id="title_ca"
                    value="{{ $titleCa }}" required class="grow" />
            </label>
            @error('title.ca')
                <p class="fieldset-label text-error flex items-center gap-1">
                    <i class="icofont-warning-alt"></i> {{ $message }}
                </p>
            @enderror
        </fieldset>

        <x-admin.ui.rich-editor
            name="description[ca]"
            id="description_ca"
            :value="$descCa"
            :label="__('admin.projects.description')"
            :rows="8" />
    </div>

</div>
