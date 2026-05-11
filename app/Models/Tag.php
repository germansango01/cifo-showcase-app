<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

#[Fillable(['name', 'slug'])]
class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    use HasTranslatableSlug;
    use HasTranslations;
    use SoftDeletes;

    public array $translatable = ['name', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(['es', 'ca'])
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * SubstituteBindings runs before the `locale` middleware, so getLocale() still returns
     * the app default. Search across all translatable locales to find the correct model.
     */
    public function resolveRouteBinding($value, $field = null): ?static
    {
        $slugField = $this->getSlugOptions()->slugField;

        if (($field ?? $slugField) === $slugField) {
            return $this->where(function ($q) use ($slugField, $value) {
                foreach (['es', 'ca'] as $locale) {
                    $q->orWhere("{$slugField}->{$locale}", $value);
                }
            })->first();
        }

        return parent::resolveRouteBinding($value, $field);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
