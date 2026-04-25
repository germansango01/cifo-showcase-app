<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('users.view');

        // Validamos para que nadie rompa la consulta desde la URL
        $request->validate([
            'sort' => 'in:id,name,email,created_at',
            'direction' => 'in:asc,desc',
        ]);

        // Capturamos los filtros
        $search = $request->query('search');
        $roleName = $request->query('role');
        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'asc');

        $users = User::query()
            ->with('roles')
            // Filtro de búsqueda: Buscamos en nombre O email
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            // Filtro por Rol: Relación con la tabla roles
            ->when($roleName, function ($q) use ($roleName) {
                $q->whereHas('roles', fn ($qr) => $qr->where('name', $roleName));
            })
            // Ordenamiento y Paginación
            ->orderBy($sort, $direction)
            ->paginate(15)
            ->withQueryString(); // MANTIENE los filtros al cambiar de página

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create(): View
    {
        Gate::authorize('users.create');

        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        Gate::authorize('users.create');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            Gate::authorize('users.assign-roles');
            $user->assignRole($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Muestra el detalle de un usuario específico.
     */
    public function show(User $user): View
    {
        Gate::authorize('users.view');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user): View
    {
        Gate::authorize('users.update');

        $roles = Role::all();
        $userRoleNames = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoleNames'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        Gate::authorize('users.update');

        $user->update($request->only('name', 'email'));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        if ($request->has('roles')) {
            Gate::authorize('users.assign-roles');
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('users.delete');

        // Protección para el administrador principal
        if ($user->isAdmin()) {
            return back()->with('error', 'No se puede eliminar al administrador principal del sistema.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
