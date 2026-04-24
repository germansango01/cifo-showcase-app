<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'email'])]
class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
