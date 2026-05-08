<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

#[Fillable([
    'course_id',
    'slug',
    'project_date',
    'title',
    'description',
    'repo_url',
    'live_url',
    'status',
    'featured',
])]
class Project extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslatableSlug;
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    public array $translatable = ['title', 'description', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(['es', 'ca'])
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useFallbackUrl(asset('images/placeholder.webp'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('card')
            ->width(800)
            ->height(600)
            ->sharpen(8)
            ->nonQueued();
    }

    /**
     * Returns the featured image, falling back to the first image in the collection.
     */
    public function getFeaturedImage(): ?Media
    {
        return $this->getMedia('images')->first(
            fn (Media $m) => (bool) $m->getCustomProperty('is_featured')
        ) ?? $this->getFirstMedia('images');
    }

    protected function casts(): array
    {
        return [
            'project_date' => 'date',
            'featured' => 'boolean',
        ];
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class)->orderBy('sort_order');
    }
}
