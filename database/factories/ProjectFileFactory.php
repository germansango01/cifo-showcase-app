<?php

namespace Database\Factories;

use App\Models\ProjectFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectFile>
 */
class ProjectFileFactory extends Factory
{
    protected $model = ProjectFile::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement([
            'pdf', 'document', 'spreadsheet', 'presentation', 'markdown', 'video',
        ]);

        return [
            'type' => $type,
            'url' => $this->faker->url(),
            'label' => $this->faker->boolean(80)
                ? ['es' => $this->faker->words(3, true), 'ca' => $this->faker->words(3, true)]
                : null,
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
