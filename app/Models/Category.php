<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';

    protected $fillable = [
        'slug',
        'name_ca',
        'name_es',
        'icon',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
