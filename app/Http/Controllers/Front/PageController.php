<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Show the home page with featured projects and stats.
     */
    public function index(): View
    {
        $featured = Project::with(['student', 'professor'])
            ->where('featured', true)
            ->latest('year')
            ->take(6)
            ->get();

        $stats = [
            'graduates' => 350,
            'projects' => Project::count(),
            'years' => 18,
            'teachers' => 24,
        ];

        return view('front.home', compact('featured', 'stats'));
    }

    /**
     * Show the about page.
     */
    public function about(): View
    {
        return view('front.about');
    }
}
