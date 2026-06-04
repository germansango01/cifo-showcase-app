<?php

namespace Database\Factories;

use App\Models\Catalog;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Catalog>
 */
class CatalogFactory extends Factory
{
    protected $model = Catalog::class;

    public function definition(): array
    {
        $year = $this->faker->numberBetween(2023, 2026);

        return [
            'course_id' => Course::query()->inRandomOrder()->value('id') ?? Course::factory(),

            'year' => $year,

            'cycle' => $this->faker->randomElement([
                'morning',
                'afternoon',
            ]),

            'catalog_code' => $this->faker->unique()->numerify(
                sprintf(
                    '%02d/CIFOFSE-PL/###/#######/###',
                    $year - 2000
                )
            ),

            'is_active' => true,
        ];
    }
}
