@props(['editHref', 'showHref', 'deleteAction', 'deleteId'])

<div {{ $attributes->merge(['class' => 'flex items-center gap-1 justify-end']) }}>

    {{-- Show --}}
    @if ($showHref)
        <div class="tooltip tooltip-left" data-tip="{{ __('admin.common.view') }}">
            <a href="{{ $showHref }}" class="btn btn-ghost btn-xs btn-square" aria-label="{{ __('admin.common.view') }}">
                <i class="icofont-eye text-base text-info"></i>
            </a>
        </div>
    @endif

    {{-- Edit --}}
    @if ($editHref)
        <div class="tooltip tooltip-left" data-tip="{{ __('admin.common.edit') }}">
            <a href="{{ $editHref }}" class="btn btn-ghost btn-xs btn-square" aria-label="{{ __('admin.common.edit') }}">
                <i class="icofont-edit text-base text-warning"></i>
            </a>
        </div>
    @endif

    {{-- Delete --}}
    @if ($deleteAction)
        @php $mid = $modalId(); @endphp

        <div class="tooltip tooltip-left" data-tip="{{ __('admin.common.delete') }}">
            <button type="button" class="btn btn-ghost btn-xs btn-square" aria-label="{{ __('admin.common.delete') }}"
                onclick="{{ $mid }}.showModal()">
                <i class="icofont-ui-delete text-base text-error"></i>
            </button>
        </div>

        {{-- Confirmation dialog (DaisyUI native <dialog>) --}}
        <dialog id="{{ $mid }}" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg flex items-center gap-2">
                    <i class="icofont-warning-alt text-warning text-2xl"></i>
                    {{ __('admin.common.confirm_delete') }}
                </h3>
                <p class="py-4 text-base-content/70">
                    {!! __('admin.common.confirm_delete_msg') !!}
                </p>

                <div class="modal-action gap-2">
                    {{-- Cancel --}}
                    <form method="dialog">
                        <button class="btn btn-ghost">{{ __('admin.common.cancel') }}</button>
                    </form>

                    {{-- Confirm DELETE --}}
                    <form method="POST" action="{{ $deleteAction }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error gap-2">
                            <i class="icofont-ui-delete"></i>
                            {{ __('admin.common.delete') }}
                        </button>
                    </form>
                </div>
            </div>

            {{-- Backdrop closes dialog --}}
            <form method="dialog" class="modal-backdrop">
                <button>{{ __('admin.common.close') }}</button>
            </form>
        </dialog>
    @endif

</div>
