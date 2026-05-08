<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('teachers.view');

        $request->validate([
            'sort' => 'in:name,email,created_at',
            'direction' => 'in:asc,desc',
            'per_page' => 'in:5,10,25',
        ]);

        $search = $request->query('search');
        $sort = $request->query('sort', 'name');
        $direction = $request->query('direction', 'asc');
        $perPage = (int) $request->query('per_page', 10);

        $teachers = Teacher::query()
            ->withCount('courses')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        Gate::authorize('teachers.create');

        $locale = app()->getLocale();
        $courseOptions = Course::orderBy("name->{$locale}")->get();

        return view('admin.teachers.create', compact('courseOptions'));
    }

    public function store(StoreTeacherRequest $request): RedirectResponse|Response
    {
        Gate::authorize('teachers.create');

        $validated = $request->validated();
        $courses = $validated['courses'] ?? [];
        unset($validated['courses']);

        $teacher = Teacher::create($validated);
        $teacher->courses()->sync($courses);

        session()->flash('success', __('admin.teachers.created'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('teachers.index');
    }

    public function edit(Teacher $teacher): View
    {
        Gate::authorize('teachers.update');

        $locale = app()->getLocale();
        $courseOptions = Course::orderBy("name->{$locale}")->get();
        $selectedCourses = $teacher->courses->pluck('id')->toArray();

        return view('admin.teachers.edit', compact('teacher', 'courseOptions', 'selectedCourses'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse|Response
    {
        Gate::authorize('teachers.update');

        $validated = $request->validated();
        $courses = $validated['courses'] ?? [];
        unset($validated['courses']);

        $teacher->update($validated);
        $teacher->courses()->sync($courses);

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
