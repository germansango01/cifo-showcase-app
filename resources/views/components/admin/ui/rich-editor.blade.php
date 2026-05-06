@props([
    'name',
    'value'  => '',
    'id'     => null,
    'error'  => null,
    'rows'   => 6,
    'label'  => null,
])

@php
    $inputId  = $id ?? 'rich_' . str_replace(['[', ']'], ['_', ''], $name);
    $hasError = $error || $errors->has(str_replace(['[', ']', '.'], ['.', '', '.'], $name));
@endphp

<div class="space-y-1 mb-4">
    @if ($label)
        <p class="fieldset-legend">{{ $label }}</p>
    @endif

    <div
        x-data="richEditor(@js($value), '{{ $inputId }}')"
        class="border rounded-btn {{ $hasError ? 'border-error' : 'border-base-300' }} bg-base-100 focus-within:outline focus-within:outline-2 focus-within:outline-primary"
    >
        {{-- toolbar --}}
        <div class="flex flex-wrap gap-0.5 px-2 py-1.5 border-b border-base-300 bg-base-200 rounded-t-btn">
            <button type="button" title="Negrita"
                @click="exec('bold')"
                :class="isActive('bold') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs font-bold">B</button>

            <button type="button" title="Cursiva"
                @click="exec('italic')"
                :class="isActive('italic') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs italic">I</button>

            <button type="button" title="Subrayado"
                @click="exec('underline')"
                :class="isActive('underline') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs underline">U</button>

            <div class="w-px bg-base-300 mx-1 self-stretch"></div>

            <button type="button" title="Encabezado H2"
                @click="formatBlock('h2')"
                :class="isBlock('h2') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs font-bold">H2</button>

            <button type="button" title="Encabezado H3"
                @click="formatBlock('h3')"
                :class="isBlock('h3') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs font-bold">H3</button>

            <button type="button" title="Cita"
                @click="formatBlock('blockquote')"
                :class="isBlock('blockquote') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs font-serif text-base leading-none">&ldquo;</button>

            <button type="button" title="Bloque de código"
                @click="formatBlock('pre')"
                :class="isBlock('pre') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs font-mono text-xs">&lt;/&gt;</button>

            <div class="w-px bg-base-300 mx-1 self-stretch"></div>

            <button type="button" title="Lista sin orden"
                @click="exec('insertUnorderedList')"
                :class="isActive('insertUnorderedList') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs">
                <i class="icofont-listing-number" aria-hidden="true"></i>
            </button>

            <button type="button" title="Lista ordenada"
                @click="exec('insertOrderedList')"
                :class="isActive('insertOrderedList') ? 'btn-active' : ''"
                class="btn btn-ghost btn-xs">
                <i class="icofont-listing-box" aria-hidden="true"></i>
            </button>

            <div class="w-px bg-base-300 mx-1 self-stretch"></div>

            <button type="button" title="Insertar enlace"
                @click="insertLink()"
                class="btn btn-ghost btn-xs">
                <i class="icofont-link" aria-hidden="true"></i>
            </button>

            <button type="button" title="Limpiar formato"
                @click="clearFormat()"
                class="btn btn-ghost btn-xs text-error">
                <i class="icofont-eraser" aria-hidden="true"></i>
            </button>
        </div>

        {{-- editable area --}}
        <div
            x-ref="editable"
            contenteditable="true"
            @input="onInput()"
            @focus="focused = true"
            @blur="focused = false"
            style="min-height: {{ $rows * 1.6 }}rem;"
            class="px-3 py-2 prose prose-sm max-w-none outline-none"
        ></div>
    </div>

    {{-- hidden input sent with the form --}}
    <input type="hidden" name="{{ $name }}" id="{{ $inputId }}" value="{{ $value }}" />

    @if ($hasError)
        @error(str_replace(['[', ']'], ['.', ''], $name))
            <p class="fieldset-label text-error flex items-center gap-1">
                <i class="icofont-warning-alt"></i> {{ $message }}
            </p>
        @enderror
    @endif
</div>
