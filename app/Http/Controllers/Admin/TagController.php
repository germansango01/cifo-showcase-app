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
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('tags.view');

        $search = $request->query('search');

        $tags = Tag::query()
            ->withCount('projects')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(15)
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

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

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

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

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
