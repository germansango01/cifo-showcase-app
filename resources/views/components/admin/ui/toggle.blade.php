@php $hasError = $errors->has($name); @endphp

<div class="{{ $inline ? 'inline-flex items-center gap-2' : 'fieldset w-full' }}">
    <label class="flex items-center gap-3 cursor-pointer {{ $inline ? '' : 'py-1' }}">
        <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
            @checked(old($name, $checked)) @disabled($disabled)
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            aria-describedby="{{ $name }}-help"
            {{ $attributes->merge(['class' => 'toggle toggle-primary' . ($hasError ? ' toggle-error' : '')]) }} />
        @if ($label)
            <span class="label-text {{ $disabled ? 'opacity-50' : '' }}">{{ $label }}</span>
        @endif
    </label>
    @if ($help || $hasError)
        <p id="{{ $name }}-help" class="fieldset-label mt-1">
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
    @else
        <span id="{{ $name }}-help" class="sr-only">
            @error($name){{ $message }}@enderror
        </span>
    @endif
</div>
