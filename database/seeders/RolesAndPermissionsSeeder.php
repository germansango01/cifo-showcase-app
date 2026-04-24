<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Resetear caché de Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Definir Entidades y Acciones CRUD
        $entities = ['categories', 'courses', 'projects', 'students', 'tags', 'teachers', 'users'];
        $actions = ['view', 'create', 'update', 'delete'];

        $permissions = [
            'roles.view', 'roles.create', 'roles.update', 'roles.delete',
            'permissions.view',
            'dashboard.view',
            'users.assign-roles',
        ];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                $permissions[] = "{$entity}.{$action}";
            }
        }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Definir Roles

        // ADMIN: Tiene todos los permisos explícitos
        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        // EDITOR: Gestión de contenido
        $editor = Role::firstOrCreate(['name' => 'Editor', 'guard_name' => 'web']);
        $editor->syncPermissions(
            Permission::where('name', 'not like', 'users.%')
                ->where('name', 'not like', 'roles.%')
                ->where('name', 'not like', 'permissions.%')
                ->get()
        );

        // VIEWER: Solo lectura
        $viewer = Role::firstOrCreate(['name' => 'Viewer', 'guard_name' => 'web']);
        $viewer->syncPermissions(Permission::where('name', 'like', '%.view')->get());
    }
}
