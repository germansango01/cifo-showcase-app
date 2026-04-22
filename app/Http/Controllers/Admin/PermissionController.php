<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:permissions.view');
    }

    public function index(): View
    {
        $permissions = Permission::with('roles')
            ->orderBy('name')
            ->get()
            ->groupBy(function ($p) {
                return explode('.', $p->name)[0];
            });

        $totalRoles = Role::count();

        return view('admin.permissions.index', compact('permissions', 'totalRoles'));
    }
}
