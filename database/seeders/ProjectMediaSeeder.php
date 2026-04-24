<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Database\Seeder;

class ProjectMediaSeeder extends Seeder
{
    public function run(): void
    {
        Project::all()->each(function ($project) {
            ProjectMedia::factory()
                ->count(rand(1, 3))
                ->create([
                    'project_id' => $project->id,
                ]);
        });
    }
}
