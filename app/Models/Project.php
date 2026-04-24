<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'course_id',
    'slug',
    'project_date',
    'title_ca',
    'title_es',
    'description_ca',
    'description_es',
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
    use SoftDeletes;

    public function getRouteKeyName(): string
    {
        return 'slug';
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
