<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        Gate::authorize('roles.view');

        $roles = Role::withCount(['permissions', 'users'])->orderBy('name')->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        Gate::authorize('roles.create');

        $permissions = Permission::orderBy('name')->get()->groupBy(fn ($p) => explode('.', $p->name)[0]);

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        Gate::authorize('roles.create');

        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')
            ->with('success', "Rol «{$role->name}» creado correctamente.");
    }

    public function edit(Role $role): View
    {
        Gate::authorize('roles.update');

        // Protección contra edición de Admin
        abort_if($role->name === 'Admin', 403, 'El rol Admin no puede modificarse.');

        $permissions = Permission::orderBy('name')->get()->groupBy(fn ($p) => explode('.', $p->name)[0]);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        Gate::authorize('roles.update');
        abort_if($role->name === 'Admin', 403, 'El rol Admin no puede modificarse.');

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')
            ->with('success', "Rol «{$role->name}» actualizado correctamente.");
    }

    public function destroy(Role $role): RedirectResponse
    {
        Gate::authorize('roles.delete');
        abort_if($role->name === 'Admin', 403, 'El rol Admin no puede eliminarse.');

        $name = $role->name;
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', "Rol «{$name}» eliminado.");
    }
}
