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

        $proyects = Project::where()->get();



        return view('front.home', compact('projects'));
    }

    /**
     * Show the about page.
     */
    public function about(): View
    {
        return view('front.about');
    }
}
