<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('categories.view');

        $search = $request->query('search');

        $categories = Category::query()
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(name, '$.es') LIKE ?", ["%{$search}%"]);
            }))
            ->orderByRaw("JSON_EXTRACT(name, '$.es')")
            ->paginate(15)
            ->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        Gate::authorize('categories.create');

        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse|Response
    {
        Gate::authorize('categories.create');

        Category::create($request->validated());

        session()->flash('success', __('admin.categories.created'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('categories.index');
    }

    public function edit(Category $category): View
    {
        Gate::authorize('categories.update');

        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse|Response
    {
        Gate::authorize('categories.update');

        $category->update($request->validated());

        session()->flash('success', __('admin.categories.updated'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        Gate::authorize('categories.delete');

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', __('admin.categories.deleted'));
    }
}