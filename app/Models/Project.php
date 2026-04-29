<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
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
    use HasTranslations;
    use SoftDeletes;

    public array $translatable = ['title', 'description', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (Project $project): void {
            $project->setTranslations('slug', [
                'es' => Str::slug($project->getTranslation('title', 'es', false) ?? ''),
                'ca' => Str::slug($project->getTranslation('title', 'ca', false) ?? ''),
            ]);
        });
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if ($field === 'slug') {
            return $this->where('slug->' . app()->getLocale(), $value)->firstOrFail();
        }

        return parent::resolveRouteBinding($value, $field);
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
