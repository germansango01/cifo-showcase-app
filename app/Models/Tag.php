<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

#[Fillable(['name', 'slug'])]
class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public array $translatable = ['name', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (Tag $tag): void {
            $tag->setTranslations('slug', [
                'es' => Str::slug($tag->getTranslation('name', 'es', false) ?? ''),
                'ca' => Str::slug($tag->getTranslation('name', 'ca', false) ?? ''),
            ]);
        });
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
