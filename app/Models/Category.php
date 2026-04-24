<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['slug', 'name_ca', 'name_es', 'icon'])]
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
