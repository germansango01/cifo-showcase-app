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
            ['es' => 'Laravel',                  'ca' => 'Laravel'],
            ['es' => 'PHP',                      'ca' => 'PHP'],
            ['es' => 'Java',                     'ca' => 'Java'],
            ['es' => 'Spring Boot',              'ca' => 'Spring Boot'],
            ['es' => 'React',                    'ca' => 'React'],
            ['es' => 'Vue',                      'ca' => 'Vue'],
            ['es' => 'Node.js',                  'ca' => 'Node.js'],
            ['es' => 'MySQL',                    'ca' => 'MySQL'],
            ['es' => 'PostgreSQL',               'ca' => 'PostgreSQL'],
            ['es' => 'Docker',                   'ca' => 'Docker'],
            ['es' => 'Git',                      'ca' => 'Git'],
            ['es' => 'GitHub',                   'ca' => 'GitHub'],
            ['es' => 'API REST',                 'ca' => 'API REST'],
            ['es' => 'Tailwind CSS',             'ca' => 'Tailwind CSS'],
            ['es' => 'Bootstrap',                'ca' => 'Bootstrap'],
            ['es' => 'Python',                   'ca' => 'Python'],
            ['es' => 'FastAPI',                  'ca' => 'FastAPI'],
            ['es' => 'Inteligencia Artificial',  'ca' => 'Intel·ligència Artificial'],
            ['es' => 'IoT',                      'ca' => 'IoT'],
            ['es' => 'Arduino',                  'ca' => 'Arduino'],
            ['es' => 'Ciberseguridad',           'ca' => 'Ciberseguretat'],
            ['es' => 'Kali Linux',               'ca' => 'Kali Linux'],
            ['es' => 'Linux',                    'ca' => 'Linux'],
            ['es' => 'Firebase',                 'ca' => 'Firebase'],
            ['es' => 'MongoDB',                  'ca' => 'MongoDB'],
            ['es' => 'Redis',                    'ca' => 'Redis'],
            ['es' => 'JWT',                      'ca' => 'JWT'],
            ['es' => 'TypeScript',               'ca' => 'TypeScript'],
            ['es' => 'Angular',                  'ca' => 'Angular'],
            ['es' => 'Figma',                    'ca' => 'Figma'],
            ['es' => 'UX UI',                    'ca' => 'UX UI'],
            ['es' => 'Photoshop',                'ca' => 'Photoshop'],
            ['es' => 'Canva',                    'ca' => 'Canva'],
            ['es' => 'Machine Learning',         'ca' => 'Machine Learning'],
            ['es' => 'TensorFlow',               'ca' => 'TensorFlow'],
            ['es' => 'OpenCV',                   'ca' => 'OpenCV'],
            ['es' => 'DevOps',                   'ca' => 'DevOps'],
            ['es' => 'Kubernetes',               'ca' => 'Kubernetes'],
            ['es' => 'AWS',                      'ca' => 'AWS'],
            ['es' => 'Azure',                    'ca' => 'Azure'],
        ];

        foreach ($tags as $t) {
            Tag::create([
                'name' => ['es' => $t['es'], 'ca' => $t['ca']],
                'slug' => ['es' => Str::slug($t['es']), 'ca' => Str::slug($t['ca'])],
            ]);
        }
    }
}
