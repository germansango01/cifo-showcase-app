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
            'image',
            'video',
            'document',
            'pdf'
        ]);

        return [
            'type' => $type,
            'path' => match ($type) {
                'image' => $this->faker->imageUrl(800, 600, 'tech'),
                'video' => $this->faker->url(),
                'document' => $this->faker->url(),
                'pdf' => $this->faker->url(),
            },
            'alt_text' => $this->faker->optional()->sentence(),
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
