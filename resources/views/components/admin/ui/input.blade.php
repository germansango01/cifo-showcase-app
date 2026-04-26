@php $hasError = $errors->has($name); @endphp

<fieldset class="fieldset w-full">
    @if ($label)
        <legend class="fieldset-legend">
            {{ $label }} @if ($required)
                <span class="text-error">*</span>
            @endif
        </legend>
    @endif
    <label class="input input-bordered w-full flex items-center gap-2 @error($name) input-error @enderror"
        :class="{ 'input-error': $data.form?.invalid('{{ $name }}') }">
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
            <span x-cloak
                  x-show="$data.form?.invalid('{{ $name }}')"
                  x-text="$data.form?.errors?.{{ $name }} ?? ''"
                  class="text-error flex items-center gap-1"></span>
            @if ($help)
                <span x-show="!($data.form?.invalid('{{ $name }}') ?? false)">{{ $help }}</span>
            @endif
        @enderror
    </p>
</fieldset>
