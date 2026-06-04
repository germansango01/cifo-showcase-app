<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatalogRequest;
use App\Http\Requests\UpdateCatalogRequest;
use App\Models\Course;
use App\Models\Catalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CatalogController extends Controller
{

    public function index(Request $request): View
    {
        Gate::authorize('catalogs.view');

        $request->validate([
            'sort' => 'in:catalog_code,created_at',
            'direction' => 'in:asc,desc',
            'per_page' => 'in:5,10,25',
        ]);

        $search = $request->query('search');
        $courseId = $request->query('course');
        $sort = $request->query('sort', 'catalog_code');
        $direction = $request->query('direction', 'asc');
        $perPage = (int) $request->query('per_page', 10);
        $locale = app()->getLocale();

        $catalogs = Catalog::query()
            ->with('course')
            ->withCount('projects')
            ->when($search, fn($q) => $q->where(function ($q) use ($search, $locale) {
                $q->whereRaw("LOWER(`name`->>'$.{$locale}') LIKE ?", [mb_strtolower("%{$search}%")])
                    ->orWhere('catalog_code', 'like', mb_strtolower("%{$search}%"));
            }))
            ->when($courseId, fn($q) => $q->where('course_id', $courseId))
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $courses = Course::orderBy("name->{$locale}")->get();

        return view('admin.catalogs.index', compact('catalogs', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('catalogs.create');

        return view('admin.catalogs.create', compact('catalogOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatalogRequest $request): RedirectResponse|Response
    {
        Gate::authorize('catalogs.create');

        Catalog::create($request->validated());

        session()->flash('success', __('admin.catalogs.created'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('catalogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalog $catalog): View
    {
        Gate::authorize('catalogs.update');

        //$courseOptions = Course::orderBy('name->' . app()->getLocale())->get()->pluck('name', 'id')->toArray();

        //return view('admin.catalogs.edit', compact('catalog', 'courseOptions'));
        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatalogRequest $request, Catalog $catalog): RedirectResponse|Response
    {
        Gate::authorize('catalogs.update');

        $catalog->update($request->validated());

        session()->flash('success', __('admin.catalogs.updated'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('catalogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalog $catalog): RedirectResponse
    {
        Gate::authorize('catalogs.delete');

        $catalog->delete();

        return redirect()->route('catalogs.index')->with('success', __('admin.catalogs.deleted'));
    }
}
