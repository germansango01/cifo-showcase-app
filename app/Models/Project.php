<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'student_id',
    'professor_id',
    'title',
    'slug',
    'short_description',
    'description',
    'cycle',
    'year',
    'thumbnail_url',
    'demo_url',
    'repo_url',
    'featured',
])]
class Project extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'year' => 'integer',
        ];
    }

    // ── Accessors ────────────────────────────────────────────

    /**
     * Auto-generate slug from title on creation if not provided.
     */
    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    // ── Relations ────────────────────────────────────────────

    /**
     * Get the student who submitted this project.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the professor who supervised this project.
     */
    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }

    /**
     * Get the gallery images for this project.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    /**
     * Get the technologies used in this project.
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

    /**
     * Get the tags associated with this project.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // ── Scopes ───────────────────────────────────────────────

    /**
     * Scope to featured projects only.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope to a specific cycle (DAW, DAM, ASIR, SMX).
     */
    public function scopeCycle($query, string $cycle)
    {
        return $query->where('cycle', strtoupper($cycle));
    }
}
