<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(): View
    {
        // Validación de permisos moderna
        Gate::authorize('permissions.view');

        $permissions = Permission::with('roles')
            ->orderBy('name')
            ->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0]);

        $totalRoles = Role::count();

        return view('admin.permissions.index', compact('permissions', 'totalRoles'));
    }
}
