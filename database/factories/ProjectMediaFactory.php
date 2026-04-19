<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectMedia>
 */
class ProjectMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'type' => $this->faker->randomElement(['image', 'video']),
            'path' => $this->faker->imageUrl(),
            'alt_text' => $this->faker->sentence(),
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
