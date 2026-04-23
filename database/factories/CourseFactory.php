<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
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
            'category_id' => Category::factory(),
            'course_code' => strtoupper($this->faker->unique()->bothify('CRS-###-???')),
            'name' => 'Curso de ' . $this->faker->randomElement([
                'Laravel',
                'Vue',
                'React',
                'PHP',
                'Node.js',
                'UX/UI',
                'DevOps',
                'Python',
            ]),
        ];
    }
}
