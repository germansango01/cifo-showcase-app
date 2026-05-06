<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectImageController extends Controller
{
    public function store(Request $request, Project $project): RedirectResponse
    {
        Gate::authorize('projects.update');

        $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        foreach ($request->file('images') as $file) {
            $project->addMedia($file)->toMediaCollection('project_images');
        }

        return back()->with('success', __('admin.projects.images_uploaded'));
    }

    public function destroy(Media $media): JsonResponse
    {
        Gate::authorize('projects.update');

        if ($media->model_type !== Project::class) {
            throw new NotFoundHttpException();
        }

        $media->delete();

        return response()->json(['message' => __('admin.projects.image_deleted')]);
    }
}
