<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Course;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{

    public function run(): void
    {
        if (Course::count() === 0) {
            Course::factory()->count(10)->create();
        }

        foreach (Course::all() as $course) {
            foreach (range(2024, 2026) as $year) {
                Catalog::factory()
                    ->create([
                        'course_id' => $course->id,
                        'year' => $year,
                    ]);
            }
        }
    }
}
