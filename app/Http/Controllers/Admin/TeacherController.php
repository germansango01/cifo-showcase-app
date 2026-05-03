<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('teachers.view');

        $search = $request->query('search');

        $teachers = Teacher::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->withCount('courses')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        Gate::authorize('teachers.create');

        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request): RedirectResponse|Response
    {
        Gate::authorize('teachers.create');

        Teacher::create($request->validated());

        session()->flash('success', __('admin.teachers.created'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('teachers.index');
    }

    public function edit(Teacher $teacher): View
    {
        Gate::authorize('teachers.update');

        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse|Response
    {
        Gate::authorize('teachers.update');

        $teacher->update($request->validated());

        session()->flash('success', __('admin.teachers.updated'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('teachers.index');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        Gate::authorize('teachers.delete');

        $teacher->delete();

        return redirect()
            ->route('teachers.index')
            ->with('success', __('admin.teachers.deleted'));
    }
}