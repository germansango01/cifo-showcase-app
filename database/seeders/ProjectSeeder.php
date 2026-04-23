<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\Student;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::factory()
            ->count(20)
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

                ProjectMedia::factory()
                    ->count(rand(1, 4))
                    ->create([
                        'project_id' => $project->id,
                    ]);
            });
    }
}
