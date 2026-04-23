<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'category_id',
        'course_code',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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
