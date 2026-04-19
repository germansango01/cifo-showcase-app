<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'cycle_id',
        'user_id',
        'name',
        'academic_year'
    ];

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
