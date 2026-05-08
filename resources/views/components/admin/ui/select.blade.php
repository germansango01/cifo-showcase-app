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
    <label class="flex items-center gap-2 w-full @error($name) [&>select]:select-error @enderror"
        :class="{ '[&>select]:select-error': $data.form?.invalid('{{ $name }}') }">
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
