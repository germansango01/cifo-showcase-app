<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('students.view');

        $request->validate([
            'sort' => 'in:name,email,created_at',
            'direction' => 'in:asc,desc',
            'per_page' => 'in:5,10,25',
        ]);

        $search = $request->query('search');
        $sort = $request->query('sort', 'name');
        $direction = $request->query('direction', 'asc');
        $perPage = (int) $request->query('per_page', 10);

        $students = Student::query()
            ->withCount('projects')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.students.index', compact('students'));
    }

    public function create(): View
    {
        Gate::authorize('students.create');

        return view('admin.students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse|Response
    {
        Gate::authorize('students.create');

        Student::create($request->validated());

        session()->flash('success', __('admin.students.created'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('students.index');
    }

    public function edit(Student $student): View
    {
        Gate::authorize('students.update');

        return view('admin.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse|Response
    {
        Gate::authorize('students.update');

        $student->update($request->validated());

        session()->flash('success', __('admin.students.updated'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('students.index');
    }

    public function destroy(Student $student): RedirectResponse
    {
        Gate::authorize('students.delete');

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', __('admin.students.deleted'));
    }
}
