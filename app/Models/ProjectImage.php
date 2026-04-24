<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'project_images';

    protected $fillable = [
        'project_id',
        'path',
        'alt_text',
        'sort_order',
        'featured',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'featured' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
