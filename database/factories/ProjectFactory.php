<?php

namespace Database\Factories;

use App\Models\Catalog;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->words(4, true);

        return [
            'catalog_id' => Catalog::inRandomOrder()->first()?->id ?? Catalog::factory(),
            'project_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'title' => ['es' => ucfirst($title) . ' (ES)', 'ca' => ucfirst($title) . ' (CA)'],
            'description' => ['es' => $this->faker->paragraph(), 'ca' => $this->faker->paragraph()],
            'repo_url' => $this->faker->optional()->url(),
            'live_url' => $this->faker->optional()->url(),
            'status' => 'published',
            'featured' => $this->faker->boolean(20),
        ];
    }
}
