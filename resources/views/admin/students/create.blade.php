<x-layouts.admin :title="__('admin.students.create')">
        <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.students.title'), 'href' => route('students.index')],
        ['label' => __('admin.students.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.students.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.students.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-lg">

        <form method="POST" action="{{ route('students.store') }}" novalidate>
            @csrf

            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.students.col_name') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-1 gap-3">
                    <fieldset class="fieldset w-full">
                        {{-- <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend> --}}
                        <label class="input input-bordered w-full flex items-center gap-2 @error('name') input-error @enderror">
                            <i class="icofont-ui-user opacity-60"></i>

            {{-- <x-admin.ui.input name="name" label="Name" required /> --}}
                        <input type="text" name="name" id="name"
                                value="{{ old('name') }}"
                                placeholder="{{ __('admin.students.name_placeholder') }}"
                                required class="grow" />
                        </label>
                        @error('name')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                </div>
                <p class="fieldset-legend">{{ __('admin.students.col_email') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-1 gap-3">
                        {{-- <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend> --}}
                        <label class="input input-bordered w-full flex items-center gap-2 @error('email') input-error @enderror">
                            <i class="icofont-email opacity-60"></i>

            {{-- <x-admin.ui.input name="email" label="Email" required /> --}}
                        <input type="text" name="email" id="email"
                                value="{{ old('email') }}"
                                placeholder="{{ __('admin.students.email_placeholder') }}"
                                required class="grow" />
                        </label>
                        @error('email')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                    </fieldset>
                </div>
            </div>
           

            {{-- <div class="flex justify-end gap-2 mt-4">
                <x-admin.ui.button variant="ghost" :href="route('students.index')">
                    Cancel
                </x-admin.ui.button>

                <x-admin.ui.button type="submit">
                    Create
                </x-admin.ui.button>
            </div> --}}

             <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('students.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.students.create_btn') }}
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>