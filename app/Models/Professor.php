<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'department'])]
class Professor extends Model
{
    use HasFactory;

    /**
     * Get the projects supervised by this professor.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
