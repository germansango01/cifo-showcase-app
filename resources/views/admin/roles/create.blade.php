<x-layouts.admin :title="__('admin.roles.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.roles.title'), 'href' => route('roles.index')],
        ['label' => __('admin.roles.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.roles.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.roles.create_sub') }}</p>
    </div>

    <x-admin.ui.card>
        <form method="POST" action="{{ route('roles.store') }}" x-data="{
            permissions: [],
            get selectedCount() { return this.permissions.length; },
            totalPermissions: {{ $permissions->flatten()->count() }},
            toggleModule(modulePerms) {
                const all = modulePerms.every(p => this.permissions.includes(p));
                if (all) {
                    this.permissions = this.permissions.filter(p => !modulePerms.includes(p));
                } else {
                    modulePerms.forEach(p => { if (!this.permissions.includes(p)) this.permissions.push(p); });
                }
            },
            isModuleChecked(modulePerms) {
                return modulePerms.every(p => this.permissions.includes(p));
            },
            isModuleIndeterminate(modulePerms) {
                const some = modulePerms.some(p => this.permissions.includes(p));
                return some && !this.isModuleChecked(modulePerms);
            }
        }">
            @csrf

            {{-- Nombre del rol --}}
            <div class="max-w-sm mb-8">
                <x-admin.ui.input name="name" :label="__('admin.roles.name')" icon="icofont-shield"
                    placeholder="Ej: Editor de contenidos" required />
            </div>

            {{-- Contador en vivo --}}
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">{{ __('admin.roles.permissions') }}</h2>
                <x-admin.ui.badge color="primary">
                    <span x-text="selectedCount"></span> {{ __('admin.roles.selected_count', ['selected' => '', 'total' => $permissions->flatten()->count()]) }}
                </x-admin.ui.badge>
            </div>

            {{-- Grid de permisos agrupados --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">
                @foreach ($permissions as $module => $modulePerms)
                    @php
                        $permNames = $modulePerms->pluck('name')->toArray();
                        $permNamesJs = json_encode($permNames);
                    @endphp
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-4">
                            {{-- Cabecera módulo con toggle --}}
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="font-semibold capitalize flex items-center gap-2">
                                    <i class="icofont-key text-primary"></i>
                                    {{ $module }}
                                </h3>
                                <label class="cursor-pointer flex items-center gap-1 text-xs opacity-70"
                                    :title="isModuleChecked({{ $permNamesJs }}) ? '{{ __('admin.common.deselect_all') }}' : '{{ __('admin.common.select_all') }}'">
                                    <input type="checkbox" class="checkbox checkbox-primary checkbox-sm"
                                        :checked="isModuleChecked({{ $permNamesJs }})"
                                        :indeterminate="isModuleIndeterminate({{ $permNamesJs }})"
                                        @change="toggleModule({{ $permNamesJs }})"
                                        aria-label="{{ __('admin.common.select_all') }} {{ $module }}" />
                                    <span
                                        x-text="isModuleChecked({{ $permNamesJs }}) ? '{{ __('admin.common.deselect_all') }}' : '{{ __('admin.common.select_all') }}'"></span>
                                </label>
                            </div>

                            {{-- Permisos individuales --}}
                            <div class="space-y-2">
                                @foreach ($modulePerms as $permission)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="checkbox checkbox-primary checkbox-sm" x-model="permissions"
                                            :value="'{{ $permission->name }}'" />
                                        <span class="text-sm group-hover:text-primary transition-colors">
                                            {{ $permission->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Acciones --}}
            <div class="flex justify-end gap-2">
                <x-admin.ui.button :ghost="true" :href="route('roles.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.roles.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>
</x-layouts.admin>
