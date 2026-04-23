<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Project::where('status', 'published')
            ->with(['students', 'course.category', 'tags'])
            ->when($request->filled('year'), fn ($q) => $q->whereYear('project_date', $request->year))
            ->when($request->filled('cycle'), fn ($q) => $q->whereHas('course.category', fn ($q) => $q->where('slug', $request->cycle)))
            ->when($request->filled('professor'), fn ($q) => $q->whereHas('course.teachers', fn ($q) => $q->whereRaw("LOWER(REPLACE(name,' ','-')) = ?", [$request->professor])))
            ->when($request->filled('tag'), fn ($q) => $q->whereHas('tags', fn ($q) => $q->where('slug', $request->tag)))
            ->latest('project_date');

        $projects = $query->paginate(12)->withQueryString();
        $years = Project::selectRaw('YEAR(project_date) as year')->distinct()->orderByDesc('year')->pluck('year');
        $teachers = Teacher::orderBy('name')->get();

        return view('front.projects', compact('projects', 'years', 'teachers'));
    }

    public function show(Project $project): View
    {
        $project->load(['students', 'course.category', 'media', 'tags']);

        return view('front.project-detail', compact('project'));
    }
}
