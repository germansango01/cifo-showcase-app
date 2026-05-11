<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Course;
use App\Models\Project;
use App\Models\Student;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('projects.view');

        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:draft,pending,published,rejected'],
            'course' => ['nullable', 'integer'],
            'sort' => ['nullable', 'in:project_date,status,created_at'],
            'direction' => ['nullable', 'in:asc,desc'],
            'per_page' => ['nullable', 'in:5,10,25'],
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
        $courseOptions = Course::orderBy("name->{$locale}")->get()
            ->mapWithKeys(fn ($c) => [$c->id => "[{$c->course_code}] {$c->name}"])
            ->toArray();
        $tags = Tag::orderBy("name->{$locale}")->get();
        $students = Student::orderBy('name')->get();

        return view('admin.projects.create', compact('courseOptions', 'tags', 'students'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        Gate::authorize('projects.create');

        $validated = $request->validated();
        $tags = $validated['tags'] ?? [];
        $students = $validated['students'] ?? [];
        $filesData = $validated['files'] ?? [];
        $featuredValue = $validated['featured_media'] ?? null;
        $validated['featured'] = $request->boolean('featured');
        $validated['project_date'] = $validated['project_date'].'-01';
        unset($validated['tags'], $validated['students'], $validated['images'], $validated['featured_media'], $validated['files']);

        $project = DB::transaction(function () use ($validated, $tags, $students, $filesData, $request, $featuredValue) {
            $project = Project::create($validated);
            $project->tags()->sync($tags);
            $project->students()->sync($students);
            $this->syncMedia($project, $request->file('images', []), $featuredValue);
            $this->syncFiles($project, $filesData);

            return $project;
        });

        return redirect()->route('admin.projects.index')->with('success', __('admin.projects.created'));
    }

    public function show(Project $project): View
    {
        Gate::authorize('projects.view');

        $project->load(['course', 'tags', 'students', 'files', 'media']);

        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        Gate::authorize('projects.update');

        $locale = app()->getLocale();
        $courseOptions = Course::orderBy("name->{$locale}")->get()
            ->mapWithKeys(fn ($c) => [$c->id => "[{$c->course_code}] {$c->name}"])
            ->toArray();
        $tags = Tag::orderBy("name->{$locale}")->get();
        $selectedTags = $project->tags->pluck('id')->toArray();
        $students = Student::orderBy('name')->get();
        $selectedStudents = $project->students->pluck('id')->toArray();

        return view('admin.projects.edit', compact('project', 'courseOptions', 'tags', 'selectedTags', 'students', 'selectedStudents'));
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        Gate::authorize('projects.update');

        $validated = $request->validated();
        $tags = $validated['tags'] ?? [];
        $students = $validated['students'] ?? [];
        $filesData = $validated['files'] ?? [];
        $deleteIds = $validated['delete_media'] ?? [];
        $mediaOrder = $validated['media_order'] ?? [];
        $featuredValue = $validated['featured_media'] ?? null;
        $validated['featured'] = $request->boolean('featured');
        $validated['project_date'] = $validated['project_date'].'-01';
        unset($validated['tags'], $validated['students'], $validated['images'], $validated['delete_media'],
            $validated['media_order'], $validated['featured_media'], $validated['files']);

        DB::transaction(function () use ($project, $validated, $tags, $students, $filesData, $request, $deleteIds, $mediaOrder, $featuredValue) {
            $project->update($validated);
            $project->tags()->sync($tags);
            $project->students()->sync($students);

            if ($deleteIds) {
                $project->media()
                    ->whereIn('id', $deleteIds)
                    ->get()
                    ->each(fn ($m) => $m->delete());
            }

            foreach ($mediaOrder as $position => $mediaId) {
                $project->media()->where('id', $mediaId)->update(['order_column' => $position + 1]);
            }

            if ($featuredValue && is_numeric($featuredValue)) {
                $project->getMedia('images')->each(function ($m) use ($featuredValue) {
                    $m->setCustomProperty('is_featured', $m->id === (int) $featuredValue)->save();
                });
            }

            $this->syncMedia($project, $request->file('images', []), $featuredValue);
            $this->syncFiles($project, $filesData, existing: true);
        });

        return redirect()->route('admin.projects.index')->with('success', __('admin.projects.updated'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        Gate::authorize('projects.delete');

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', __('admin.projects.deleted'));
    }

    /**
     * Add newly uploaded image files to a project's media collection.
     *
     * @param  array<int,UploadedFile>  $files
     * @param  string|null  $featuredValue  e.g. "new:0" or numeric media id
     */
    private function syncMedia(Project $project, array $files, ?string $featuredValue): void
    {
        foreach ($files as $index => $file) {
            $isFeatured = $featuredValue === "new:{$index}";
            $project->addMedia($file)
                ->withCustomProperties(['is_featured' => $isFeatured])
                ->toMediaCollection('images');
        }

        $hasAnyFeatured = $project->getMedia('images')
            ->contains(fn ($m) => (bool) $m->getCustomProperty('is_featured'));

        if (! $hasAnyFeatured && $project->getMedia('images')->isNotEmpty()) {
            $project->getFirstMedia('images')->setCustomProperty('is_featured', true)->save();
        }
    }

    /**
     * Sync the project_files rows from submitted form data.
     *
     * @param  array<int,array<string,mixed>>  $filesData
     * @param  bool  $existing  When true, delete rows not present in submission.
     */
    private function syncFiles(Project $project, array $filesData, bool $existing = false): void
    {
        if ($existing) {
            $submittedIds = collect($filesData)
                ->pluck('id')
                ->filter()
                ->map(fn ($id) => (int) $id)
                ->toArray();

            $project->files()->whereNotIn('id', $submittedIds)->delete();
        }

        foreach ($filesData as $index => $fileData) {
            $id = isset($fileData['id']) ? (int) $fileData['id'] : null;
            $attrs = [
                'type' => $fileData['type'],
                'url' => $fileData['url'],
                'label' => $fileData['label'] ?? null,
                'sort_order' => $index,
            ];

            if ($id) {
                $project->files()->where('id', $id)->update($attrs);
            } else {
                $project->files()->create($attrs);
            }
        }
    }
}
