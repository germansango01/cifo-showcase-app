<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Programació y desenvolupament',
            'Ciberseguretat',
            'Industrias y tecnologías emergentes',
            'Competencias digitales',
        ]);

        return [
            'slug' => ['es' => Str::slug($name) . '-es', 'ca' => Str::slug($name) . '-ca'],
            'name' => ['es' => $name . ' (ES)', 'ca' => $name . ' (CA)'],
            'icon' => 'icon-' . $this->faker->url(),
        ];
    }
}
