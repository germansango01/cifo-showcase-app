<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectMediaSeeder extends Seeder
{
    public function run(): void
    {
        $images = collect(glob(database_path('seeders/images/*.{jpg,jpeg,png,webp}'), GLOB_BRACE));

        if ($images->isEmpty()) {
            $this->command->error('No images found in database/seeders/images/');

            return;
        }

        $total = $images->count();

        Project::all()->each(function (Project $project) use ($images, $total) {
            $count = rand(3, 5);

            for ($i = 0; $i < $count; $i++) {
                $imagePath = $images[$i % $total];
                $ext = pathinfo($imagePath, PATHINFO_EXTENSION);
                $filename = "project-{$project->id}-" . ($i + 1) . ".{$ext}";

                try {
                    $media = $project
                        ->addMedia($imagePath)
                        ->preservingOriginal()
                        ->usingFileName($filename)
                        ->toMediaCollection('images');

                    if ($i === 0) {
                        $media->setCustomProperty('is_featured', true)->save();
                    }
                } catch (\Throwable $e) {
                    $this->command->warn("Skipped {$imagePath}: {$e->getMessage()}");
                }
            }
        });
    }
}
