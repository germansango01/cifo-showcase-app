<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'email'])]
class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
