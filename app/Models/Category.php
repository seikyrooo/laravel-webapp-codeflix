<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'title',
        'slug',
    ];

    public function movies() : BelongsToMany {
        return $this->belongsToMany(Movie::class);
    }
}
