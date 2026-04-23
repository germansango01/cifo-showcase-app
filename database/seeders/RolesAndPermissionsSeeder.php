<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ── Permisos ──────────────────────────────────────────────────────────
        $permissions = [
            // users
            'users.view', 'users.create', 'users.update', 'users.delete', 'users.assign-roles',
            // roles
            'roles.view', 'roles.create', 'roles.update', 'roles.delete',
            // permissions
            'permissions.view',
            // dashboard
            'dashboard.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // ── Roles ─────────────────────────────────────────────────────────────

        /** Super Admin — Gate::before bypasses individual checks */
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        /** Admin — todo excepto eliminar Super Admin (controlado en RoleController) */
        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        /** Editor — gestión básica de usuarios + dashboard */
        $editor = Role::firstOrCreate(['name' => 'Editor', 'guard_name' => 'web']);
        $editor->syncPermissions([
            'users.view', 'users.update',
            'dashboard.view',
        ]);

        /** Viewer — sólo lectura */
        $viewer = Role::firstOrCreate(['name' => 'Viewer', 'guard_name' => 'web']);
        $viewer->syncPermissions([
            'users.view',
            'roles.view',
            'permissions.view',
            'dashboard.view',
        ]);

        // ── Usuario demo ──────────────────────────────────────────────────────
        $user = User::firstOrCreate(
            ['email' => 'admin@cifo.local'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $user->assignRole($superAdmin);
    }
}
