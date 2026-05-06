<x-layouts.admin :title="__('admin.teachers.create')">
<x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.teachers.title'), 'href' => route('teachers.index')],
        ['label' => __('admin.teachers.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.teachers.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.teachers.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-lg">

        <form method="POST" action="{{ route('teachers.store') }}" novalidate>
            @csrf

            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.teachers.col_name') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-1 gap-3">
                    <fieldset class="fieldset w-full">
                        <label class="input input-bordered w-full flex items-center gap-2 @error('name') input-error @enderror">
                            <i class="icofont-user opacity-60"></i>

                        <input type="text" name="name" id="name"
                                value="{{ old('name') }}"
                                placeholder="{{ __('admin.teachers.name_placeholder') }}"
                                required class="grow" />
                        </label>
                        @error('name')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                </div>
                <p class="fieldset-legend">{{ __('admin.teachers.col_email') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-1 gap-3">
                        <label class="input input-bordered w-full flex items-center gap-2 @error('email') input-error @enderror">
                            <i class="icofont-mail opacity-60"></i>

                        <input type="text" name="email" id="email"
                                value="{{ old('email') }}"
                                placeholder="{{ __('admin.teachers.email_placeholder') }}"
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
           
             <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('teachers.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.teachers.create_btn') }}
                </x-admin.ui.button>
            </div>

        </form>

    </x-admin.ui.card>

</x-layouts.admin>