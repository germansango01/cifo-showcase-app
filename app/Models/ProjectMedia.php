<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

#[Fillable(['project_id', 'type', 'path', 'alt_text', 'sort_order'])]
class ProjectMedia extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $table = 'project_media';

    public array $translatable = ['alt_text'];

    protected function casts(): array
    {
        return ['sort_order' => 'integer'];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
