@props([
    'id'         => 'confirm-delete',
    'resource'   => '',
    'titleKey'   => 'admin.common.confirm_delete',
    'nameVar'    => 'deleteName',
])

<div x-data="{ {{ $nameVar }}: '', deleteUrl: '' }">
    {{ $slot }}

    <dialog id="{{ $id }}" class="modal">
        <div class="modal-box max-w-sm">
            <h3 class="font-bold text-lg mb-2">{{ __($titleKey) }}</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" aria-label="{{ __('admin.common.close') }}">✕</button>
            </form>
            <p class="text-sm mb-1">
                {!! __('admin.common.confirm_delete_msg') !!}
            </p>
            <p class="text-sm font-semibold" x-text="{{ $nameVar }}"></p>
            <div class="modal-action">
                <form method="dialog">
                    <x-admin.ui.button variant="neutral" :ghost="true">
                        {{ __('admin.common.cancel') }}
                    </x-admin.ui.button>
                </form>
                <form method="POST" :action="deleteUrl">
                    @csrf
                    @method('DELETE')
                    <x-admin.ui.button variant="error" type="submit">
                        {{ __('admin.common.delete') }}
                    </x-admin.ui.button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>
</div>
