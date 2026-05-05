<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectImageController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $project->addMedia($file)->toMediaCollection('project_images');
            }
        }

        return back()->with('success', 'Imágenes subidas correctamente.');
    }

    public function destroy(Media $media)
    {
        $media->delete();

        return response()->json(['message' => 'Imagen eliminada']);
    }
}
