<?php

namespace Database\Factories;

use App\Models\Course;
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
        $title = $this->faker->sentence(3);

        return [
            'course_id' => Course::inRandomOrder()->first()?->id ?? Course::factory(),
            'project_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'title_ca' => $title . ' (CA)',
            'title_es' => $title . ' (ES)',
            'description_ca' => $this->faker->paragraph(),
            'description_es' => $this->faker->paragraph(),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'tech'),
            'repo_url' => $this->faker->optional()->url(),
            'live_url' => $this->faker->optional()->url(),
            'status' => $this->faker->randomElement([
                'draft',
                'pending',
                'published',
                'rejected'
            ]),
            'featured' => $this->faker->boolean(20),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
