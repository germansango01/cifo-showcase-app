<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMedia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'project_media';

    protected $fillable = [
        'project_id',
        'type',
        'path',
        'alt_text',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
