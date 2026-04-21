@props(['name', 'label', 'options', 'selected', 'inline'])
@php
    $hasError = $errors->has($name);
    $currentValue = old($name, $selected);
@endphp

<fieldset class="fieldset w-full" aria-describedby="{{ $name }}-help">
    @if ($label)
        <legend class="fieldset-legend">{{ $label }}</legend>
    @endif

    <div class="{{ $inline ? 'flex flex-wrap gap-4' : 'flex flex-col gap-2' }}">
        @foreach ($options as $value => $text)
            @php $radioId = $name . '-' . Str::slug($value); @endphp
            <label class="flex items-center gap-3 cursor-pointer" for="{{ $radioId }}">
                <input type="radio" name="{{ $name }}" id="{{ $radioId }}" value="{{ $value }}"
                    @checked((string) $currentValue === (string) $value) aria-invalid="{{ $hasError ? 'true' : 'false' }}"
                    class="radio radio-primary {{ $hasError ? 'radio-error' : '' }}" />
                <span class="label-text">{{ $text }}</span>
            </label>
        @endforeach
    </div>

    <p id="{{ $name }}-help" class="fieldset-label mt-1">
        @error($name)
            <span class="text-error flex items-center gap-1">
                <i class="icofont-warning-alt"></i> {{ $message }}
            </span>
        @else
        @enderror
    </p>
</fieldset>
