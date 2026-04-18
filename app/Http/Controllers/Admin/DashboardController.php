<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $now        = Carbon::now();
        $monthStart = $now->copy()->startOfMonth();
 
        // ── KPIs ────────────────────────────────────────────────────────────
        $totalUsers    = User::count();
        $prevTotal     = User::where('created_at', '<', $monthStart)->count();
        $newThisMonth  = User::where('created_at', '>=', $monthStart)->count();
        $activeRoles   = Role::count();
        $totalPerms    = Permission::count();
 
        $userTrend = $prevTotal > 0
            ? round((($totalUsers - $prevTotal) / $prevTotal) * 100, 1)
            : 0;
 
        $stats = [
            [
                'label'       => 'Total usuarios',
                'value'       => $totalUsers,
                'icon'        => 'icofont-users',
                'color'       => 'primary',
                'trend'       => $userTrend,
                'trend_label' => 'vs. mes anterior',
            ],
            [
                'label'       => 'Roles activos',
                'value'       => $activeRoles,
                'icon'        => 'icofont-shield',
                'color'       => 'secondary',
                'trend'       => null,
                'trend_label' => null,
            ],
            [
                'label'       => 'Permisos totales',
                'value'       => $totalPerms,
                'icon'        => 'icofont-key',
                'color'       => 'accent',
                'trend'       => null,
                'trend_label' => null,
            ],
            [
                'label'       => 'Nuevos este mes',
                'value'       => $newThisMonth,
                'icon'        => 'icofont-ui-user',
                'color'       => 'success',
                'trend'       => null,
                'trend_label' => 'registros en ' . $now->translatedFormat('F'),
            ],
        ];
 
        // ── Últimos 5 usuarios ───────────────────────────────────────────────
        $recentUsers = User::with('roles')
            ->latest()
            ->take(5)
            ->get();
 
        // ── Distribución por rol ─────────────────────────────────────────────
        $roleDistribution = Role::withCount('users')
            ->orderByDesc('users_count')
            ->get()
            ->mapWithKeys(fn (Role $role) => [$role->name => $role->users_count]);
 
        return view('admin.dashboard', compact('stats', 'recentUsers', 'roleDistribution'));
    }

}
