<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Models\Permission;
use App\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    public function index(): View
    {
        Gate::authorize('permissions.view');

        $permissions = Permission::with('roles')
            ->orderBy('name')
            ->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0]);

        $totalRoles = Role::count();

        return view('admin.permissions.index', compact('permissions', 'totalRoles'));
    }

    public function create(): View
    {
        Gate::authorize('permissions.create');

        return view('admin.permissions.create');
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        Gate::authorize('permissions.create');

        $permission = Permission::create(['name' => $request->name, 'guard_name' => 'web']);

        // Admin role automatically receives every new permission
        Role::findByName('Admin', 'web')->givePermissionTo($permission);

        return redirect()->route('permissions.index')
            ->with('success', __('admin.permissions.created', ['name' => $permission->name]));
    }

    public function edit(Permission $permission): View
    {
        Gate::authorize('permissions.update');

        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        Gate::authorize('permissions.update');

        $permission->update(['name' => $request->name]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('permissions.index')
            ->with('success', __('admin.permissions.updated', ['name' => $permission->name]));
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        Gate::authorize('permissions.delete');

        $name = $permission->name;
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', __('admin.permissions.deleted', ['name' => $name]));
    }
}
