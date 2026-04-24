<?php

namespace Database\Factories;

use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectMedia>
 */
class ProjectMediaFactory extends Factory
{
    public function definition(): array
    {
        $type = $this->faker->randomElement([
            'video',
            'document',
            'pdf',
        ]);

        return [
            'type' => $type,
            'url' => match ($type) {
                'video' => $this->faker->url(),
                'document' => $this->faker->url(),
                'pdf' => $this->faker->url(),
            },
            'alt_text' => $this->faker->optional()->sentence(),
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
