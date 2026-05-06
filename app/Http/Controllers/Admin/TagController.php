<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('tags.view');

        $request->validate([
            'sort' => 'in:id,created_at',
            'direction' => 'in:asc,desc',
            'per_page' => 'in:5,10,25',
        ]);

        $search = $request->query('search');
        $sort = $request->query('sort', 'created_at');
        $direction = $request->query('direction', 'desc');
        $perPage = (int) $request->query('per_page', 10);
        $locale = app()->getLocale();

        $tags = Tag::query()
            ->withCount('projects')
            ->when($search, fn ($q) => $q->whereRaw(
                "LOWER(`name`->>'$.{$locale}') LIKE ?",
                [mb_strtolower("%{$search}%")]
            ))
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.tags.index', compact('tags'));
    }

    public function create(): View
    {
        Gate::authorize('tags.create');

        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request): RedirectResponse|Response
    {
        Gate::authorize('tags.create');

        Tag::create($request->validated());

        session()->flash('success', __('admin.tags.created'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag): View
    {
        Gate::authorize('tags.update');

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse|Response
    {
        Gate::authorize('tags.update');

        $tag->update($request->validated());

        session()->flash('success', __('admin.tags.updated'));

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        Gate::authorize('tags.delete');

        $tag->delete();

        return redirect()->route('tags.index')->with('success', __('admin.tags.deleted'));
    }
}
