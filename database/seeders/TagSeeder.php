<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['es' => 'Laravel',    'ca' => 'Laravel'],
            ['es' => 'PHP',        'ca' => 'PHP'],
            ['es' => 'Vue',        'ca' => 'Vue'],
            ['es' => 'React',      'ca' => 'React'],
            ['es' => 'Node.js',    'ca' => 'Node.js'],
            ['es' => 'Tailwind',   'ca' => 'Tailwind'],
            ['es' => 'MySQL',      'ca' => 'MySQL'],
            ['es' => 'PostgreSQL', 'ca' => 'PostgreSQL'],
            ['es' => 'Docker',     'ca' => 'Docker'],
            ['es' => 'API REST',   'ca' => 'API REST'],
            ['es' => 'DevOps',     'ca' => 'DevOps'],
            ['es' => 'UX/UI',      'ca' => 'UX/UI'],
            ['es' => 'Testing',    'ca' => 'Testing'],
            ['es' => 'CI/CD',      'ca' => 'CI/CD'],
            ['es' => 'JavaScript', 'ca' => 'JavaScript'],
        ];

        foreach ($tags as $t) {
            Tag::create([
                'name' => ['es' => $t['es'], 'ca' => $t['ca']],
                'slug' => ['es' => Str::slug($t['es']), 'ca' => Str::slug($t['ca'])],
            ]);
        }
    }
}
