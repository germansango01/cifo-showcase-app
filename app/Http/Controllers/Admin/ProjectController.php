<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Course;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('projects.view');

        $request->validate([
            'sort' => 'in:project_date,status,created_at',
            'direction' => 'in:asc,desc',
            'per_page' => 'in:5,10,25',
        ]);

        $search = $request->query('search');
        $statusFilter = $request->query('status');
        $courseFilter = $request->query('course');
        $sort = $request->query('sort', 'project_date');
        $direction = $request->query('direction', 'desc');
        $perPage = (int) $request->query('per_page', 10);

        $projects = Project::query()
            ->with(['course', 'tags'])
            ->when($search, fn ($q) => $q->whereRaw("JSON_EXTRACT(title, '$.es') LIKE ?", ["%{$search}%"]))
            ->when($statusFilter, fn ($q) => $q->where('status', $statusFilter))
            ->when($courseFilter, fn ($q) => $q->where('course_id', $courseFilter))
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $courses = Course::orderByRaw("JSON_EXTRACT(name, '$.es')")->get();

        return view('admin.projects.index', compact('projects', 'courses'));
    }

    public function create(): View
    {
        Gate::authorize('projects.create');

        $courseOptions = Course::orderByRaw("JSON_EXTRACT(name, '$.es')")->get()->pluck('name', 'id')->toArray();
        $tags = Tag::orderByRaw("JSON_EXTRACT(name, '$.es')")->get();

        return view('admin.projects.create', compact('courseOptions', 'tags'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        Gate::authorize('projects.create');

        $validated = $request->validated();
        $tags = $validated['tags'] ?? [];
        $validated['featured'] = $request->boolean('featured');
        $validated['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        unset($validated['tags']);

        $project = Project::create($validated);
        $project->tags()->sync($tags);

        return redirect()->route('projects.index')->with('success', __('admin.projects.created'));
    }

    public function edit(Project $project): View
    {
        Gate::authorize('projects.update');

        $courseOptions = Course::orderByRaw("JSON_EXTRACT(name, '$.es')")->get()->pluck('name', 'id')->toArray();
        $tags = Tag::orderByRaw("JSON_EXTRACT(name, '$.es')")->get();
        $selectedTags = $project->tags->pluck('id')->toArray();

        return view('admin.projects.edit', compact('project', 'courseOptions', 'tags', 'selectedTags'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        Gate::authorize('projects.update');

        $validated = $request->validated();
        $tags = $validated['tags'] ?? [];
        $validated['featured'] = $request->boolean('featured');
        unset($validated['tags']);

        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($project->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        } else {
            unset($validated['thumbnail']);
        }

        $project->update($validated);
        $project->tags()->sync($tags);

        return redirect()->route('projects.index')->with('success', __('admin.projects.updated'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        Gate::authorize('projects.delete');

        $project->delete();

        return redirect()->route('projects.index')->with('success', __('admin.projects.deleted'));
    }
}
