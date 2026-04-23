<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Tag::factory()->count(15)->create();
        $tags = [
        'Laravel','PHP','Vue','React','Node.js','Tailwind',
        'MySQL','PostgreSQL','Docker','API REST','DevOps',
        'UX/UI','Testing','CI/CD','JavaScript',
    ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}
