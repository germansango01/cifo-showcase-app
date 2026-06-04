<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['course_id', 'year', 'cycle', 'catalog_code', 'is_active'])]
class Catalog extends Model
{
    /** @use HasFactory<\Database\Factories\CatalogFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'year' => 'integer',
        'is_active' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
