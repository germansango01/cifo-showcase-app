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
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'course_code' => $this->faker->unique()->numerify('IFC####'),
            'name' => (function () {
                $tech = $this->faker->randomElement(['Laravel', 'Vue', 'React', 'PHP', 'Node.js', 'UX/UI', 'DevOps', 'Python']);

                return ['es' => "Curso de {$tech}", 'ca' => "Curs de {$tech}"];
            })(),
        ];
    }
}
