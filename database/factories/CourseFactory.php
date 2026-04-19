<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Cycle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'cycle_id' => Cycle::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->sentence(3),
            'academic_year' => $this->faker->randomElement([
                '2023-2024',
                '2024-2025',
                '2025-2026',
            ]),
        ];
    }
}
