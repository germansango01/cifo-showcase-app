<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Laravel',
            'PHP',
            'Vue',
            'React',
            'Node.js',
            'Tailwind',
            'MySQL',
            'PostgreSQL',
            'Docker',
            'API REST',
            'DevOps',
            'UX/UI',
            'Testing',
            'CI/CD',
            'JavaScript',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 9999),
        ];
    }
}
