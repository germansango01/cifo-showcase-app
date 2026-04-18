@props(['name', 'label', 'options', 'selected', 'placeholder', 'required', 'disabled', 'icon', 'help'])
@php
    $hasError = $errors->has($name);
    $currentValue = old($name, $selected);
@endphp

<fieldset class="fieldset w-full">
    @if ($label)
        <legend class="fieldset-legend">
            {{ $label }} @if ($required)
                <span class="text-error">*</span>
            @endif
        </legend>
    @endif
    <label class="flex items-center gap-2 w-full @error($name) [&>select]:select-error @enderror">
        @if ($icon)
            <i class="{{ $icon }} opacity-60 shrink-0"></i>
        @endif
        <select name="{{ $name }}" id="{{ $name }}" @required($required) @disabled($disabled)
            aria-invalid="{{ $hasError ? 'true' : 'false' }}" aria-describedby="{{ $name }}-help"
            {{ $attributes->merge(['class' => 'select select-bordered w-full']) }}>
            @if ($placeholder)
                <option value="" @selected(!$currentValue)>{{ $placeholder }}</option>
            @endif
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" @selected((string) $currentValue === (string) $value)>
                    {{ $text }}
                </option>
            @endforeach
        </select>
    </label>
    <p id="{{ $name }}-help" class="fieldset-label">
        @error($name)
            <span class="text-error flex items-center gap-1">
                <i class="icofont-warning-alt"></i> {{ $message }}
            </span>
        @else
            @if ($help)
                {{ $help }}
            @endif
        @enderror
    </p>
</fieldset>
