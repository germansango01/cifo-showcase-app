@props(['editHref', 'showHref', 'deleteAction', 'deleteId'])

<div {{ $attributes->merge(['class' => 'flex items-center gap-1 justify-end']) }}>

    {{-- Show --}}
    @if ($showHref)
        <div class="tooltip tooltip-left" data-tip="Ver detalle">
            <a href="{{ $showHref }}" class="btn btn-ghost btn-xs btn-square" aria-label="Ver detalle">
                <i class="icofont-eye text-base text-info"></i>
            </a>
        </div>
    @endif

    {{-- Edit --}}
    @if ($editHref)
        <div class="tooltip tooltip-left" data-tip="Editar">
            <a href="{{ $editHref }}" class="btn btn-ghost btn-xs btn-square" aria-label="Editar">
                <i class="icofont-edit text-base text-warning"></i>
            </a>
        </div>
    @endif

    {{-- Delete --}}
    @if ($deleteAction)
        @php $mid = $modalId(); @endphp

        <div class="tooltip tooltip-left" data-tip="Eliminar">
            <button type="button" class="btn btn-ghost btn-xs btn-square" aria-label="Eliminar"
                onclick="{{ $mid }}.showModal()">
                <i class="icofont-ui-delete text-base text-error"></i>
            </button>
        </div>

        {{-- Confirmation dialog (DaisyUI native <dialog>) --}}
        <dialog id="{{ $mid }}" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg flex items-center gap-2">
                    <i class="icofont-warning-alt text-warning text-2xl"></i>
                    Confirmar eliminación
                </h3>
                <p class="py-4 text-base-content/70">
                    Esta acción <strong>no se puede deshacer</strong>.
                    ¿Estás seguro de que quieres eliminar este registro?
                </p>

                <div class="modal-action gap-2">
                    {{-- Cancel --}}
                    <form method="dialog">
                        <button class="btn btn-ghost">Cancelar</button>
                    </form>

                    {{-- Confirm DELETE --}}
                    <form method="POST" action="{{ $deleteAction }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error gap-2">
                            <i class="icofont-ui-delete"></i>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>

            {{-- Backdrop closes dialog --}}
            <form method="dialog" class="modal-backdrop">
                <button>Cerrar</button>
            </form>
        </dialog>
    @endif

</div>
