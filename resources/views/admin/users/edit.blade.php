<x-layouts.admin :title="__('admin.users.edit') . ' · ' . $user->name">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.users.title'), 'href' => route('users.index')],
        ['label' => $user->name, 'href' => route('users.show', $user)],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.users.edit') }}</h1>
        <p class="text-sm opacity-70">{{ $user->email }}</p>
    </div>

    <x-admin.ui.card class="max-w-2xl">
        <form method="POST" action="{{ route('users.update', $user) }}" x-data="{
            form: $form('patch', '{{ route('users.update', $user) }}', {
                name: '{{ addslashes($user->name) }}',
                email: '{{ $user->email }}',
                password: '',
                password_confirmation: '',
                roles: {{ Js::from($user->roles->pluck('name')) }}
            })
        }"
            @submit.prevent="form.submit().then(r => window.location = r.request.responseURL)">
            @csrf
            @method('PATCH')

            {{-- Datos personales --}}
            <div class="grid grid-cols-1 gap-4">
                <x-admin.ui.input name="name" :label="__('admin.users.full_name')" icon="icofont-ui-user" :value="$user->name"
                    :required="true" x-model="form.name" @change="form.validate('name')" />

                <x-admin.ui.input name="email" :label="__('admin.common.email')" type="email" icon="icofont-email" :value="$user->email"
                    :required="true" x-model="form.email" @change="form.validate('email')" />
            </div>

            {{-- Contraseña (opcional) --}}
            <div class="divider my-5 text-xs opacity-60">{{ __('admin.users.password_change_optional') }}</div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-admin.ui.input name="password" :label="__('admin.users.new_password')" type="password" icon="icofont-lock"
                    placeholder="Dejar vacío para no cambiar"
                    help="Mínimo 8 caracteres. Déjalo vacío para mantener la actual." x-model="form.password"
                    @change="form.validate('password')" />

                <x-admin.ui.input name="password_confirmation" :label="__('admin.users.confirm_new_password')" type="password" icon="icofont-lock"
                    placeholder="Repite la nueva contraseña" x-model="form.password_confirmation"
                    @change="form.validate('password_confirmation')" />
            </div>

            {{-- Roles --}}
            @can('users.assign-roles')
                <div class="mt-6">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">{{ __('admin.users.assigned_roles') }}</legend>
                        @if (auth()->user()->hasRole('Super Admin') && $user->hasRole('Super Admin') && auth()->id() === $user->id)
                            <x-admin.ui.alert type="warning" class="mt-2 mb-3">
                                {!! __('admin.users.super_admin_protected') !!}
                            </x-admin.ui.alert>
                        @endif
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-2">
                            @foreach ($roles as $role)
                                @php
                                    $isProtected =
                                        $role->name === 'Super Admin' &&
                                        auth()->id() === $user->id &&
                                        auth()->user()->hasRole('Super Admin');
                                @endphp
                                <label
                                    class="flex items-center gap-2 cursor-pointer select-none group {{ $isProtected ? 'opacity-60 pointer-events-none' : '' }}">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                        class="checkbox checkbox-primary checkbox-sm" x-model="form.roles"
                                        @change="form.validate('roles')" @disabled($isProtected) />
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

            {{-- Meta info --}}
            <div class="mt-6 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $user->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $user->updated_at->format('d/m/Y H:i') }}</span>
                @if ($user->email_verified_at)
                    <span><i class="icofont-check-circled text-success"></i>
                        {{ __('admin.common.email_verified_at') }}:
                        {{ $user->email_verified_at->format('d/m/Y') }}</span>
                @else
                    <span><i class="icofont-warning-alt text-warning"></i>
                        {{ __('admin.common.email_not_verified') }}</span>
                @endif
            </div>

            {{-- Acciones --}}
            <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('users.show', $user)">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.common.save_changes') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>
</x-layouts.admin>
