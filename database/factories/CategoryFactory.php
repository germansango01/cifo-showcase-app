<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $pairs = [
            ['es' => 'Programación y desarrollo', 'ca' => 'Programació i desenvolupament'],
            ['es' => 'Ciberseguridad',             'ca' => 'Ciberseguretat'],
            ['es' => 'Tecnologías emergentes',     'ca' => 'Tecnologies emergents'],
            ['es' => 'Competencias digitales',     'ca' => 'Competències digitals'],
        ];

        // $icons = ['icofont-code', 'icofont-shield', 'icofont-circuit', 'icofont-laptop'];

        $pair = $this->faker->randomElement($pairs);

        return [
            'name' => ['es' => $pair['es'], 'ca' => $pair['ca']],
            // 'icon' => $this->faker->randomElement($icons),
        ];
    }
}
