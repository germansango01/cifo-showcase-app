<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => ['es' => 'Programación y desarrollo', 'ca' => 'Programació i desenvolupament'],
                'icon' => 'icofont-code',
            ],
            [
                'name' => ['es' => 'Ciberseguridad',           'ca' => 'Ciberseguretat'],
                'icon' => 'icofont-shield',
            ],
            [
                'name' => ['es' => 'Tecnologías emergentes',   'ca' => 'Tecnologies emergents'],
                'icon' => 'icofont-circuit',
            ],
            [
                'name' => ['es' => 'Competencias digitales',   'ca' => 'Competències digitals'],
                'icon' => 'icofont-laptop',
            ],
        ];

        foreach ($categories as $data) {
            Category::create([
                'name' => $data['name'],
                'slug' => [
                    'es' => Str::slug($data['name']['es']),
                    'ca' => Str::slug($data['name']['ca']),
                ],
                'icon' => $data['icon'],
            ]);
        }
    }
}
