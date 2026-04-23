<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()->count(10)->create()
        ->each(function ($course) {
                $course->teachers()->attach(
                    Teacher::inRandomOrder()
                        ->take(rand(1, 2))
                        ->pluck('id')
                );
            });
}
}