<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Student;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::factory()
            ->count(24)
            ->create()
            ->each(function ($project) {

                $project->students()->attach(
                    Student::inRandomOrder()
                        ->take(rand(1, 4))
                        ->pluck('id')
                );

                $project->tags()->attach(
                    Tag::inRandomOrder()
                        ->take(rand(1, 5))
                        ->pluck('id')
                );

                ProjectFile::factory()
                    ->count(rand(0, 3))
                    ->create([
                        'project_id' => $project->id,
                    ]);
            });
    }
}
