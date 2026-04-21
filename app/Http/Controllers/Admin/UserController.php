<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('users.view');

        $users = User::query()
            ->with('roles')
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%' . $request->search . '%';
                $q->where(function ($q) use ($term) {
                    $q->where('name', 'like', $term)
                        ->orWhere('email', 'like', $term);
                });
            })
            ->when($request->filled('role'), function ($q) use ($request) {
                $q->whereHas('roles', fn ($q) => $q->where('name', $request->role));
            })
            ->when($request->filled('sort'), function ($q) use ($request) {
                $allowed = ['name', 'email', 'created_at'];
                $column = in_array($request->sort, $allowed) ? $request->sort : 'created_at';
                $dir = $request->direction === 'asc' ? 'asc' : 'desc';
                $q->orderBy($column, $dir);
            }, function ($q) {
                $q->latest();
            })
            ->paginate(15)
            ->withQueryString();

        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create(): View
    {
        Gate::authorize('users.create');

        $roles = Role::orderBy('name')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        Gate::authorize('users.create');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Más moderno que bcrypt()
        ]);

        if ($request->filled('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()
            ->route('users.index')
            ->with('success', "Usuario «{$user->name}» creado correctamente.");
    }

    public function show(User $user): View
    {
        Gate::authorize('users.view');

        $user->load('roles.permissions');

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        Gate::authorize('users.update');

        $roles = Role::orderBy('name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        Gate::authorize('users.update');

        $data = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Verificación extra para asignación de roles
        if ($request->has('roles')) {
            Gate::authorize('users.assign-roles');
            $user->syncRoles($request->roles ?? []);
        }

        return redirect()
            ->route('users.index')
            ->with('success', "Usuario «{$user->name}» actualizado correctamente.");
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('users.delete');

        // Protección: No borrarse a sí mismo
        if ($user->id === $request->user()->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'No puedes eliminar tu propio usuario.');
        }

        // Protección: No borrar Super Admin (usando el método de Spatie)
        if ($user->hasRole('Super Admin')) {
            return redirect()
                ->route('users.index')
                ->with('error', 'No se puede eliminar un Super Admin.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', "Usuario «{$name}» eliminado correctamente.");
    }
}
