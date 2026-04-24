<?php

namespace Database\Factories;

use App\Models\ProjectImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectImage>
 */
class ProjectImageFactory extends Factory
{
    public function definition(): array
    {

        return [
            'path' => 'projects/' . $this->faker->uuid() . '.jpg',
            'alt_text' => $this->faker->optional()->sentence(),
            'sort_order' => $this->faker->numberBetween(0, 10),
            'featured' => false,
        ];
    }
}
