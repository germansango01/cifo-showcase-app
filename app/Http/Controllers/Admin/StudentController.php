<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('students.view');

        $search = $request->query('search');

        $students = Student::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->withCount('projects')
            ->orderBy('name')
            ->paginate(15)
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