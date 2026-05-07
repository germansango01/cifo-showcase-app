<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Database\Seeder;

class ProjectFileSeeder extends Seeder
{
    public function run(): void
    {
        Project::all()->each(function (Project $project) {
            ProjectFile::factory()
                ->count(rand(0, 3))
                ->create(['project_id' => $project->id]);
        });
    }
}
