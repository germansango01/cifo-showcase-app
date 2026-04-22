<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Show the paginated, filterable projects catalog.
     */
    public function index(Request $request): View
    {
        $query = Project::with(['student', 'professor'])
            ->when($request->filled('year'), fn ($q) => $q->where('year', $request->year))
            ->when($request->filled('cycle'), fn ($q) => $q->where('cycle', $request->cycle))
            ->when($request->filled('professor'), fn ($q) => $q->whereHas('professor', function ($q) use ($request) {
                $q->whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$request->professor]);
            }))
            ->when($request->filled('tag'), fn ($q) => $q->whereHas('tags', fn ($q) => $q->where('slug', $request->tag)))
            ->latest('year');

        $projects = $query->paginate(12)->withQueryString();
        $years = Project::distinct()->orderByDesc('year')->pluck('year');
        $professors = Professor::orderBy('name')->get();

        return view('front.projects', compact('projects', 'years', 'professors'));
    }

    /**
     * Show an individual project detail page.
     */
    public function show(Project $project): View
    {
        $project->load(['student', 'professor', 'images', 'technologies', 'tags']);

        return view('front.project-detail', compact('project'));
    }
}
