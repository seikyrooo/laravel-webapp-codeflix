<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function ratings() : HasMany {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute(): float {
        return $this->ratings()->avg('rating');
    }
}
