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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
        $locale = app()->getLocale();

        $projects = Project::query()
            ->with(['course', 'tags'])
            ->when($search, fn ($q) => $q->whereRaw(
                "LOWER(`title`->>'$.{$locale}') LIKE ?",
                [mb_strtolower("%{$search}%")]
            ))
            ->when($statusFilter, fn ($q) => $q->where('status', $statusFilter))
            ->when($courseFilter, fn ($q) => $q->where('course_id', $courseFilter))
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $courses = Course::orderBy("name->{$locale}")->get();

        return view('admin.projects.index', compact('projects', 'courses'));
    }

    public function create(): View
    {
        Gate::authorize('projects.create');

        $locale = app()->getLocale();
        $courseOptions = Course::orderBy("name->{$locale}")->get()->pluck('name', 'id')->toArray();
        $tags = Tag::orderBy("name->{$locale}")->get();

        return view('admin.projects.create', compact('courseOptions', 'tags'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        Gate::authorize('projects.create');

        $validated = $request->validated();
        $tags = $validated['tags'] ?? [];
        $featuredValue = $validated['featured_media'] ?? null;
        $validated['featured'] = $request->boolean('featured');
        unset($validated['tags'], $validated['images'], $validated['featured_media']);

        $project = DB::transaction(function () use ($validated, $tags, $request, $featuredValue) {
            $project = Project::create($validated);
            $project->tags()->sync($tags);

            $files = $request->file('images', []);
            foreach ($files as $index => $file) {
                $isFeatured = $featuredValue === "new:{$index}";
                $project->addMedia($file)
                    ->withCustomProperties(['is_featured' => $isFeatured])
                    ->toMediaCollection('images');
            }

            // If no featured was set explicitly, mark the first one
            if (! $featuredValue && $project->getMedia('images')->isNotEmpty()) {
                $project->getFirstMedia('images')->setCustomProperty('is_featured', true)->save();
            }

            return $project;
        });

        return redirect()->route('projects.index')->with('success', __('admin.projects.created'));
    }

    public function edit(Project $project): View
    {
        Gate::authorize('projects.update');

        $locale = app()->getLocale();
        $courseOptions = Course::orderBy("name->{$locale}")->get()->pluck('name', 'id')->toArray();
        $tags = Tag::orderBy("name->{$locale}")->get();
        $selectedTags = $project->tags->pluck('id')->toArray();

        return view('admin.projects.edit', compact('project', 'courseOptions', 'tags', 'selectedTags'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        Gate::authorize('projects.update');

        $validated = $request->validated();
        $tags = $validated['tags'] ?? [];
        $deleteIds = $validated['delete_media'] ?? [];
        $mediaOrder = $validated['media_order'] ?? [];
        $featuredValue = $validated['featured_media'] ?? null;
        $validated['featured'] = $request->boolean('featured');
        unset($validated['tags'], $validated['images'], $validated['delete_media'],
            $validated['media_order'], $validated['featured_media']);

        DB::transaction(function () use ($project, $validated, $tags, $request, $deleteIds, $mediaOrder, $featuredValue) {
            $project->update($validated);
            $project->tags()->sync($tags);

            // Delete requested media (verify ownership)
            if ($deleteIds) {
                $project->media()
                    ->whereIn('id', $deleteIds)
                    ->get()
                    ->each(fn ($m) => $m->delete());
            }

            // Add new files
            $newFiles = $request->file('images', []);
            foreach ($newFiles as $index => $file) {
                $isFeatured = $featuredValue === "new:{$index}";
                $project->addMedia($file)
                    ->withCustomProperties(['is_featured' => $isFeatured])
                    ->toMediaCollection('images');
            }

            // Apply sort order for existing media
            foreach ($mediaOrder as $position => $mediaId) {
                $project->media()->where('id', $mediaId)->update(['order_column' => $position + 1]);
            }

            // Apply featured for existing media
            if ($featuredValue && is_numeric($featuredValue)) {
                $project->getMedia('images')->each(function ($m) use ($featuredValue) {
                    $m->setCustomProperty('is_featured', $m->id === (int) $featuredValue)->save();
                });
            }

            // Ensure at least one featured image
            $hasAnyFeatured = $project->getMedia('images')
                ->contains(fn ($m) => (bool) $m->getCustomProperty('is_featured'));

            if (! $hasAnyFeatured && $project->getMedia('images')->isNotEmpty()) {
                $project->getFirstMedia('images')->setCustomProperty('is_featured', true)->save();
            }
        });

        return redirect()->route('projects.edit', $project)->with('success', __('admin.projects.updated'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        Gate::authorize('projects.delete');

        $project->delete();

        return redirect()->route('projects.index')->with('success', __('admin.projects.deleted'));
    }
}
