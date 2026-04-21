<x-layouts.app :title="'Nuevo rol'">
    <x-admin.ui.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Roles',     'href' => route('roles.index')],
        ['label' => 'Nuevo rol'],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">Nuevo rol</h1>
        <p class="text-sm opacity-70">Define un nombre y selecciona los permisos que tendrá este rol.</p>
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
                <x-admin.ui.input name="name" label="Nombre del rol" icon="icofont-shield" placeholder="Ej: Editor de contenidos" required />
            </div>

            {{-- Contador en vivo --}}
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Permisos</h2>
                <x-admin.ui.badge type="primary">
                    <span x-text="selectedCount"></span> de {{ $permissions->flatten()->count() }} seleccionados
                </x-admin.ui.badge>
            </div>

            {{-- Grid de permisos agrupados --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">
                @foreach($permissions as $module => $modulePerms)
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
                            <label class="cursor-pointer flex items-center gap-1 text-xs opacity-70" :title="isModuleChecked({{ $permNamesJs }}) ? 'Desmarcar todos' : 'Seleccionar todos'">
                                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" :checked="isModuleChecked({{ $permNamesJs }})" :indeterminate="isModuleIndeterminate({{ $permNamesJs }})" @change="toggleModule({{ $permNamesJs }})" aria-label="Seleccionar todos los permisos de {{ $module }}" />
                                <span x-text="isModuleChecked({{ $permNamesJs }}) ? 'Todos' : 'Selec. todos'"></span>
                            </label>
                        </div>

                        {{-- Permisos individuales --}}
                        <div class="space-y-2">
                            @foreach($modulePerms as $permission)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="checkbox checkbox-primary checkbox-sm" x-model="permissions" :value="'{{ $permission->name }}'" />
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
                <x-admin.ui.button variant="ghost" :href="route('roles.index')">
                    Cancelar
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    Crear rol
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>
</x-layouts.app>
