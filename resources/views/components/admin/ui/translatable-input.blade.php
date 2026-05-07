@php
    $hasErrorEs = $errors->has($name . '.es');
    $hasErrorCa = $errors->has($name . '.ca');
@endphp

<fieldset class="fieldset w-full">
    @if ($label)
        <legend class="fieldset-legend">
            {{ $label }} @if ($required)<span class="text-error">*</span>@endif
        </legend>
    @endif

    <div class="grid grid-cols-2 gap-3">
        {{-- ES --}}
        <div>
            <label class="input input-bordered w-full flex items-center gap-2 @error($name . '.es') input-error @enderror"
                :class="{ 'input-error': $data.form?.invalid('{{ $name }}.es') }">
                @if ($icon)
                    <i class="{{ $icon }} opacity-60"></i>
                @endif
                <span class="badge badge-xs badge-neutral shrink-0">ES</span>
                <input type="{{ $type }}" name="{{ $name }}[es]" id="{{ $name }}_es"
                    value="{{ old($name . '.es', $valueEs) }}"
                    @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                    @required($required) @disabled($disabled)
                    aria-invalid="{{ $hasErrorEs ? 'true' : 'false' }}"
                    aria-describedby="{{ $name }}-es-help"
                    @if ($formVar)
                        x-model="{{ $formVar }}.{{ $name }}.es"
                        @change="{{ $formVar }}.validate('{{ $name }}.es')"
                    @else
                        @change="$data.form?.validate?.('{{ $name }}.es')"
                    @endif
                    class="grow" />
            </label>
            <p id="{{ $name }}-es-help" class="fieldset-label">
                @error($name . '.es')
                    <span class="text-error flex items-center gap-1">
                        <i class="icofont-warning-alt"></i> {{ $message }}
                    </span>
                @else
                    <span x-cloak
                          x-show="$data.form?.invalid('{{ $name }}.es')"
                          x-text="$data.form?.errors?.{{ $name }}?.es ?? ''"
                          class="text-error flex items-center gap-1"></span>
                @enderror
            </p>
        </div>

        {{-- CA --}}
        <div>
            <label class="input input-bordered w-full flex items-center gap-2 @error($name . '.ca') input-error @enderror"
                :class="{ 'input-error': $data.form?.invalid('{{ $name }}.ca') }">
                @if ($icon)
                    <i class="{{ $icon }} opacity-60"></i>
                @endif
                <span class="badge badge-xs badge-neutral shrink-0">CA</span>
                <input type="{{ $type }}" name="{{ $name }}[ca]" id="{{ $name }}_ca"
                    value="{{ old($name . '.ca', $valueCa) }}"
                    @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                    @required($required) @disabled($disabled)
                    aria-invalid="{{ $hasErrorCa ? 'true' : 'false' }}"
                    aria-describedby="{{ $name }}-ca-help"
                    @if ($formVar)
                        x-model="{{ $formVar }}.{{ $name }}.ca"
                        @change="{{ $formVar }}.validate('{{ $name }}.ca')"
                    @else
                        @change="$data.form?.validate?.('{{ $name }}.ca')"
                    @endif
                    class="grow" />
            </label>
            <p id="{{ $name }}-ca-help" class="fieldset-label">
                @error($name . '.ca')
                    <span class="text-error flex items-center gap-1">
                        <i class="icofont-warning-alt"></i> {{ $message }}
                    </span>
                @else
                    <span x-cloak
                          x-show="$data.form?.invalid('{{ $name }}.ca')"
                          x-text="$data.form?.errors?.{{ $name }}?.ca ?? ''"
                          class="text-error flex items-center gap-1"></span>
                    @if ($help)
                        <span x-show="!($data.form?.invalid('{{ $name }}.ca') ?? false)">{{ $help }}</span>
                    @endif
                @enderror
            </p>
        </div>
    </div>
</fieldset>
