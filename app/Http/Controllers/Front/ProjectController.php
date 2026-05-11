<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        return $this->buildIndex($request);
    }

    public function byCategory(string $locale, Request $request, Category $category): View
    {
        return $this->buildIndex($request, 'category', $category);
    }

    public function byCourse(string $locale, Request $request, Course $course): View
    {
        return $this->buildIndex($request, 'course', $course);
    }

    public function byTag(string $locale, Request $request, Tag $tag): View
    {
        return $this->buildIndex($request, 'tag', $tag);
    }

    public function show(string $locale, Project $project): View
    {
        // Laravel ya buscó el proyecto usando el slug porque es el segundo parámetro
        $project->load(['students', 'course.category', 'media', 'tags']);

        return view('front.project-detail', compact('project'));
    }

    private function buildIndex(Request $request, ?string $activeType = null, mixed $activeModel = null): View
    {
        $query = Project::where('status', 'published')
            ->with(['students', 'course.category', 'tags', 'media'])
            ->when($request->filled('q'), function ($q) use ($request) {
                $search = '%'.$request->string('q')->trim().'%';
                $q->where(function ($inner) use ($search) {
                    $inner->where('title->es', 'like', $search)
                        ->orWhere('title->ca', 'like', $search)
                        ->orWhere('description->es', 'like', $search)
                        ->orWhere('description->ca', 'like', $search);
                });
            })
            ->when($activeType === 'category', fn ($q) => $q->whereHas(
                'course.category',
                fn ($q) => $q->where('categories.id', $activeModel->id)
            ))
            ->when($activeType === 'course', fn ($q) => $q->where('course_id', $activeModel->id))
            ->when($activeType === 'tag', fn ($q) => $q->whereHas(
                'tags',
                fn ($q) => $q->where('tags.id', $activeModel->id)
            ))
            ->latest('project_date');

        $projects = $query->paginate(12)->withQueryString();

        $publishedFilter = fn ($q) => $q->where('status', 'published');

        $categories = Category::withCount(['projects' => $publishedFilter])->orderBy('id')->get();
        $courses = Course::with('category')->withCount(['projects' => $publishedFilter])->orderBy('course_code')->get();
        $tags = Tag::withCount(['projects' => $publishedFilter])->orderBy('id')->get();

        $recentProjects = Project::where('status', 'published')
            ->latest('project_date')
            ->take(5)
            ->get(['id', 'slug', 'title', 'project_date']);

        return view('front.projects', compact(
            'projects',
            'categories',
            'courses',
            'tags',
            'activeType',
            'activeModel',
            'recentProjects',
        ));
    }
}
