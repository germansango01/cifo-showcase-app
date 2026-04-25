@php $hasError = $errors->has($name); @endphp

<fieldset class="fieldset w-full">
    @if ($label)
        <legend class="fieldset-legend">
            {{ $label }} @if ($required)
                <span class="text-error">*</span>
            @endif
        </legend>
    @endif
    <label class="input input-bordered w-full flex items-center gap-2 @error($name) input-error @enderror">
        @if ($icon)
            <i class="{{ $icon }} opacity-60"></i>
        @endif
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" @required($required)
            @disabled($disabled) aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            aria-describedby="{{ $name }}-help" {{ $attributes->merge(['class' => 'grow']) }} />
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
