<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

#[Fillable(['slug', 'name', 'icon'])]
class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public array $translatable = ['name', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (Category $category): void {
            $category->setTranslations('slug', [
                'es' => Str::slug($category->getTranslation('name', 'es', false) ?? ''),
                'ca' => Str::slug($category->getTranslation('name', 'ca', false) ?? ''),
            ]);
        });
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
