<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    protected $fillable = [
        'duration',
        'url_720',
        'url_1080',
        'url_4k',

    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function categories() : BelongsToMany {
        return $this->belongsToMany(Category::class);
    }
}
