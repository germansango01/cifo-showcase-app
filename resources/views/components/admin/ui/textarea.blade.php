@php $hasError = $errors->has($name); @endphp

<fieldset class="fieldset w-full">
    @if ($label)
        <legend class="fieldset-legend">
            {{ $label }} @if ($required)
                <span class="text-error">*</span>
            @endif
        </legend>
    @endif
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        @required($required) @disabled($disabled) aria-invalid="{{ $hasError ? 'true' : 'false' }}"
        aria-describedby="{{ $name }}-help"
        {{ $attributes->merge(['class' => 'textarea textarea-bordered w-full' . ($hasError ? ' textarea-error' : '')]) }}>{{ old($name, $value) }}</textarea>
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
