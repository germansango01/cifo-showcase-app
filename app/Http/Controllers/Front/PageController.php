<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $featured = Project::where('featured', true)
            ->where('status', 'published')
            ->with(['students', 'tags', 'course.category'])
            ->latest('project_date')
            ->take(6)
            ->get();

        $stats = [
            'graduates' => Student::count(),
            'projects' => Project::where('status', 'published')->count(),
            'years' => Project::distinct()->count(DB::raw('YEAR(project_date)')),
            'teachers' => Teacher::count(),
        ];

        return view('front.home', compact('featured', 'stats'));
    }

    public function about(): View
    {
        return view('front.about');
    }
}
