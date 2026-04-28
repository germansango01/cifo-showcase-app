<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

#[Fillable(['slug', 'name', 'icon'])]
class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public array $translatable = ['name', 'slug'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
