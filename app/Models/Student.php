<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'cycle', 'year'])]
class Student extends Model
{
    use HasFactory;

    /**
     * Get the projects submitted by this student.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'email'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
>>>>>>> main
    }
}
