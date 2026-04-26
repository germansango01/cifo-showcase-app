<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('courses.view');

        $search     = $request->query('search');
        $categoryId = $request->query('category');

        $courses = Course::query()
            ->with('category')
            ->withCount('projects')
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('course_code', 'like', "%{$search}%");
            }))
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->orderBy('course_code')
            ->paginate(15)
            ->withQueryString();

        $categories = Category::orderBy('name_es')->get();

        return view('admin.courses.index', compact('courses', 'categories'));
    }

    public function create(): View
    {
        Gate::authorize('courses.create');

        $categoryOptions = Category::orderBy('name_es')->pluck('name_es', 'id')->toArray();

        return view('admin.courses.create', compact('categoryOptions'));
    }

    public function store(StoreCourseRequest $request): RedirectResponse|Response
    {
        Gate::authorize('courses.create');

        Course::create($request->validated());

        session()->flash('success', __('admin.courses.created'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('courses.index');
    }

    public function edit(Course $course): View
    {
        Gate::authorize('courses.update');

        $categoryOptions = Category::orderBy('name_es')->pluck('name_es', 'id')->toArray();

        return view('admin.courses.edit', compact('course', 'categoryOptions'));
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse|Response
    {
        Gate::authorize('courses.update');

        $course->update($request->validated());

        session()->flash('success', __('admin.courses.updated'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('courses.index');
    }

    public function destroy(Course $course): RedirectResponse
    {
        Gate::authorize('courses.delete');

        $course->delete();

        return redirect()->route('courses.index')->with('success', __('admin.courses.deleted'));
    }
}
