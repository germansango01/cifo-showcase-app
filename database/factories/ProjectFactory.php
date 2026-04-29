<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'course_id' => Course::inRandomOrder()->first()?->id ?? Course::factory(),
            'slug' => ['es' => Str::slug($title) . '-es', 'ca' => Str::slug($title) . '-ca'],
            'project_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'title' => ['es' => ucfirst($title) . ' (ES)', 'ca' => ucfirst($title) . ' (CA)'],
            'description' => ['es' => $this->faker->paragraph(), 'ca' => $this->faker->paragraph()],
            'thumbnail' => $this->faker->imageUrl(640, 480, 'tech'),
            'repo_url' => $this->faker->optional()->url(),
            'live_url' => $this->faker->optional()->url(),
            'status' => 'published',
            'featured' => $this->faker->boolean(20),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
