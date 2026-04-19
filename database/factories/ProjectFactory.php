<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Project;
use App\Models\User;
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
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            'title_ca' => $title,
            'title_es' => $title,

            'description_ca' => $this->faker->paragraph(),
            'description_es' => $this->faker->paragraph(),

            'thumbnail' => $this->faker->imageUrl(640, 480, 'technics'),

            'repo_url' => $this->faker->url(),
            'live_url' => $this->faker->url(),

            'status' => $this->faker->randomElement(['draft',
                'pending',
                'published',
                'rejected', ]),

            'featured' => $this->faker->boolean(20),

            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
