<?php

namespace Database\Factories;

use App\Models\Cycle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Cycle>
 */
class CycleFactory extends Factory
{
    protected $model = Cycle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(2);

        return [
            'slug' => Str::slug($name),
            'name_ca' => $name,
            'name_es' => $name,
            'description_ca' => $this->faker->paragraph(),
            'description_es' => $this->faker->paragraph(),
            'icon' => $this->faker->randomElement(['code', 'database', 'cloud']),
        ];
    }
}
