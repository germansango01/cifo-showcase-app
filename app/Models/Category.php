<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

#[Fillable(['slug', 'name'])]
class Category extends Model
{
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

        if ($field === $slugField) {
            return $this->where(function ($q) use ($slugField, $value) {
                foreach (['es', 'ca'] as $locale) {
                    $q->orWhere("{$slugField}->{$locale}", $value);
                }
            })->first();
        }

        return parent::resolveRouteBinding($value, $field);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function projects()
    {
        return $this->hasManyThrough(Project::class, Course::class);
    }
}
