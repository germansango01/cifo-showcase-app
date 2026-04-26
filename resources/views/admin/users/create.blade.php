<x-layouts.admin :title="__('admin.users.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.users.title'), 'href' => route('users.index')],
        ['label' => __('admin.users.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.users.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.users.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-2xl">
        <form method="POST" action="{{ route('users.store') }}" novalidate x-data="{
            form: $form('post', '{{ route('users.store') }}', {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                roles: []
            })
        }" @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('users.index') }}' })">
            @csrf

            {{-- Datos personales --}}
            <div class="grid grid-cols-1 gap-4">
                <x-admin.ui.input name="name" :label="__('admin.users.full_name')" icon="icofont-ui-user" placeholder="Nombre Apellido"
                    :required="true" x-model="form.name" @change="form.validate('name')" />

                <x-admin.ui.input name="email" :label="__('admin.common.email')" type="email" icon="icofont-email"
                    placeholder="usuario@ejemplo.com" :required="true" x-model="form.email"
                    @change="form.validate('email')" />
            </div>

            {{-- Contraseña --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <x-admin.ui.input name="password" :label="__('admin.common.password')" type="password" icon="icofont-lock"
                    placeholder="Mínimo 8 caracteres" :required="true" x-model="form.password"
                    @change="form.validate('password')" />

                <x-admin.ui.input name="password_confirmation" :label="__('admin.common.password_confirm')" type="password" icon="icofont-lock"
                    placeholder="Repite la contraseña" :required="true" x-model="form.password_confirmation"
                    @change="form.validate('password_confirmation')" />
            </div>

            {{-- Roles --}}
            @can('users.assign-roles')
                <div class="mt-6">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">{{ __('admin.users.assigned_roles') }}</legend>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-2">
                            @foreach ($roles as $role)
                                <label class="flex items-center gap-2 cursor-pointer select-none group">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                        class="checkbox checkbox-primary checkbox-sm" x-model="form.roles"
                                        @change="form.validate('roles')" />
                                    <span class="text-sm group-hover:text-primary transition-colors">
                                        {{ $role->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('roles')
                            <p class="fieldset-label text-error mt-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                    </fieldset>
                </div>
            @endcan

            {{-- Acciones --}}
            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('users.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.users.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>
</x-layouts.admin>
