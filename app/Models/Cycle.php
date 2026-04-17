<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    /** @use HasFactory<\Database\Factories\CycleFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'cycles';

    protected $fillable = [
        'slug',
        'name_ca',
        'name_es',
        'description_ca',
        'description_es',
        'icon'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
