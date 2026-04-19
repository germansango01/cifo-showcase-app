<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()
    ->count(30)
    ->create()
    ->each(function ($project) {
        $project->tags()->attach(
            Tag::inRandomOrder()->take(rand(2, 5))->pluck('id')
        );

        ProjectMedia::factory()
            ->count(rand(1, 3))
            ->create([
                'project_id' => $project->id,
            ]);
    });
    }
}
