<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

#[Fillable([
    'course_id',
    'slug',
    'project_date',
    'title',
    'description',
    'thumbnail',
    'repo_url',
    'live_url',
    'status',
    'featured',
    'published_at',
])]
class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    use HasTranslatableSlug;
    use HasTranslations;
    use SoftDeletes;

    public array $translatable = ['title', 'description', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(['es', 'ca'])
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    protected function casts(): array
    {
        return [
            'project_date' => 'date',
            'featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function media()
    {
        return $this->hasMany(ProjectMedia::class)->orderBy('sort_order');
    }
}
