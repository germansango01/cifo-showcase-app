@php
    $rawSelected = old($name, $selected);
    $selectedValues = array_map('strval', is_array($rawSelected) ? $rawSelected : []);
    $hasError = $errors->has($name);
    $normalizedOptions = [];
    foreach ($options as $value => $text) {
        $normalizedOptions[] = ['value' => (string) $value, 'text' => (string) $text];
    }
    $resolvedPlaceholder = $placeholder ?? __('admin.common.select');
    $resolvedSearchPlaceholder = $searchPlaceholder ?? __('admin.common.search');
@endphp

<fieldset class="fieldset w-full" @disabled($disabled)>
    @if ($label)
        <legend class="fieldset-legend">
            {{ $label }}@if ($required)
                <span class="text-error">*</span>
            @endif
        </legend>
    @endif

    <div x-data="selectMultiple({
        options: @js($normalizedOptions),
        selected: @js($selectedValues),
        name: '{{ $name }}',
    })" x-cloak class="relative w-full" @click.outside="close()" @keydown.escape.window="close()">

        {{-- Hidden inputs reflecting current selection --}}
        <template x-for="value in selected" :key="value">
            <input type="hidden" name="{{ $name }}[]" :value="value">
        </template>

        {{-- Trigger / chips area --}}
        <div role="combobox" tabindex="0" :aria-expanded="open" aria-haspopup="listbox"
            aria-describedby="{{ $name }}-help" @click="toggle()" @keydown.enter.prevent="toggle()"
            @keydown.space.prevent="toggle()"
            class="input input-bordered w-full flex flex-wrap items-center gap-1.5 h-auto min-h-12 py-2 cursor-pointer"
            :class="{ 'input-error': {{ $hasError ? 'true' : 'false' }}, 'pointer-events-none opacity-60': {{ $disabled ? 'true' : 'false' }} }">

            @if ($icon)
                <i class="{{ $icon }} opacity-60 shrink-0"></i>
            @endif

            <template x-for="value in selected" :key="value">
                <span class="badge badge-primary gap-1 py-3">
                    <span x-text="labelFor(value)"></span>
                    <button type="button" @click.stop="remove(value)" class="opacity-80 hover:opacity-100"
                        :aria-label="`{{ __('admin.common.remove') }} ${labelFor(value)}`">
                        <i class="icofont-close-line"></i>
                    </button>
                </span>
            </template>

            <span x-show="!hasSelection" class="opacity-60 text-sm">
                {{ $resolvedPlaceholder }}
            </span>

            <span class="ml-auto flex items-center gap-1 shrink-0">
                <button type="button" x-show="hasSelection" @click.stop="clear()" class="opacity-60 hover:opacity-100"
                    aria-label="{{ __('admin.common.clear') }}">
                    <i class="icofont-close-circled"></i>
                </button>
                <i class="icofont-caret-down opacity-60 transition-transform" :class="{ 'rotate-180': open }"></i>
            </span>
        </div>

        {{-- Dropdown --}}
        <div x-show="open" x-transition.opacity.duration.150ms
            class="absolute z-50 mt-1 w-full rounded-box border border-base-300 bg-base-100 shadow-lg overflow-hidden">
            <div class="p-2 border-b border-base-300">
                <label class="input input-sm input-bordered flex items-center gap-2 w-full">
                    <i class="icofont-search-1 opacity-60"></i>
                    <input type="text" x-model="search" x-ref="search" @keydown.escape.stop="close()"
                        placeholder="{{ $resolvedSearchPlaceholder }}" class="grow">
                </label>
            </div>
            <ul role="listbox" class="max-h-56 overflow-y-auto py-1">
                <template x-for="option in filteredOptions" :key="option.value">
                    <li>
                        <button type="button" role="option" :aria-selected="isSelected(option.value)"
                            @click="toggleOption(option.value)"
                            class="w-full flex items-center gap-2 px-3 py-2 text-sm hover:bg-base-200 text-left transition-colors"
                            :class="{ 'bg-primary/10 text-primary': isSelected(option.value) }">
                            <i class="icofont-check shrink-0"
                                :class="isSelected(option.value) ? 'opacity-100' : 'opacity-0'"></i>
                            <span x-text="option.text" class="grow"></span>
                        </button>
                    </li>
                </template>
                <li x-show="filteredOptions.length === 0" class="px-3 py-3 text-sm opacity-60 text-center">
                    {{ __('admin.common.no_results') }}
                </li>
            </ul>
        </div>
    </div>

    <p id="{{ $name }}-help" class="fieldset-label">
        @error($name)
            <span class="text-error flex items-center gap-1">
                <i class="icofont-warning-alt"></i> {{ $message }}
            </span>
        @else
            @if ($help)
                <span>{{ $help }}</span>
            @endif
        @enderror
    </p>
</fieldset>
